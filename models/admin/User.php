<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;
use app\models\admin\Liuyan;
/**
* 用户模型，主要用于用户修改个人资料和密码
*/
class User extends ActiveRecord
{
	public $password1;

	public static function tableName(){
		return 'user';
	}

	public function rules(){
		return [
			['username','unique'],
			['views','safe'],
			['brief','safe']
		];
	}

	public function scenarios(){
		return [
			'edit'=>['username','headimage','sex','brief'],
			'change_password'=>['password','password1']
		];
	}

}

 ?>