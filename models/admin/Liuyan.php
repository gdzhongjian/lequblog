<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;
/**
* 留言模型
*/
class Liuyan extends ActiveRecord
{
	
	public static function tableName(){
		return 'guestbook';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->guest_time=time();
			}
			return true;
		}
		return false;
	}

	public function rules(){
		return [
			[['guest_author','guest_email','guest_content','guest_location','guest_ip','guest_picture','guest_from','guest_id','author','uid','ishidden'],'required'],
		];
	}
}
 ?>