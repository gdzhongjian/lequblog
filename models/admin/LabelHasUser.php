<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;

/**
* 用户表和标签表关联模型
*/
class LabelHasUser extends ActiveRecord
{
	public static function tableName(){
		return 'label_has_user';
	}

	public function rules(){
		return [
			[['label_id','user_id'],'required']
		];
	}
}

 ?>