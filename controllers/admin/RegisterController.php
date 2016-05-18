<?php 
namespace app\controllers\admin;
use Yii;
use yii\web\Controller;
use app\models\admin\Register;
use yii\db\Command;
use yii\helpers\Url;
/**
* 后台注册控制器
*/
class RegisterController extends CommonController
{
	
	public $layout=false;
	public $enableCsrfValidation=false;
	public function actionIndex(){
		return $this->render('index');
	}


	public function actionCheckRegister(){
		$model=new Register;
		$model->attributes=Yii::$app->request->post('Register');
		if($model->validate()){
			if($model->save()){
			//插入随机字符串表
				$connection=Yii::$app->db;
				//取全局变量，插入随机表
				$salt1=Yii::$app->params['salt1'];
				$salt3=Yii::$app->params['salt3'];
				//取上一次插入的主码
				$uid=$connection->getLastInsertID();
				$command=$connection->createCommand()->insert('rand',[
						'salt1'=>$salt1,
						'salt3'=>$salt3,
						'uid'=>$uid,
					])->execute();
				$command=$connection->createCommand()->delete($uid);

				//获取邮箱验证识别码
				$message=Register::findOne($uid);
				$token=$message->token;
				$username=$message->username;
				$email=$message->email;
				$url=Yii::$app->request->getHostInfo().Url::toRoute('admin/register/activate').'&uid='.$uid.'&token='.$token;
				//发送邮件
				$mail=Yii::$app->mailer->compose();
				$mail->setTo($email);
				$mail->setSubject('乐趣博客注册');
				$mail->setHtmlBody("亲爱的".$username.":<br>感谢您注册乐趣博客新账号！<br>请点击链接激活您的账号。<br>
					<a href='".$url."'>".$url."</a><br>
					如果以上链接无法点击，请将它复制到你的浏览器地址栏中进行访问，该链接24小时内有效！
					");
				if($mail->send()){
					return $this->render('../error',['error'=>'注册成功！请到邮箱激活账号！','errormsg'=>'如果收件箱没有收到邮件，请查看垃圾箱。','login'=>false]);
				}else{
					return $this->render('../error',['error'=>'注册成功！激活邮件发送失败！','errormsg'=>'Something went wrong.','login'=>false]);
				}

			}else{
				return $this->render('../error',['error'=>'注册失败！','errormsg'=>'','login'=>false]);
			}
		}else{
			return $this->render('../error',['error'=>'注册信息填写错误，请重试！','errormsg'=>'','login'=>false]);
		}
		// $ip=Yii::$app->request->userIP;
		// return $this->render('test',['error'=>$ip]);
		
	}

	/*
	邮箱注册激活验证
	 */
	public function actionActivate($uid,$token){
		$current_time=time();
		$userinfo=Register::findOne($uid);
		if($userinfo->token_status==1){
			return $this->render('../error',['error'=>'该账号已被激活，无需再次激活！','errormsg'=>'','login'=>true]);
		}else{
			if($userinfo->token==$token){
				if($current_time>$userinfo->token_exptime){
					$userinfo->delete();
					return $this->render('../error',['error'=>'该链接已经失效，请重新注册！','errormsg'=>'','login'=>false]);
				}else{
					//设置已激活
					$userinfo->token_status=1;
					if($userinfo->save()){
					return $this->render('../error',['error'=>'激活成功！请登录！','errormsg'=>'','login'=>true]);
					}else{
						// var_dump($userinfo->getErrors());
						// return;
						$uid=$userinfo->id;
						$connection=Yii::$app->db;
						$rand=$connection->createCommand()->delete('rand','uid='.$uid)->execute();
						$userinfo->delete();
						return $this->render('../error',['error'=>'激活失败！请重新注册！','errormsg'=>'','login'=>false]);
						// print_r($userinfo->getErrors());
					}
				}
			}
		}
		return $this->render('../error',['error'=>$userinfo->token_status,'errormsg'=>'','login'=>true]);
		
		
		
	}


	//异步查询用户名是否存在
	public function actionCheckUsername(){
		$user=Yii::$app->request->post();
		$model=new Register;
		$findUser=$model->findByUsername($user['user']);
		if ($findUser){
			return 1;
		}else{
			return 0;
		}
	}

	//异步查询邮箱是否存在
	public function actionCheckEmail(){
		$email=Yii::$app->request->post();
		$model=new Register;
		$findEmail=$model->findByEmail($email['email']);
		if($findEmail){
			return 1;
		}else{
			return 0;
		}
	}


	public function actionTest($uid=1){
		echo $uid;		
	}


	/*
	生成随机字符串,用于对密码进行加密
	 */
	public static function RandStrings(){
		$str="0123456789abcdefghijklmnopqrstuvwxyz";  //使用的字符串
		$n=20;  //产生的随机数的长度
		$s='';  //产生的随机数字符串
		$len=strlen($str)-1;
		for($i=0;$i<$n;$i++){
			$s.=$str[rand(0,$len)];
		}
		//产生的$s即是长度为20位的随机字符串
		return $s;
	}

	/*
	加密函数
	 */
	public static function EncryptionPassword($password){
		//对密码进行加密
		$salt1=RegisterController::RandStrings();
		$salt2=md5($password);
		$salt3=RegisterController::RandStrings();
		Yii::$app->params['salt1']=$salt1;
		Yii::$app->params['salt3']=$salt3;
		$salt=$salt1.$salt2.$salt3;
		$password=md5($salt);
		return $password;
	}
}
 ?>