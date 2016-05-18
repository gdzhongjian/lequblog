<?php 
namespace app\models\admin;

use yii\db\ActiveRecord;

/**
* 栏目模型
*/
class Category extends ActiveRecord
{
	
	public static function tableName(){
		return 'tag';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->addtime=time();
				$this->edit_time=time();
				
			}else{
				$this->edit_time=time();
			}
			return true;
		}
		return false;
	}
	public function rules(){
		return [
			[['name','remark','open','uid'],'required','on'=>'add'],
			['name','unique','on'=>'add'],
			[['name','remark','open','uid','id'],'required','on'=>'update'],
			['name','unique','on'=>'update']
		];
	}

	public function scenarios(){
		return [
			'add'=>['name','remark','open','uid'],
			'update'=>['name','remark','open','uid','id']
		];
	}


	//根据栏目名称返回数据
	public static function findByName($name){
		return static::findOne(['name'=>$name]);
	}

	//根据栏目外码（用户主码）返回数据
	public static function findByUid($uid){
		return static::findAll(['uid'=>$uid]);
	}


	//关联模型
	public function getArticles(){
		//分类和文章建立一对多关系
		return $this->hasMany(Article::className(),['tag_id'=>'id']);
	}
}
 ?>