<?php 

namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\admin\Login;
use app\models\admin\Register;
use yii\db\Command;
use yii\helpers\Url;



/**
* 后台登录控制器
*/
class LoginController extends CommonController
{

	public function actionIndex(){
		$this->layout=false;
		//判断是否登陆
		$isLogin=CommonController::IsLogin();
		if($isLogin){
			//获取session
			$uid=CommonController::GetSession();
			return $this->redirect(array('admin/index/index','uid'=>$uid));
		}
		return $this->render('index');
	}
	

	/*
	登录检查
	 */
	public function actionCheckLogin(){
		$this->layout=false;
		$model=new Login;
		$model->attributes=Yii::$app->request->post('Register');
		if($model->validate()){
			//判断密码是否正确
			$checkPassword=$this->EncryptionPassword($model->email,$model->password);
			if($checkPassword){
				//判断是否激活
				$user1=new Register;
				$user=$user1->findByEmail($model->email);
				if($user->token_status==1){
					//判断是否锁定用户
					if($user->status==0){
						//判断是否记住密码
						if(isset($_POST['Register']['check'])){
						$secretkey=Yii::$app->params['secretkey'];
						//加密邮箱
						$encryptedEmail=Yii::$app->getSecurity()->encryptByPassword($model->email,$secretkey);
						//设置cookie
						$cookies=Yii::$app->response->cookies;
						$cookies->add(new \yii\web\Cookie([
							'name'=>'lequbloguser',
							'value'=>$encryptedEmail,
							'expire'=>time()+3600*24*30
						]));

						$session=Yii::$app->session;
						//检查session是否开启
						if(!$session->isActive){
							$session->open();
						}
						//设置session
						$uid=$user->id;
						$session->set('uid',$uid);
						$session->set('username',$user->username);
						//更新登录信息
							if($this->UpdateMessage($uid)){
								return $this->redirect(array('admin/index/index'));
							}else{
								return $this->render('../error',['error'=>'登录失败！','errormsg'=>'请重试！','login'=>true]);
							}

						}else{
						//只设置session
						$session=Yii::$app->session;
						if(!$session->isActive){
							$session->open();
						}
						$uid=$user->id;
						$session->set('uid',$uid);
						$session->set('username',$user->username);

						//更新登录信息
							if($this->UpdateMessage($uid)){
								return $this->redirect(array('admin/index/index'));
							}else{
								return $this->render('../error',['error'=>'登录失败！','errormsg'=>'请重试！','login'=>true]);
							}
						return $this->redirect(array('admin/index/index'));
					}
					}else{
						return $this->render('../error',['error'=>'账号被锁定，无法登陆！','errormsg'=>'请联系管理员！','login'=>true]);
					}
				}else{
					return $this->render('../error',['error'=>'账号未激活，无法登陆！','errormsg'=>'请先到邮箱激活账号！','login'=>true]);
				}
				
			}else{
				return $this->render('../error',['error'=>'密码不正确！请重新登录！','errormsg'=>'','login'=>true]);
			}
		}else{
			echo "false";
		}
	}

	//登录信息更新
	public function UpdateMessage($uid){
		$user=Register::findOne($uid);
		$user->last_time=$user->this_time;
		$user->last_ip=$user->this_ip;
		$user->this_ip=Yii::$app->request->userIP;
		$user->this_time=time();
		if($user->save()){
			return true;
		}else{
			return false;
		}
	}


	//异步检查密码是否正确
	public function actionCheckPassword(){
		$email=Yii::$app->request->post();
		//判断密码是否正确
		$result=$this->EncryptionPassword($email['email'],$email['password']);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}

	//对获取的密码进行加密
	public static function EncryptionPassword($email,$password){
		//读取用户的主码和密码
		$model=new Register;
		$user=$model->findByEmail($email);
		$uid=$user->id;
		//读取随机表的salt1和salt3
		$connection=Yii::$app->db;
		$command=$connection->createCommand('SELECT * FROM rand Where uid=:uid');
		$command->bindValue(':uid',$uid);
		$rand=$command->queryOne();
		$salt1=$rand['salt1'];
		$salt2=md5($password);
		$salt3=$rand['salt3'];
		$salt=$salt1.$salt2.$salt3;
		$password1=md5($salt);
		if(Yii::$app->getSecurity()->validatePassword($password1,$user->password)){
			//密码输入正确
			return 1;
		}else{
			return 0;
		}
		
	}


	//找回密码
	public function actionFindPassword(){
		$this->layout=false;
		return $this->render('forget',['error'=>'','email'=>'']);
	}

	//发送邮件找回密码
	public function actionFindPasswordWithEmail(){
		$this->layout=false;
		$data=Yii::$app->request->post();
		$email=$data['email'];
		$is_exist_email=$this->IsExistEmail($email);
		if($is_exist_email==1){
			//邮箱存在时，发送邮件到制定邮箱用户
			$message=Register::findOne(['email'=>$email]);
			$uid=$message->id;
			$token=$message->token;
			$username=$message->username;
			$url=Yii::$app->request->getHostInfo().Url::toRoute('admin/login/reset-password').'&uid='.$uid.'&token='.$token;
			//发送邮件
			$mail=Yii::$app->mailer->compose();
			$mail->setTo($email);
			$mail->setSubject('乐趣博客找回密码');
			$mail->setHtmlBody("亲爱的".$username.":<br>您正在申请找回密码！<br>请点击链接重置您的密码。<br>
				<a href='".$url."'>".$url."</a><br>
				如果以上链接无法点击，请将它复制到你的浏览器地址栏中进行访问，该链接24小时内有效！
				");
			if($mail->send()){
				return $this->render('../error',['error'=>'发送成功！请到邮箱找回密码！','errormsg'=>'如果收件箱没有收到邮件，请查看垃圾箱。','login'=>false]);
			}else{
				return $this->render('../error',['error'=>'找回密码邮件发送失败！','errormsg'=>'Something went wrong.','login'=>false]);
			}

		}else{
			return $this->render('../error',['error'=>'邮箱不存在！','errormsg'=>'','login'=>true]);
		}
	}

	//找回密码视图
	public function actionResetPassword($uid,$token){
		$this->layout=false;
		$userinfo=Register::findOne($uid);
		if($userinfo->token==$token){
			 return $this->render('editpassword',['uid'=>$uid,'email'=>$userinfo->email]);
		}else{
			echo "111";
		}
		
	}

	//找回密码处理
	public function actionChangePassword(){
		$post=Yii::$app->request->post();
		$password=$post['password'];
		$password1=$post['password1'];
		if($password!=$password1){
			return $this->render('../error',['error'=>'两次密码不一致！','errormsg'=>'','login'=>true]);
		}
		$uid=$post['uid'];
		//读取随机表的salt1和salt3
		$connection=Yii::$app->db;
		$command=$connection->createCommand('SELECT * FROM rand Where uid=:uid');
		$command->bindValue(':uid',$uid);
		$rand=$command->queryOne();
		$salt1=$rand['salt1'];
		$salt2=md5($password);
		$salt3=$rand['salt3'];
		$salt=$salt1.$salt2.$salt3;
		$password=md5($salt);

		$model=new Register;
		$user=$model->findOne($uid);
		$user->password=Yii::$app->getSecurity()->generatePasswordHash($password);
		if($user->save()){
			return $this->render('../error',['error'=>'找回密码成功！','errormsg'=>'请重新登录！','login'=>true]);
		}else{
			return $this->render('../error',['error'=>'找回密码失败！','errormsg'=>'','login'=>false]);
		}

	}

}

?>