<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\Article;
use app\models\admin\ArticleViews;
use app\models\admin\Category;
use yii\data\Pagination;
use yii\db\Command;
use app\models\admin\Login;
use yii\helpers\Url;
use app\models\admin\LabelHasArticle;
use app\models\admin\Liuyan;
use app\models\admin\Label;
use app\models\admin\User;
use app\models\admin\Link;
use app\models\admin\Album;
use app\models\admin\Fans;
use app\controllers\admin\CommonController;
use app\models\admin\Article_comment_first;
use app\models\admin\Article_comment_second;
use app\models\admin\Praise1;
use app\models\admin\Praise2;


/**
* 前台文章控制器
*/
class ArticleController extends BaseController
{
	
	public function actionIndex(){
		$session_uid=$this->ReturnSession('uid');
		$uid=$_GET['uid'];
		$article_id=$_GET['article_id'];
		//点击此链接就把制定文章阅读数加1(非本人用户)
		$article=ArticleViews::findOne(['id'=>$article_id]);
		if($session_uid!=$uid){
			if($article){
			$article->hits=$article->hits+1;
			if($article->save()){

			}else{
				echo "出现意外错误！";
				return;
			}
			}else{
			echo "非法访问！";
			return;
		}
		}
		
		//查找上一篇文章和下一篇文章
		$prev_articles=ArticleViews::find()->where(['<','id',$article_id])->andWhere(['uid'=>$uid,'type'=>0])->orderBy(['id'=>SORT_DESC])->limit(1)->all();
		$next_articles=ArticleViews::find()->where(['>','id',$article_id])->andWhere(['uid'=>$uid,'type'=>0])->orderBy('id')->limit(1)->all();

		//查找该文章的标签
		$keyword=$article->keyword;
		$labels_name=explode('，',$keyword);

		//查找文章一级评论
		$first_comments_data=Article_comment_first::find()->where(['article_id'=>$article->id]);
		$first_comments_pages=new Pagination([
				'totalCount'=>$first_comments_data->count(),
				'defaultPageSize'=>10,
			]);
		$first_comments=$first_comments_data->offset($first_comments_pages->offset)->limit($first_comments_pages->limit)->all();

		//查找文章二级评论(需要循环一级评论才能查找二级评论)
		$a=1;
		$second_comments_count=array();
		$second_comments=array();
		$second_comments_pages=array();
		foreach ($first_comments as $first_comment) {
			$second_comments_data=Article_comment_second::find()->where(['article_id'=>$article_id])->andWhere(['article_comment_first_id'=>$first_comment->id])->orderBy(['comment_time'=>SORT_ASC]);
			
			$second_comments_pages[$a]=new Pagination([
					'totalCount'=>$second_comments_data->count(),
					'defaultPageSize'=>10,
					'pageParam'=>"second_page".$a,
				]);
			$second_comments[$a]=$second_comments_data->offset($second_comments_pages[$a]->offset)->limit($second_comments_pages[$a]->limit)->all();

			$second_comments_count[$a]=$second_comments_data->count();
			// $second_comments[$a]=$second_comments_data->limit(10)->all();
			$a++;
		}

		//查找文章一级评论点赞情况
		$praises1=Praise1::find()->where(['article_id'=>$article_id])->andWhere(['user_uid'=>$session_uid])->all();

		//查找文章二级评论点赞情况
		$praises2=Praise2::find()->where(['article_id'=>$article_id])->andWhere(['user_uid'=>$session_uid])->all();


		//查找全部分类
		$category_ids=array();
		$categories=Category::findAll(['uid'=>$uid]);
		
		//查找我的资料
		$myinfo=User::findOne(['id'=>$uid]);

		//查找关注情况
		$follow_message=Fans::find()->where(['fans_uid'=>$session_uid])->andWhere(['follow_uid'=>$uid])->one();
		if($follow_message){
			$fans_message=Fans::find()->where(['fans_uid'=>$uid])->andWhere(['follow_uid'=>$session_uid])->one();
			if($fans_message){
				//双方都关注了，显示相互关注
				$follow_message=2;
			}else{
				//单方面关注
				$follow_message=1;
			}
		}else{
			//0表示双方都没有关注
			$follow_message=0;
		}

		//查找该博客用户关注人数和粉丝人数
		$follow_count=Fans::find()->where(['fans_uid'=>$uid])->count();
		$fans_count=Fans::find()->where(['follow_uid'=>$uid])->count();

		//查找我的标签
		$mylabels=$this->MyLabel($uid);
		
		//随机文章
		$connect=Yii::$app->db;
		$command=$connect->createCommand('SELECT * FROM article WHERE uid=:uid AND type=0  order by rand() limit 5');
		$command->bindParam(':uid',$uid);
		$rand_articles=$command->queryAll();

		//查找最新留言
		$newliuyans=Liuyan::find()->where(['uid'=>$uid])->orderBy(['guest_time'=>SORT_DESC])->limit(5)->all();

		//查找热门相册
		$hotalbums=Album::find()->where(['uid'=>$uid])->andWhere(['status'=>0])->orderBy(['hits'=>SORT_DESC])->limit(5)->all();

		//查找热门文章
		$mosthits=Article::find()->where(['uid'=>$uid])->orderBy(['hits'=>SORT_DESC])->limit(10)->all();


		//热门博客
		$hotuser=Login::find()->where(['<>','id',$uid])->orderBy(['views'=>SORT_DESC])->limit(10)->all();
	
		//友情链接
		$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();
		
		return $this->render('index',[
				'article'=>$article,
				'categories'=>$categories,
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'labels_name'=>$labels_name,
				'prev_articles'=>$prev_articles,
				'next_articles'=>$next_articles,
				'session_uid'=>$session_uid,
				'newliuyans'=>$newliuyans,
				'mosthits'=>$mosthits,
				'myinfo'=>$myinfo,
				'links'=>$links,
				'hotalbums'=>$hotalbums,
				'follow_message'=>$follow_message,
				'follow_count'=>$follow_count,
				'fans_count'=>$fans_count,
				'first_comments_pages'=>$first_comments_pages,
				'first_comments'=>$first_comments,
				'second_comments_count'=>$second_comments_count,
				'second_comments'=>$second_comments,
				'second_comments_pages'=>$second_comments_pages,
				'praises1'=>$praises1,
				'praises2'=>$praises2,
			]);
	}

	//处理一级评论
	public function actionFirstComment(){
		if(!$this->IsLogin()){
			//没有登录，提示登录后评论
			return 0;
		}
		$post=Yii::$app->request->post();
		//已经登录，获取信息
		$post['comment_uid']=$this->ReturnSession('uid');
		$post['comment_author']=$this->ReturnSession('username');
		$user=User::findOne(['id'=>$post['comment_uid']]);
		$post['comment_ip']=Yii::$app->request->userIP;
		$location=$this->getIPLocation($post['comment_ip']);
		if(is_array($location)){
			$post['comment_location']=$location['country'].$location['province'].$location['city'];
		}else{
			$post['comment_location']=$location;
		}
		$post['comment_picture']=$user['headimage'];
		//获取客户端
		$common=new CommonController('','','');
		$post['comment_from']=$common->getOS();
		$first_comment=new Article_comment_first;
		$first_comment->attributes=$post;
		if($first_comment->save()){
			//评论成功
			return 1;
		}else{
			//评论失败
			return 2;
		}
	}

	//处理二级评论
	public function actionSecondComment(){
		if(!$this->IsLogin()){
			//没有登录，提示登录后评论
			return 0;
		}
		$post=Yii::$app->request->post();
		//已经登录，获取信息
		$post['comment_uid']=$this->ReturnSession('uid');
		$post['comment_author']=$this->ReturnSession('username');
		$user=User::findOne(['id'=>$post['comment_uid']]);
		$post['comment_ip']=Yii::$app->request->userIP;
		$location=$this->getIPLocation($post['comment_ip']);
		if(is_array($location)){
			$post['comment_location']=$location['country'].$location['province'].$location['city'];
		}else{
			$post['comment_location']=$location;
		}
		$post['comment_picture']=$user['headimage'];
		//获取客户端
		$common=new CommonController('','','');
		$post['comment_from']=$common->getOS();
		$second_comment=new Article_comment_second;
		$second_comment->attributes=$post;
		if($second_comment->save()){
			//评论成功
			return 1;
		}else{
			//评论失败
			return 2;
		}
	}


	//处理一级评论点赞和鄙视事件
	public function actionGoodLevelOne(){
		if(!$this->IsLogin()){
			//没有登录，不允许点赞
			return 0;
		}
		$user_uid=$this->ReturnSession('uid');
		$post=Yii::$app->request->post();
		$article_comment_first=Article_comment_first::findOne(['id'=>$post['article_comment_first_id']]);
		//判断是点赞还是鄙视
		$type=$post['type'];
		$action=$post['action'];
		if($type=="good"){
			//点赞
			//判断是添加点赞还是取消点赞
			if($action=="add"){
				//添加
				//查询数据库中是否存在该用户信息，有就直接更新，没有就新增数据
				$checkpraise=Praise1::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_first_id'=>$post['article_comment_first_id']])->one();
				if($checkpraise){
					//存在表示有数据，只更新
					$checkpraise->scenario="good";
					$checkpraise->is_good=1;
					$checkpraise->is_good_read=0;
					$checkpraise->good_time=time();
					if($checkpraise->save()){
						//点赞成功，返回1
						$article_comment_first->good++;
						$article_comment_first->save();
						return 1;
					}else{
						//点赞失败，返回2
						return 2;
					}
				}else{
					//不存在，新增
					$newpraise=new Praise1;
					$newpraise->scenario="good";
					$newpraise->user_uid=$user_uid;
					$newpraise->article_id=$post['article_id'];
					$newpraise->article_comment_first_id=$post['article_comment_first_id'];

					//点赞设置is_good字段为1，is_good_read字段为0（未读），good_time字段
					$newpraise->is_good=1;
					$newpraise->is_good_read=0;
					$newpraise->good_time=time();
					if($newpraise->save()){
						//点赞成功，返回1
						$article_comment_first->good++;
						$article_comment_first->save();
						return 1;
					}else{
						//点赞失败，返回2
						return 2;
					}
				}
				
			}else{
				//取消
				$oldpraise=Praise1::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_first_id'=>$post['article_comment_first_id']])->one();
				$oldpraise->scenario="good";
				$oldpraise->is_good=0;
				$oldpraise->is_good_read=-1;
				$oldpraise->good_time=0;
				if($oldpraise->save()){
					//取消点赞成功，返回3
					$article_comment_first->good--;
					$article_comment_first->save();
					return 3;
				}else{
					//取消点赞失败，返回4
					return 4;
				}
			}
		}else{
			//鄙视
			//判断是添加鄙视还是取消鄙视
			if($action=="add"){
				//添加
				//查询数据库中是否存在该用户信息，有就直接更新，没有就新增数据
				$checkpraise=Praise1::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_first_id'=>$post['article_comment_first_id']])->one();
				if($checkpraise){
					//存在表示有数据，只更新
					$checkpraise->scenario="bad";
					$checkpraise->is_bad=1;
					$checkpraise->is_bad_read=0;
					$checkpraise->bad_time=time();
					if($checkpraise->save()){
						//鄙视成功，返回5
						$article_comment_first->bad++;
						$article_comment_first->save();
						return 5;
					}else{
						//鄙视失败，返回6
						return 6;
					}
				}else{
					//不存在数据，新增
					$newpraise=new Praise1;
					$newpraise->scenario="bad";
					$newpraise->user_uid=$user_uid;
					$newpraise->article_id=$post['article_id'];
					$newpraise->article_comment_first_id=$post['article_comment_first_id'];

					//鄙视设置is_bad字段为1，is_bad_read字段为0（未读），bad_time字段
					$newpraise->is_bad=1;
					$newpraise->is_bad_read=0;
					$newpraise->bad_time=time();
					if($newpraise->save()){
						//鄙视成功，返回5
						$article_comment_first->bad++;
						$article_comment_first->save();
						return 5;
					}else{
						//鄙视失败，返回6
						return 6;
					}
				}
			}else{
				//取消
				$oldpraise=Praise1::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_first_id'=>$post['article_comment_first_id']])->one();
				$oldpraise->scenario="bad";
				$oldpraise->is_bad=0;
				$oldpraise->is_bad_read=-1;
				$oldpraise->bad_time=0;
				if($oldpraise->save()){
					//取消鄙视成功，返回7
					$article_comment_first->bad--;
					$article_comment_first->save();
					return 7;
				}else{
					//取消鄙视失败，返回8
					return 8;
				}
			}
		}
	}

	//处理二级评论点赞和鄙视事件
	public function actionGoodLevelTwo(){
		if(!$this->IsLogin()){
			//没有登录，不允许点赞
			return 0;
		}
		$user_uid=$this->ReturnSession('uid');
		$post=Yii::$app->request->post();
		$article_comment_second=Article_comment_second::findOne(['id'=>$post['article_comment_second_id']]);
		//判断是点赞还是鄙视
		$type=$post['type'];
		$action=$post['action'];
		if($type=="good"){
			//点赞
			//判断是添加点赞还是取消点赞
			if($action=="add"){
				//添加
				//查询数据库中是否存在该用户信息，有就直接更新，没有就新增数据
				$checkpraise=Praise2::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_second_id'=>$post['article_comment_second_id']])->one();
				if($checkpraise){
					//存在表示有数据，只更新
					$checkpraise->scenario="good";
					$checkpraise->is_good=1;
					$checkpraise->is_good_read=0;
					$checkpraise->good_time=time();
					if($checkpraise->save()){
						//点赞成功，返回1
						$article_comment_second->good++;
						$article_comment_second->save();
						return 1;
					}else{
						//点赞失败，返回2
						return 2;
					}
				}else{
					//不存在，新增
					$newpraise=new Praise2;
					$newpraise->scenario="good";
					$newpraise->user_uid=$user_uid;
					$newpraise->article_id=$post['article_id'];
					$newpraise->article_comment_second_id=$post['article_comment_second_id'];

					//点赞设置is_good字段为1，is_good_read字段为0（未读），good_time字段
					$newpraise->is_good=1;
					$newpraise->is_good_read=0;
					$newpraise->good_time=time();
					if($newpraise->save()){
						//点赞成功，返回1
						$article_comment_second->good++;
						$article_comment_second->save();
						return 1;
					}else{
						//点赞失败，返回2
						return 2;
					}
				}
				
			}else{
				//取消
				$oldpraise=Praise2::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_second_id'=>$post['article_comment_second_id']])->one();
				$oldpraise->scenario="good";
				$oldpraise->is_good=0;
				$oldpraise->is_good_read=-1;
				$oldpraise->good_time=0;
				if($oldpraise->save()){
					//取消点赞成功，返回3
					$article_comment_second->good--;
					$article_comment_second->save();
					return 3;
				}else{
					//取消点赞失败，返回4
					return 4;
				}
			}
		}else{
			//鄙视
			//判断是添加鄙视还是取消鄙视
			if($action=="add"){
				//添加
				//查询数据库中是否存在该用户信息，有就直接更新，没有就新增数据
				$checkpraise=Praise2::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_second_id'=>$post['article_comment_second_id']])->one();
				if($checkpraise){
					//存在表示有数据，只更新
					$checkpraise->scenario="bad";
					$checkpraise->is_bad=1;
					$checkpraise->is_bad_read=0;
					$checkpraise->bad_time=time();
					if($checkpraise->save()){
						//鄙视成功，返回5
						$article_comment_second->bad++;
						$article_comment_second->save();
						return 5;
					}else{
						//鄙视失败，返回6
						return 6;
					}
				}else{
					//不存在数据，新增
					$newpraise=new Praise2;
					$newpraise->scenario="bad";
					$newpraise->user_uid=$user_uid;
					$newpraise->article_id=$post['article_id'];
					$newpraise->article_comment_second_id=$post['article_comment_second_id'];

					//鄙视设置is_bad字段为1，is_bad_read字段为0（未读），bad_time字段
					$newpraise->is_bad=1;
					$newpraise->is_bad_read=0;
					$newpraise->bad_time=time();
					if($newpraise->save()){
						//鄙视成功，返回5
						$article_comment_second->bad++;
						$article_comment_second->save();
						return 5;
					}else{
						//鄙视失败，返回6
						return 6;
					}
				}
			}else{
				//取消
				$oldpraise=Praise2::find()->where(['user_uid'=>$user_uid])->andWhere(['article_comment_second_id'=>$post['article_comment_second_id']])->one();
				$oldpraise->scenario="bad";
				$oldpraise->is_bad=0;
				$oldpraise->is_bad_read=-1;
				$oldpraise->bad_time=0;
				if($oldpraise->save()){
					//取消鄙视成功，返回7
					$article_comment_second->bad--;
					$article_comment_second->save();
					return 7;
				}else{
					//取消鄙视失败，返回8
					return 8;
				}
			}
		}
	}

}
 ?>