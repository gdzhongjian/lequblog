<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;
/**
* 后台登录模型
*/
class Login extends ActiveRecord
{
	
	public $check;

	public static function tableName(){
		return 'user';
	}


	//验证规则
	public function rules(){
		return [
			[['email','password'],'required'],
			['password','string','length'=>[6,65]],
			['email','email']
		];
	}
}

 ?>