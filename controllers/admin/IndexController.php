<?php 
namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\admin\Login;
use app\models\admin\Album;
use app\models\admin\Article;
use app\models\admin\Said;
use yii\helpers\Url;
use app\models\admin\Liuyan;

/**
* 后台主页控制器
*/
class IndexController extends CommonController
{
	
	// public $layout=false;

	public function actionIndex(){
		$session=Yii::$app->session;
		$uid=$session->get('uid');
		//查询相册总数，文章总数，说说总数，留言总数
		$albumcount=Album::find()->where(['uid'=>$uid])->count();
		$articlecount=Article::find()->where(['uid'=>$uid])->count();
		$saidcount=Said::find()->where(['uid'=>$uid])->count();
		$liuyancount=Liuyan::find()->where(['uid'=>$uid])->count();
		$personal_website=Yii::$app->request->getHostInfo().Url::toRoute('index/index/index').'&uid='.$uid;
		$userinfo=Login::findOne($uid);
		//获取上次登录地点
		$last_location=$this->getIPLocation($userinfo['last_ip']);
		if(is_array($last_location)){
			$last_location=$last_location['country'].$last_location['province'].$last_location['city'];
		}

		$user_headimage=$userinfo['headimage'];
		$username=$session->get('username');
		//查询当前留言未读消息
		$weidu_liuyan_count=Liuyan::find()->where(['uid'=>$uid])->andWhere(['isread'=>0])->count();
		$weidu_liuyans=Liuyan::find()->where(['uid'=>$uid])->andWhere(['isread'=>0])->orderBy(['guest_time'=>SORT_DESC])->limit(5)->all();

		return $this->render('index',[
			'userinfo'=>$userinfo,
			'last_location'=>$last_location,
			'user_headimage'=>$user_headimage,
			'username'=>$username,
			'albumcount'=>$albumcount,
			'articlecount'=>$articlecount,
			'saidcount'=>$saidcount,
			'liuyancount'=>$liuyancount,
			'personal_website'=>$personal_website,
			'weidu_liuyan_count'=>$weidu_liuyan_count,
			'weidu_liuyans'=>$weidu_liuyans,
			]);
	}

	//退出系统
	public function actionExit(){
		$exit=CommonController::ExitSystem();
		if($exit){
			return $this->redirect(array('admin/login/index'));
		}else{
			return $this->render('../error',['error'=>'退出失败!','errormsg'=>'','login'=>true]);
		}
	}

}
 ?>