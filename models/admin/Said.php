<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;
use app\controllers\admin\CommonController;
/**
* 说说模型
*/
class Said extends ActiveRecord
{
	
	public static function tableName(){
		return 'said';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$common=new CommonController('','','');
				$this->post_ip=Yii::$app->request->userIP;
				$post_ip_location=$common->getIPLocation($this->post_ip);
				if(is_array($post_ip_location)){
					$this->post_location=$post_ip_location['country'].$post_ip_location['province'].$post_ip_location['city'];
				}else{
					$this->post_location=$post_ip_location;
				}
				$this->post_time=time();
				$this->edit_ip=Yii::$app->request->userIP;
				$edit_ip_location=$common->getIPLocation($this->edit_ip);
				if(is_array($edit_ip_location)){
					$this->edit_location=$edit_ip_location['country'].$edit_ip_location['province'].$edit_ip_location['city'];
				}else{
					$this->edit_location=$edit_ip_location;
				}
				$this->edit_time=time();
			}else{
				$this->edit_ip=Yii::$app->request->userIP;
				$common=new CommonController('','','');
				$edit_ip_location=$common->getIPLocation($this->edit_ip);
				if(is_array($edit_ip_location)){
					$this->edit_location=$edit_ip_location['country'].$edit_ip_location['province'].$edit_ip_location['city'];
				}else{
					$this->edit_location=$edit_ip_location;
				}
				$this->edit_time=time();
			}

			return true;
		}
		return false;
	}

	public function rules(){
		return [
			[['content','type','istop','from','uid','title'],'required','on'=>'add'],
			[['content','type','istop','from','title'],'required','on'=>'edit']
		];
	}

	public function scenarios(){
		return [
			'add'=>['content','type','istop','from','uid','title'],
			'edit'=>['content','type','istop','from','title']
		];
	}
}
 ?>