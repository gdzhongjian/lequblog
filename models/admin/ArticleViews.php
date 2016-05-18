<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;
/**
* 文章阅读数模型
*/
class ArticleViews extends ActiveRecord
{
	
	public static function tableName(){
		return 'article';
	}

	public function rules(){
		return [
			['hits','safe']
		];
	}
}

 ?>