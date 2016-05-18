<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\Fans;
use app\models\admin\User;
use app\models\admin\Category;
use app\models\admin\Liuyan;
use app\models\admin\Login;
use yii\data\Pagination;
use app\controllers\admin\CommonController;
use app\models\admin\Article;
use app\models\admin\Link;
use app\models\admin\Album;
/**
* 关注和粉丝控制器
*/
class FansController extends BaseController
{
	//异步添加和移除关注（在主页面右边栏添加，不是在关注人列表和粉丝列表）
	public function actionAddFollow(){
		$uid=$_GET['uid'];
		$value=$_POST['value'];
		$fansuid=$this->ReturnSession('uid');
		//请求关注的人信息(即作为粉丝)
		$fans_user=User::findOne(['id'=>$fansuid]);
		if($value=="关注"){
			//如果是关注,就写入数据表中,请求人是粉丝，被关注人是关注的对象
			$fansname=$this->ReturnSession('username');
			//被关注人的信息（即作为关注人）
			$mudi_user=User::findOne(['id'=>$uid]);
			$mudi_username=$mudi_user->username;
			$mudi_sex=$mudi_user->sex;
			$mudi_headimage=$mudi_user->headimage;
			$fans=new Fans;
			$fans->fans=$fansname;
			$fans->fans_uid=$fansuid;
			$fans->fans_sex=$fans_user->sex;
			$fans->fans_headimage=$fans_user->headimage;
			$fans->follow=$mudi_username;
			$fans->follow_uid=$uid;
			$fans->follow_sex=$mudi_sex;
			$fans->follow_headimage=$mudi_headimage;
			if($fans->save()){
				//关注成功,判断对方是否关注了我，返回不同的数据，用于显示相互关注和已关注
				//查询条件即是对方是粉丝，关注人是我
				$check_fans=Fans::find()->where(['fans_uid'=>$fans->follow_uid])->andWhere(['follow_uid'=>$fans->fans_uid])->one();
				if($check_fans){
					//相互关注
					return 2;
				}else{
					//已关注
					return 1;
				}
			}else{
				//关注失败
				return 0;
			}

		}else{
			//取消关注
			$fans=Fans::find()->where(['fans_uid'=>$fansuid])->andWhere(['follow_uid'=>$uid])->one();
			if($fans){
				if($fans->delete()){
				//取消关注成功
				return 3;
				}else{
				//取消关注失败
				return 4;
				}
			}
		}
	}

	//异步添加和移除关注（在关注人列表和粉丝列表）
	public function actionAddFollowList(){
		$uid=$_POST['uid'];
		$value=$_POST['value'];
		$fansuid=$this->ReturnSession('uid');
		//请求关注的人信息(即作为粉丝)
		$fans_user=User::findOne(['id'=>$fansuid]);
		if($value=="关注"){
			//如果是关注,就写入数据表中,请求人是粉丝，被关注人是关注的对象
			$fansname=$this->ReturnSession('username');
			//被关注人的信息（即作为关注人）
			$mudi_user=User::findOne(['id'=>$uid]);
			$mudi_username=$mudi_user->username;
			$mudi_sex=$mudi_user->sex;
			$mudi_headimage=$mudi_user->headimage;
			$fans=new Fans;
			$fans->fans=$fansname;
			$fans->fans_uid=$fansuid;
			$fans->fans_sex=$fans_user->sex;
			$fans->fans_headimage=$fans_user->headimage;
			$fans->follow=$mudi_username;
			$fans->follow_uid=$uid;
			$fans->follow_sex=$mudi_sex;
			$fans->follow_headimage=$mudi_headimage;
			if($fans->save()){
				//关注成功,判断对方是否关注了我，返回不同的数据，用于显示相互关注和已关注
				//查询条件即是对方是粉丝，关注人是我
				$check_fans=Fans::find()->where(['fans_uid'=>$fans->follow_uid])->andWhere(['follow_uid'=>$fans->fans_uid])->one();
				if($check_fans){
					//相互关注
					return 2;
				}else{
					//已关注
					return 1;
				}
			}else{
				//关注失败
				return 0;
			}

		}else{
			//取消关注
			$fans=Fans::find()->where(['fans_uid'=>$fansuid])->andWhere(['follow_uid'=>$uid])->one();
			if($fans){
				if($fans->delete()){
				//取消关注成功
				return 3;
				}else{
				//取消关注失败
				return 4;
				}
			}
		}
	}


	//关注列表
	public function actionFollowList(){
		$session_uid=$this->ReturnSession('uid');
		if($session_uid){
			//如果存在session，查询出用户信息
			$user=Login::findOne(['id'=>$session_uid]);
		}else{
			$user=false;
		}
		$uid=$_GET['uid'];
		//查找全部关注人信息
		$data=Fans::find()->where(['fans_uid'=>$uid]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>10,
			]);
		$follows=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['addtime'=>SORT_DESC])->all();
		//查找是否是相互关注(本人博客自己查看)
		$checkeachfollow=array();
		foreach ($follows as $follow) {
			$check=Fans::find()->where(['fans_uid'=>$follow->follow_uid])->andWhere(['follow_uid'=>$follow->fans_uid])->one();
			if($check){
				$checkeachfollow[]=2;
			}else{
				$checkeachfollow[]=1;
			}
		}

		//查找是否是相互关注（其他用户查看该博客用户的关注列表时。查询的相互关注是
		//其他用户和该关注列表用户的信息）
		$checkotherfollow=array();
		foreach ($follows as $follow) {
			//查看是否已经关注
			$checkfollow=Fans::find()->where(['fans_uid'=>$session_uid])->andWhere(['follow_uid'=>$follow->follow_uid])->one();
			if($checkfollow){
				$check=Fans::find()->where(['fans_uid'=>$follow->follow_uid])->andWhere(['follow_uid'=>$session_uid])->one();
				if($check){
					//相互关注
					$checkotherfollow[]=2;
				}else{
					//已关注
					$checkotherfollow[]=1;
				}
			}else{
				//未关注(包括有自己，所以要排除)
				if($follow->follow_uid==$session_uid){
					//自己
					$checkotherfollow[]=-1;
				}else{
					$checkotherfollow[]=0;
				}
			}
			
		}

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
		

		//查找本博客用户
		$bloger=Login::findOne(['id'=>$uid]);

		//友情链接
		$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();

		return $this->render('followlist',[
				'follows'=>$follows,
				'checkeachfollow'=>$checkeachfollow,
				'checkotherfollow'=>$checkotherfollow,
				'pages'=>$pages,
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'user'=>$user,
				'bloger'=>$bloger,
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

	//粉丝列表
	public function actionFansList(){
		$session_uid=$this->ReturnSession('uid');
		if($session_uid){
			//如果存在session，查询出用户信息
			$user=Login::findOne(['id'=>$session_uid]);
		}else{
			$user=false;
		}
		$uid=$_GET['uid'];
		//查找全部粉丝信息
		$data=Fans::find()->where(['follow_uid'=>$uid]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>10,
			]);
		$follows=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['addtime'=>SORT_DESC])->all();
		//查找是否是相互关注(本人博客自己查看)
		$checkeachfollow=array();
		foreach ($follows as $follow) {
			$check=Fans::find()->where(['fans_uid'=>$uid])->andWhere(['follow_uid'=>$follow->fans_uid])->one();
			if($check){
				//相互关注
				$checkeachfollow[]=2;
			}else{
				//没有关注
				$checkeachfollow[]=0;
			}
		}

		//查找是否是相互关注（其他用户查看该博客用户的关注列表时。查询的相互关注是
		//其他用户和该关注列表用户的信息）
		$checkotherfollow=array();
		foreach ($follows as $follow) {
			//查看是否已经关注
			$checkfollow=Fans::find()->where(['fans_uid'=>$session_uid])->andWhere(['follow_uid'=>$follow->follow_uid])->one();
			if($checkfollow){
				$check=Fans::find()->where(['fans_uid'=>$follow->follow_uid])->andWhere(['follow_uid'=>$session_uid])->one();
				if($check){
					//相互关注
					$checkotherfollow[]=2;
				}else{
					//已关注
					$checkotherfollow[]=1;
				}
			}else{
				//未关注(包括有自己，所以要排除)
				if($follow->follow_uid==$session_uid){
					//自己
					$checkotherfollow[]=-1;
				}else{
					$checkotherfollow[]=0;
				}
			}
			
		}

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
		

		//查找本博客用户
		$bloger=Login::findOne(['id'=>$uid]);

		//友情链接
		$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();

		return $this->render('fanslist',[
				'follows'=>$follows,
				'checkeachfollow'=>$checkeachfollow,
				'checkotherfollow'=>$checkotherfollow,
				'pages'=>$pages,
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'user'=>$user,
				'bloger'=>$bloger,
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


}

 ?>