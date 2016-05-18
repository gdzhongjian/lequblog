<?php 
namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
* 点赞表1模型
*/
class Praise1 extends ActiveRecord
{
	public static function tableName(){
		return 'praise1';
	}

	public function rules(){
		return [
			[['user_uid','is_good','article_id','article_comment_first_id','good_time','is_good_read'],'required','on'=>'good'],
			[['user_uid','is_bad','article_id','article_comment_first_id','bad_time','is_bad_time'],'required','on'=>'bad']
		];
	}

	//两种场景，分别是点赞场景和鄙视场景
	public function scenarios(){
		return [
			'good'=>['user_uid','is_good','article_id','article_comment_first_id','good_time','is_good_read'],
			'bad'=>['user_uid','is_bad','article_id','article_comment_first_id','bad_time','is_bad_read']
		];
	}
}

 ?>