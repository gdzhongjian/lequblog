<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;
/**
* 文章模型
*/
class Article extends ActiveRecord
{
	public static function tableName(){
		return 'article';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->post_time=time();
				$this->edit_time=time();
				$this->post_ip=Yii::$app->request->userIP;
				$this->edit_ip=Yii::$app->request->userIP;
			}else{
				$this->edit_time=time();
				$this->edit_ip=Yii::$app->request->userIP;
			}
			return true;
		}
		return false;
	}

	public function rules(){
		return [
			[['title','tag_id','keyword','remark','content','type','istop','original','hits','author','article_location'],'required'],
			[['picture','from','uid'],'safe']
		];
	}

	//关联模型
	public function getCategory(){
		return $this->hasOne(Category::className(),['id'=>'tag_id']);
	}

	// //关联模型,article和label_has_article表,一对多
	// public function getLabelHasArticle(){
	// 	return $this->hasMany(LabelHasArticle::className(),['id'=>'article_id']);
	// }


	
}
 ?>