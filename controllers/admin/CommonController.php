<?php 
namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\admin\Register;

/**
* 公共控制器
*/
class CommonController extends Controller
{
	public $layout='main';
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

	//判断当前博客是否是本人博客
	public function IsUser(){
		$blog_userid=Yii::$app->request->get('uid');
		$session=Yii::$app->session;
		$current_uid=$session->get('uid');
		if($blog_userid==$current_uid){
			//本人博客
			return 1;
		}else{
			return 0;
		}
	}

	//获取session值
	public function GetSession(){
		$session=Yii::$app->session;
		if($session->get('uid')){
			return $session->get('uid');
		}else{
			return false;
		}
	}

	//退出系统
	public function ExitSystem(){
		$session=Yii::$app->session;
		$cookies=Yii::$app->response->cookies;    //response用于创建删除cookie，request用于获取cookie
		if($session->get('uid')){
			$session->remove('uid');
			$cookies->remove('lequbloguser');
			return true;
		}else{
			return false;
		}

	}
	//查询邮箱是否存在
	public function IsExistEmail($email){
		$model=new Register;
		$findEmail=$model->findByEmail($email);
		if($findEmail){
			return 1;
		}else{
			return 0;
		}
	}

	//初始化函数
	public function init(){
		// if(!$this->IsLogin()){
		// 	return $this->render('../login/index');
		// }
	}

	//获取session
	public function ReturnSession($name){
		$session=Yii::$app->session;
		return $session->get($name);
	}


	// 获取操作系统
    public function getOS() {
		$os = '';
		$Agent = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/win/i', $Agent) && strpos($Agent, '95')) {
			$os = 'Win 95';
		} elseif (preg_match('/win 9x/i', $Agent) && strpos($Agent, '4.90')) {
			$os = 'Win ME';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/98/', $Agent)) {
			$os = 'Win 98';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 5.0/i', $Agent)) {
			$os = 'Win 2000';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.0/i', $Agent)) {
			$os = 'Win Vista';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.1/i', $Agent)) {
			$os = 'Win 7';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 5.1/i', $Agent)) {
			$os = 'Win XP';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.2/i', $Agent)) {
			$os = 'Win 8';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 6.3/i', $Agent)) {
			$os = 'Win 8.1';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt 10/i', $Agent)) {
			$os = 'Win 10';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/nt/i', $Agent)) {
			$os = 'Win NT';
		} elseif (preg_match('/win/i', $Agent) && preg_match('/32/', $Agent)) {
			$os = 'Win 32';
		} elseif (preg_match('/Mi/i', $Agent)) {
			$os = '小米';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/LG/', $Agent)) {
			$os = 'LG';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/M1/', $Agent)) {
			$os = '魅族';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/MX4/', $Agent)) {
			$os = '魅族4';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/M3/', $Agent)) {
			$os = '魅族';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/M4/', $Agent)) {
			$os = '魅族';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/Huawei/', $Agent)) {
			$os = '华为';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/HM201/', $Agent)) {
			$os = '红米';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/KOT/', $Agent)) {
			$os = '红米4G版';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/NX5/', $Agent)) {
			$os = '努比亚';
		} elseif (preg_match('/Android/i', $Agent) && preg_match('/vivo/', $Agent)) {
			$os = 'Vivo';
		} elseif (preg_match('/Android/i', $Agent)) {
			$os = 'Android';
		} elseif (preg_match('/linux/i', $Agent)) {
			$os = 'Linux';
		} elseif (preg_match('/unix/i', $Agent)) {
			$os = 'Unix';
		} elseif (preg_match('/iPhone/i', $Agent)) {
			$os = '苹果';
		} else if (preg_match('/sun/i', $Agent) && preg_match('/os/i', $Agent)) {
			$os = 'SunOS';
		} elseif (preg_match('/ibm/i', $Agent) && preg_match('/os/i', $Agent)) {
			$os = 'IBM OS/2';
		} elseif (preg_match('/Mac/i', $Agent) && preg_match('/PC/i', $Agent)) {
			$os = 'Macintosh';
		} elseif (preg_match('/PowerPC/i', $Agent)) {
			$os = 'PowerPC';
		} elseif (preg_match('/AIX/i', $Agent)) {
			$os = 'AIX';
		} elseif (preg_match('/HPUX/i', $Agent)) {
			$os = 'HPUX';
		} elseif (preg_match('/NetBSD/i', $Agent)) {
			$os = 'NetBSD';
		} elseif (preg_match('/BSD/i', $Agent)) {
			$os = 'BSD';
		} elseif (preg_match('/OSF1/', $Agent)) {
			$os = 'OSF1';
		} elseif (preg_match('/IRIX/', $Agent)) {
			$os = 'IRIX';
		} elseif (preg_match('/FreeBSD/i', $Agent)) {
			$os = 'FreeBSD';
		} elseif ($os == '') {
			$os = 'Unknown';
		}
		return $os;
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
	
}

 ?>