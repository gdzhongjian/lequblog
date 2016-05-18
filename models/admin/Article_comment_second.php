<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 文章评论模型
*/
class Article_comment_Second extends ActiveRecord
{
	
	public static function tableName(){
		return 'article_comment_second';
	}

	public function beforeSave($insert){
		if(parent::beforeSave($insert)){
			if($this->isNewRecord){
				$this->comment_time=time();
			}
			return true;
		}
		return false;
	}

	public function rules(){
		return [
			[['comment_author','comment_content','comment_ip','comment_location','comment_picture','comment_from',
				'comment_uid','article_author','article_id','article_author_uid','second_author','second_author_uid','article_comment_first_id'],'required']
		];
	}
}

 ?>