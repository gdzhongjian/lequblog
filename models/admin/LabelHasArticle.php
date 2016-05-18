<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;

/**
* 标签和文章关联表
*/
class LabelHasArticle extends ActiveRecord
{
	public static function tableName(){
		return 'label_has_article';
	}

	public function rules(){
		return [
			[['label_id','article_id'],'required']
		];
	}

	//关联模型label_has_article和article表,多对一
	public function getArticle(){
		return $this->hasOne(Article::className(),['article_id'=>'id']);
	}

	//关联模型label_has_article和label表,多对一
	public function getLabel(){
		return $this->hasOne(Label::className(),['label_id'=>'id']);
	}
}
 ?>