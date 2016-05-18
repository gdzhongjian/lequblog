<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 粉丝表模型
*/
class Fans extends ActiveRecord
{
	public static function tableName(){
		return 'fans';
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
			[['follow','follow_uid','fans','fans_uid','fans_sex','fans_headimage','follow_sex','follow_headimage'],'required']
		];
	}
}

 ?>