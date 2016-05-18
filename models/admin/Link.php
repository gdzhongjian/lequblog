<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 友链模型
*/
class Link extends ActiveRecord
{
	public static function tableName(){
		return 'link';
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
			[['name','url','remark','email'],'required'],
			[['ispass','level','type'],'safe'],
		];
	}
}

 ?>