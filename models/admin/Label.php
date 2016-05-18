<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 标签表模型
*/
class Label extends ActiveRecord
{
	public static function tableName(){
		return 'label';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->post_time=time();
				$this->post_ip=Yii::$app->request->userIP;
			}
			return true;
		}
		return false;
	}

	public function rules(){
		return [
			['name','required'],
			['name','unique'],
		];
	}

	// //关联模型,label表和label_has_article表，一对多
	// public function getLabel_has_articles(){
	// 	return $this->hasMany(LabelHasArticle::className(),['label_id'=>'id']);
	// }

	//关联模型，label表和article表通过中间表label_has_article表连接
	public function getArticles(){
		return $this->hasMany(Article::className(),['id'=>'article_id'])->viaTable('label_has_article',['label_id'=>'id'])->orderBy(['istop'=>SORT_DESC,'post_time'=>SORT_DESC])->where(['type'=>0]);
	}

}

 ?>