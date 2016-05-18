<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;
use app\controllers\admin\RegisterController;
/**
* 后台注册模型
*/
class Register extends ActiveRecord
{
	
	public $password1;

	public static function tableName(){
		return 'user';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->headimage='public/image/headimage/default/1.jpg';
				$this->token_status=0;
				$this->register_time=time();
				$this->last_time=time();
				$this->this_time=time();
				$this->token_exptime=time()+3600*24;
				$this->last_ip=\Yii::$app->request->userIP;
				$this->this_ip=\Yii::$app->request->userIP;
				$this->password=RegisterController::EncryptionPassword($this->password);
				$this->password=\Yii::$app->getSecurity()->generatePasswordHash($this->password);  //密码加密
				$this->token=md5($this->username.$this->password.$this->register_time);  //激活验证码
			}
			return true;
		}
		return false;
	}

	//验证规则
	public function rules(){
		return [
			[['username','password','email'],'required'],
			[['username','email','password','password1'],'trim'],
			['email','email','message'=>'邮箱格式不正确！'],
			[['password','password1'],'string','length'=>[6,65]],
			['password','safe'],
			['token_status','safe'],
			['password1','compare','compareAttribute'=>'password','message'=>'请重复输入密码'],
			['username','unique'],
			['email','unique']
		];
	}

	//根据用户名查找
	public static function findByUsername($username){
		return static::findOne(['username'=>$username]);
	}

	//根据邮箱查找
	public static function findByEmail($email){
		return static::findOne(['email'=>$email]);
	}

	

}

 ?>