<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\LabelHasUser;
use app\models\admin\Label;
use app\models\admin\Fangke;
use app\models\admin\Login;
use app\models\admin\Register;
use app\models\admin\User;
/**
* 前台公共控制器
*/
class BaseController extends Controller
{
	public $layout='index';
	public $enableCsrfValidation=false;

	//判断是否已经登陆
	public function IsLogin(){
		$session=Yii::$app->session;
		$cookies=Yii::$app->request->cookies;
		if($session->get('uid')){
			return true;
		}else if(($cookie=$cookies->get('lequbloguser'))!=null) {
			//解密cookie，设置session
			$secretkey=Yii::$app->params['secretkey'];
			$userEmail=Yii::$app->getSecurity()->decryptByPassword($cookie,$secretkey);
			$model=new Register;
			$user=$model->findByEmail($userEmail);
			$session=Yii::$app->session;
			if(!$session->isActive){
				$session->open();
			}
			$session->set('uid',$user->id);
			$session->set('username',$user->username);
			return true;
		}else{
			return false;
		}
	}


	//获取session
	public function ReturnSession($name){
		$session=Yii::$app->session;
		return $session->get($name);
	}


	//查找我的标签
	public function MyLabel($uid){
		$label_has_users=LabelHasUser::findAll(['user_id'=>$uid]);
		$mylabels=array();
		foreach ($label_has_users as $label_has_user) {
			$label=Label::findOne(['id'=>$label_has_user->label_id]);
			$mylabels[]=$label;
		}
		return $mylabels;
	}


	/* 
 	 *根据新浪IP查询接口获取IP所在地 
 	*/ 

	public	function getIPLocation($ip=''){ 
		if(empty($ip)){  
	        $ip = Yii::$app->request->userIP;  
	    }
	    if($ip=="127.0.0.1"){
	    	return $address="本机地址";
	    }
	    if($ip=="::1"){
	    	return $address="本机地址";
	    }   
	    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
	    if(empty($res)){ return false; }  
	    $jsonMatches = array();  
	    preg_match('#\{.+?\}#', $res, $jsonMatches);  
	    if(!isset($jsonMatches[0])){ return false; }  
	    $json = json_decode($jsonMatches[0], true);  
	    if(isset($json['ret']) && $json['ret'] == 1){  
	        $json['ip'] = $ip;  
	        unset($json['ret']);  
	    }else{  
	        return false;  
	    }  
	    return $json;  
	}

	//init函数
	public function init(){
		//判断是否直接点击首页（直接点击首页按钮默认不记录访问情况），或者是登录
		if(isset($_GET['uid'])){
			$uid=$_GET['uid'];
			$session_uid=$this->ReturnSession('uid');
			if($session_uid){
				if($session_uid!=$uid){
					//访问的博客不是本人博客,把用户信息记录访客表中
					
					//判断是否存在该用户登录记录，如果存在就只改变最近时间
					$checkFangke=Fangke::find()->where(['fangke_uid'=>$session_uid])->andWhere(['uid'=>$uid])->one();
					if($checkFangke){
						$checkFangke->fangke_time=time();
						if($checkFangke->save()){
							// echo "访客记录更新成功";
						}else{
							// echo "访客记录更新失败";
						}
					}else{
						$fangkeinfo=Login::findOne(['id'=>$session_uid]);
						$post=array();
						$post['fangke_username']=$fangkeinfo['username'];
						$post['fangke_headimage']=$fangkeinfo['headimage'];
						$post['fangke_uid']=$fangkeinfo['id'];
						$post['fangke_time']=time();
						$post['uid']=$uid;
						$fangke=new Fangke;
						$fangke->attributes=$post;
						if($fangke->save()){
							// echo "chenggong";
						}else{
							// echo "shibai";
						}
					}
					//该博客被访问次数加1
					$user=User::findOne(['id'=>$uid]);
					$user->scenario="edit";
					$user->views++;
					$user->save();

				}else{
					// echo "是我的博客";
				}
			}else{
				// echo "我没有登录";
				// 该博客访问次数加1
				$user=User::findOne(['id'=>$uid]);
				$user->scenario="edit";
				$user->views++;
				$user->save();
			}
			return;
		}
		
	} 
}
 ?>