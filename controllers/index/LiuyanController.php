<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\Category;
use app\models\admin\Liuyan;
use app\models\admin\Login;
use yii\data\Pagination;
use app\controllers\admin\CommonController;
use app\models\admin\Article;
use yii\db\Command;
use app\models\admin\User;
use app\models\admin\Link;
use app\models\admin\Album;
use app\models\admin\Fans;
/**
* 留言板控制器
*/
class LiuyanController extends BaseController
{
	
	public function actionIndex(){
		$session_uid=$this->ReturnSession('uid');
		if($session_uid){
			//如果存在session，查询出用户信息
			$user=Login::findOne(['id'=>$session_uid]);
		}else{
			$user=false;
		}
		$uid=$_GET['uid'];
		//查找全部留言
		$data=Liuyan::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>10,
			]);
		$liuyans=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['guest_time'=>SORT_DESC])->all();
		
		//查找当前用户的留言回复
		$connect=Yii::$app->db;
		$command=$connect->createCommand('SELECT * FROM guestbook_reply WHERE uid=:uid');
		$command->bindParam(':uid',$uid);
		$guestbook_replies=$command->queryAll();

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

		return $this->render('index',[
				'liuyans'=>$liuyans,
				'pages'=>$pages,
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'user'=>$user,
				'guestbook_replies'=>$guestbook_replies,
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


	//留言处理控制器
	public function actionCheckLiuyan(){
		$post=Yii::$app->request->post();
		//获取ip,地址
		$ip=Yii::$app->request->userIP;
		$post['guest_ip']=$ip;
		$location=$this->getIPLocation($ip);
		if(is_array($location)){
			$post['guest_location']=$location['country'].$location['province'].$location['city'];
		}else{
			$post['guest_location']=$location;
		}
		//如果用户没有头像，临时留言,同时设置guest_id为-1 
		if(!isset($post['guest_picture'])){
			$rand=rand(1,100);
			$post['guest_picture']='public/image/headimage/temporaryuser/'.$rand.'.jpg';
			$post['ishidden']=0;
			$post['guest_id']=-1;
		}else{
			//存在登录用户留言
			$post['ishidden']=1;
		}
		//获取客户端
		$common=new CommonController('','','');
		$os=$common->getOS();
		$post['guest_from']=$os;

		//留言所属用户
		$uid=$_GET['uid'];
		$user=Login::findOne(['id'=>$uid]);
		$post['uid']=$uid;
		$post['author']=$user->username;

		$liuyan=new Liuyan;
		$liuyan->attributes=$post;
		if($liuyan->save()){
			return $this->redirect(array('index/liuyan/index','uid'=>$uid));
		}else{
			echo "留言失败！";
			var_dump($liuyan->getErrors());
		}


	}
}

 ?>