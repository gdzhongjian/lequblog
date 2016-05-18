<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 相册模型
*/
class Album extends ActiveRecord
{
	
	public static function tableName(){
		return 'album';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->addtime=time();
				$this->addip=Yii::$app->request->userIP;
				$this->edittime=time();
				$this->editip=Yii::$app->request->userIP;
			}else{
				$this->edittime=time();
				$this->editip=Yii::$app->request->userIP;
			}
			return true;
		}
		return false;
	}

	public function rules(){
		return [
			[['name','url','star','status','from','uid'],'required','on'=>'add'],
			['name','unique'],
			[['name','star','status','from'],'required','on'=>'edit'],
			['url','safe','on'=>'edit'],
			['views','safe']
		];
	}

	public function scenarios(){
		return [
			'add'=>['name','url','star','status','from','uid'],
			'edit'=>['name','url','star','status','from']
		];
	}
}
 ?>