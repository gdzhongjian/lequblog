<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 留言回复模型
*/
class Guestbook_reply extends ActiveRecord
{
	
	public static function tableName(){
		return 'guestbook_reply';
	}
}

 ?>