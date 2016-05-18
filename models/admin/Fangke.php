<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 访客表模型
*/
class Fangke extends ActiveRecord
{
	
	public static function tableName(){
		return 'fangke';
	}

	public function rules(){
		return [
			[['fangke_username','fangke_headimage','fangke_time','fangke_uid','uid'],'required'],
		];
	}
}

 ?>