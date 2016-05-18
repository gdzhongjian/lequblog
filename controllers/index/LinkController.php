<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\User;
use app\models\admin\Category;
use app\models\admin\Liuyan;
use app\models\admin\Article;
use app\models\admin\Link;
use app\models\admin\Album;
use app\models\admin\Fans;
/**
* 友链控制器
*/
class LinkController extends BaseController
{
	//申请友链视图显示
	public function actionIndex(){
		$session_uid=$this->ReturnSession('uid');
		if($session_uid){
			//如果存在session，查询出用户信息
			$user=User::findOne(['id'=>$session_uid]);
		}else{
			$user=false;
		}
		$uid=$_GET['uid'];
		
		
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
		$hotuser=User::find()->where(['<>','id',$uid])->orderBy(['views'=>SORT_DESC])->limit(10)->all();
		

		//友情链接
		$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();

		return $this->render('index',[
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'user'=>$user,
				'newliuyans'=>$newliuyans,
				'mosthits'=>$mosthits,
				'myinfo'=>$myinfo,
				'links'=>$links,
				'hotalbums'=>$hotalbums,
				'follow_message'=>$follow_message,
				'follow_count'=>$follow_count,
				'fans_count'=>$fans_count,
			]);
	}



	//处理申请友链
	public function actionCheckLink(){
		$uid=$_GET['uid'];
		$post=Yii::$app->request->post();
		if(!$post['name']){
			echo "请输入友链名称";
			return;
		}
		if(!$post['url']){
			echo "请输入友链地址";
			return;
		}
		if(!$post['email']){
			echo "请输入邮箱";
			return;
		}
		if(!$post['remark']){
			echo "请输入友链介绍";
			return;
		}
		$link=new Link;
		$link->attributes=$post;
		$link->uid=$uid;
		if($link->save()){
			// echo "友链添加成功！";
			return $this->redirect(array('link-reply','ok'=>1,'uid'=>$uid));
		}else{
			echo "友链添加失败！";
		}
	}

	//申请友链结果提示
	public function actionLinkReply(){
		$ok=$_GET['ok'];
		if($ok){
				$session_uid=$this->ReturnSession('uid');
				$uid=$_GET['uid'];
				
				
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
				$hotuser=User::find()->where(['<>','id',$uid])->orderBy(['views'=>SORT_DESC])->limit(10)->all();
				

				//友情链接
				$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();

				$message="友链申请成功，请等待博主的审核！";
				return $this->render('linkreply',[
						'mylabels'=>$mylabels,
						'uid'=>$uid,
						'categories'=>$categories,
						'rand_articles'=>$rand_articles,
						'hotuser'=>$hotuser,
						'session_uid'=>$session_uid,
						'newliuyans'=>$newliuyans,
						'mosthits'=>$mosthits,
						'myinfo'=>$myinfo,
						'message'=>$message,
						'links'=>$links,
						'hotalbums'=>$hotalbums,
						'follow_message'=>$follow_message,
						'follow_count'=>$follow_count,
						'fans_count'=>$fans_count,
					]);
		}else{
			echo "非法访问";
			return;
		}
	}
}
 ?>