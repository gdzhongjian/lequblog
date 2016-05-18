<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 图片模型
*/
class Picture extends ActiveRecord
{
	public static function tableName(){
		return 'picture';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->addtime=time();
			}
			return true;
		}
		return false;
	}
	public function rules(){
		return [
			[['url','album_id','istop'],'required'],
		];
	}
}

 ?>