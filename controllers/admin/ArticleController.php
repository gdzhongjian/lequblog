<?php 
namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\admin\Upload;
use app\models\admin\Category;
use app\models\admin\Article;
use yii\web\UploadedFile;
use yii\data\Pagination;
use app\models\admin\Label;
use app\models\admin\LabelHasArticle;
use app\models\admin\LabelHasUser;
use app\models\admin\User;
/**
* 文章控制器
*/
class ArticleController extends CommonController
{
	
	// public $layout=false;

	public function actionAddArticle(){
		$uid=$this->ReturnSession("uid");
		$username=$this->ReturnSession("username");
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$categories=Category::findAll(['uid'=>$uid]);
		$model=new Upload;
		return $this->render('addarticle',[
			'model'=>$model,
			'categories'=>$categories,
			'username'=>$username,
			'status'=>'add',
			'user_headimage'=>$user_headimage,
			]);
	}

	//文章封面上传
	// public function actionUploadArticleImage(){
	// 	$model=new Upload;
	// 	// $model->imageFile=UploadedFile::getInstance($model,'imageFile');
	// 	// echo $model->imageFile;
	// 	// return;
	// 	// // var_dump($model);return;
	// 	// if($model->upload()){
	// 	// 	echo "hello";
	// 	// }else{
	// 	// 	echo "error";
	// 	// }
	// 	// echo "cscss";
	// 	// $file=$_FILES('imageFile');
	// 	// if($file){
	// 	// 	echo "true";
	// 	// }else{
	// 	// 	echo "false";
	// 	// }
	// 	if (Yii::$app->request->isPost) {
 //            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
 //            // echo $model->imageFile;
 //            // echo "xxx";
 //            // return;
 //            if ($model->upload()) {
 //                // 文件上传成功
 //                return;
 //            }else{
 //            	echo "aaa";
 //            }
 //        }else{
 //        	echo "cuowu";
 //        }
	// }

	public function actionCheckAddArticle(){
		$post=Yii::$app->request->post();
		$uid=$this->ReturnSession('uid');
		// var_dump($post);
		// return;
		// echo $post->Upload;
		// return;
		//上传文章封面

		$upload=new Upload;
		if(Yii::$app->request->isPost){
			$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
			//如果有上传封面
			if($upload->imageFile){
				$fileurl=$upload->upload();
				if($fileurl!='error'){
				//文件上传成功！
				$post['picture']=$fileurl;
				}else{
					echo "文件上传失败！";
				}
			}else{
				//没有上传封面,使用默认封面图
				$fileurl='public/upload/article/cover/default/Lighthouse.jpg';
				$post['picture']=$fileurl;

			}
			//获取客户端操作系统
			$os=$this->getOS();
			$post['from']=$os;
			$post['uid']=$uid;

			//获取ip,地址
			$ip=Yii::$app->request->userIP;
			$location=$this->getIPLocation($ip);
			if(is_array($location)){
				$post['article_location']=$location['country'].$location['province'].$location['city'];
			}else{
				$post['article_location']=$location;
			}

			//实例化模型
			$model=new Article;
			$model->attributes=$post;
			if($model->validate()){
				if($id=$model->save()){
					//处理文章标签
					$inputlabel=$post['keyword'];
					$labels=explode("，",$inputlabel);
					for($i=0;$i<count($labels);$i++){
						$label=Label::findOne(['name'=>$labels[$i]]);
						//判断标签是否存在，如果不存在就创建新标签，存在就获取标签主码，然后再插入关联表label_has_article
						
							$label=new Label;
							$label->name=$labels[$i];
							if($label->save()){
								$label_has_article=new LabelHasArticle;
								$label_has_article->label_id=$label->id;
								$label_has_article->article_id=$model->id;
								if($label_has_article->save()){
									//如果是新的label，必须插入label_has_user表中
									$label_has_user=new LabelHasUser;
									$label_has_user->label_id=$label->id;
									$label_has_user->user_id=$uid;
									if($label_has_user->save()){
										echo "更新成功label_has_user！";
									}else{
										echo "更新失败label_has_user";
										return;
									}
								}else{
									echo $label_has_article->getErrors();
									echo "数据出错！";
									return;
								}
							}else{
								//查询label主码
								$select_label=Label::findOne(['name'=>$label->name]);
								// echo $select_label->id;
								//更新关联表label_has_article
								$label_has_article=new LabelHasArticle;
								$label_has_article->label_id=$select_label->id;
								$label_has_article->article_id=$model->id;
								if($label_has_article->save()){
									/*
									如果不是新的label，判断用户表和标签表的关联表中是否存在此label的主码，
									存在就不需要更新，不存在就更新
									 */
									$label_has_user=new LabelHasUser;
									$islabel_has_user=$this->CheckLabelHasUser($select_label->id);
									if(!$islabel_has_user){
										$label_has_user->label_id=$select_label->id;
										$label_has_user->user_id=$uid;
										if($label_has_user->save()){

										}else{

										}
									}
									

								}else{
									echo "label_has_article表更新失败！";
									return;
								}
								// echo "数据出错！";
								
							}
					}
					
					return $this->redirect(array('article-list'));
				}else{
					echo "添加文章失败！";return;
				}
			}else{
				echo "输入信息有误或者缺省";;return;
			}
		
		}
	}

	//编辑文章保存
	public function actionCheckEditArticle(){
		$post=Yii::$app->request->post();
		$uid=$this->ReturnSession('uid');
		$article_id=$post['id'];
		$article=Article::findOne(['id'=>$article_id]);
		$upload=new Upload;
		if(Yii::$app->request->isPost){
			$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
			//如果有上传封面
			if($upload->imageFile){
				$fileurl=$upload->upload();
				if($fileurl!='error'){
				//文件上传成功！
				$article->picture=$fileurl;
				}else{
					echo "文件上传失败！";
				}
			}
			//获取ip,地址
			$ip=Yii::$app->request->userIP;
			$location=$this->getIPLocation($ip);
			if(is_array($location)){
				$post['article_location']=$location['country'].$location['province'].$location['city'];
			}else{
				$post['article_location']=$location;
			}
			//获取客户端操作系统
			$os=$this->getOS();
			$article->from=$os;
			$article->title=$post['title'];
			$article->content=$post['content'];
			$article->remark=$post['remark'];
			$article->tag_id=$post['tag_id'];
			$article->keyword=$post['keyword'];
			$article->type=$post['type'];
			$article->istop=$post['istop'];
			$article->original=$post['original'];
			$article->article_location=$post['article_location'];
			if($article->save()){
				//处理文章标签
					$inputlabel=$post['keyword'];
					$labels=explode("，",$inputlabel);
					for($i=0;$i<count($labels);$i++){
						$label=Label::findOne(['name'=>$labels[$i]]);
						//判断标签是否存在，如果不存在就创建新标签，存在就获取标签主码，然后再插入关联表label_has_article
						
							$label=new Label;
							$label->name=$labels[$i];
							if($label->save()){
								$label_has_article=new LabelHasArticle;
								$label_has_article->label_id=$label->id;
								$label_has_article->article_id=$article->id;
								if($label_has_article->save()){
									//如果是新的label，必须插入label_has_user表中
									$label_has_user=new LabelHasUser;
									$label_has_user->label_id=$label->id;
									$label_has_user->user_id=$uid;
									if($label_has_user->save()){
										echo "更新成功label_has_user！";
									}else{
										echo "更新失败label_has_user";
										return;
									}
								}else{
									echo $label_has_article->getErrors();
									echo "数据出错！";
									return;
								}
							}else{
								// //查询label主码
								// $select_label=Label::findOne(['name'=>$label->name]);
								// // echo $select_label->id;
								// //更新关联表label_has_article
								// $label_has_article=new LabelHasArticle;
								// $label_has_article->label_id=$select_label->id;
								// $label_has_article->article_id=$article->id;
								// if($label_has_article->save()){
								// 	/*
								// 	如果不是新的label，判断用户表和标签表的关联表中是否存在此label的主码，
								// 	存在就不需要更新，不存在就更新
								// 	 */
								// 	$label_has_user=new LabelHasUser;
								// 	$islabel_has_user=$this->CheckLabelHasUser($select_label->id);
								// 	if(!$islabel_has_user){
								// 		$label_has_user->label_id=$select_label->id;
								// 		$label_has_user->user_id=$uid;
								// 		if($label_has_user->save()){

								// 		}else{

								// 		}
								// 	}
									

								// }else{
								// 	echo "label_has_article表更新失败！";
								// 	return;
								// }
								// // echo "数据出错！";
								
							}
					}

				return $this->redirect(array('article-list'));
			}else{
				echo "文章更新失败！";
			}			
		
		}
	}



	//编辑文章
	public function actionEditArticle(){
		$article_id=$_GET['article_id'];
		$islogin=$this->IsLogin();
		$uid=$this->ReturnSession('uid');
		if($islogin){
			$username=$this->ReturnSession('username');
			$userinfo=User::findOne(['username'=>$username]);
			$user_headimage=$userinfo->headimage;
			$categories=Category::findAll(['uid'=>$uid]);
			$model=new Upload;
			$article=Article::findOne(['id'=>$article_id]);
			$tag_id=$article['tag_id'];
			$category=Category::findOne(['id'=>$tag_id]);
			$category_name=$category['name'];
			return $this->render('addarticle',[
					'model'=>$model,
					'username'=>$username,
					'article'=>$article,
					'categories'=>$categories,
					'status'=>'edit',
					'category_name'=>$category_name,
					'user_headimage'=>$user_headimage,
				]);
		}else{
			echo "非法访问";
		}
	}

	//显示文章列表
	public function actionArticleList(){
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		//根据author查询全部文章信息,根据uid查询全部分类，根据全部分类查询分类文章
		$categories=Category::findAll(['uid'=>$uid]);
		$articles=array();    
		$tag_count=array();   //分类文章数
		$pages=array();
		$tagmodels=array();
		foreach ($categories as $category) {
			$tag_id=$category['id'];
			$tag_name=$category['name'];
			$articles[$tag_name]=Article::find()->where(['tag_id'=>$tag_id]);
			// $articles[$tag_name]=$articles[$tag_name]->all();
			// $tag_count[$tag_name]=$articles[$tag_name]->count();
			// print_r($articles[$tag_name]);
			// articles是多维数组，输出全部数据时需两个嵌套循环，输出分类数据时一个循环
			
		}

		// 分页处理 总文章数量
		$data=Article::find()->where(['author'=>$username]);
		$pagescount=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>10,
			]);
		$summodels=$data->offset($pagescount->offset)->limit($pagescount->limit)->orderBy(['post_time'=>SORT_DESC])->all();

		//分页处理 分类文章数量
		foreach ($categories as $category) {
			$tag_name=$category['name'];
			$data1=$articles[$tag_name];
			$pages[$tag_name]=new Pagination([
					'totalCount'=>$data1->count(),
					'defaultPageSize'=>10,
				]);
			$tagmodels[$tag_name]=$data1->offset($pages[$tag_name]->offset)->limit($pages[$tag_name]->limit)->orderBy(['post_time'=>SORT_DESC])->all();
		}



		return $this->render('articlelist',[
			'articles'=>$articles,
			'username'=>$username,
			'categories'=>$categories,
			'pagescount'=>$pagescount,
			'summodels'=>$summodels,
			'pages'=>$pages,
			'tagmodels'=>$tagmodels,
			'user_headimage'=>$user_headimage,
			]);
		// var_dump($articles);
		// foreach ($categories as $category) {
		// 	$tag_name=$category['name'];
		// 	foreach ($articles[$tag_name] as $articl) {
		// 		echo $articl['title'];
		// 		echo '<br>';
		// 	}
		// }
		// $articles=Article::findAll(['author'=>$username]);


	}

	//删除文章
	public function actionDeleteArticle(){
		$article_id=$_GET['article_id'];
		$uid=$this->IsLogin();
		if($uid){
			$article=Article::findOne(['id'=>$article_id]);
			if($article->delete($article_id)){
				return $this->redirect(array('article-list'));
			}else{
				echo "删除失败！";
			}
		}else{
			echo "非法访问";
		}
	}


	//查询label表和user表的关联表中是否存在相应的label_id和user_id
	public function CheckLabelHasUser($label_id){
		$uid=$this->ReturnSession('uid');
		$label_has_users=LabelHasUser::findAll(['label_id'=>$label_id]);
		foreach ($label_has_users as $label_has_user) {
			if($label_has_user->user_id==$uid){
				return true;
			}
		}
		return false;

	}

	
}
 ?>