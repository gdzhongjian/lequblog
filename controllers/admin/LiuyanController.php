<?php
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\Liuyan;
use yii\data\Pagination;
use yii\db\Command;
use app\models\admin\User;
use app\models\admin\Guestbook_reply;
/**
* 留言控制器
*/
class LiuyanController extends CommonController
{
	//留言列表
	public function actionLiuyanList(){
		$uid=$this->ReturnSession('uid');
		if(isset($_GET['weidu'])){
			if($_GET['weidu']==1){
				$weidu_liuyans=Liuyan::find()->where(['uid'=>$uid])->andWhere(['isread'=>0])->all();
				foreach ($weidu_liuyans as $weidu_liuyan) {
					$weidu_liuyan->isread=1;
					$weidu_liuyan->save();	
				}
			}
		}
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$data=Liuyan::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
			'totalCount'=>$data->count(),
			'defaultPageSize'=>10,
			]);
		$models=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['guest_time'=>SORT_DESC])->all();
		return $this->render('liuyanlist',[
				'models'=>$models,
				'pages'=>$pages,
				'username'=>$username,
				'user_headimage'=>$user_headimage,
			]);
	}


	//留言回复
	public function actionLiuyanReply(){
		$liuyan_id=$_GET['liuyan_id'];
		if(isset($_GET['weidu'])){
			if($_GET['weidu']==1){
				$weidu_liuyan=Liuyan::findOne(['id'=>$liuyan_id]);
				$weidu_liuyan->isread=1;
				$weidu_liuyan->save();
			}
		}
		$liuyan=Liuyan::findOne(['id'=>$liuyan_id]);
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('liuyanreply',[
				'username'=>$username,
				'liuyan'=>$liuyan,
				'user_headimage'=>$user_headimage,
			]);
	}


	//处理留言回复
	public function actionCheckLiuyanReply(){
		$post=Yii::$app->request->post();
		$uid=$this->ReturnSession('uid');
		$author_reply=$post['content'];
		$author_reply_time=time();
		$guestbook_id=$post['guestbook_id'];
		$connection=Yii::$app->db;
		$command=$connection->createCommand('INSERT INTO guestbook_reply SET author_reply=:author_reply,author_reply_time=:author_reply_time,guestbook_id=:guestbook_id,uid=:uid ');
		$command->bindParam(':author_reply',$author_reply);
		$command->bindParam(':author_reply_time',$author_reply_time);
		$command->bindParam(':guestbook_id',$guestbook_id);
		$command->bindParam(':uid',$uid);
		$command->execute();
		//更新留言表设置为已经回复
		$liuyan=Liuyan::findOne(['id'=>$guestbook_id]);
		$liuyan->isreply=1;
		if($liuyan->save()){
			return $this->redirect(array('liuyan-list'));
		}else{
			echo "留言回复失败";
		}

	}


	//修改（编辑）留言回复
	public function actionEditLiuyanReply(){
		$liuyan_id=$_GET['liuyan_id'];
		$liuyan=Liuyan::findOne(['id'=>$liuyan_id]);
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$guestbook_id=$liuyan['id'];
		$connection=Yii::$app->db;
		$command=$connection->createCommand('SELECT * FROM guestbook_reply WHERE guestbook_id=:guestbook_id');
		$command->bindParam(':guestbook_id',$guestbook_id);
		$guestbook_reply=$command->queryOne();
		return $this->render('editliuyanreply',[
				'username'=>$username,
				'liuyan'=>$liuyan,
				'guestbook_reply'=>$guestbook_reply,
				'user_headimage'=>$user_headimage,
			]);
	}


	//处理修改（编辑）留言回复
	public function actionCheckEditLiuyanReply(){
		$post=Yii::$app->request->post();
		$uid=$this->ReturnSession('uid');
		$author_reply=$post['content'];
		$author_reply_time=time();
		$guestbook_id=$post['guestbook_id'];
		$connection=Yii::$app->db;
		$command=$connection->createCommand('UPDATE guestbook_reply SET author_reply=:author_reply,author_reply_time=:author_reply_time WHERE guestbook_id=:guestbook_id ');
		$command->bindParam(':author_reply',$author_reply);
		$command->bindParam(':author_reply_time',$author_reply_time);
		$command->bindParam(':guestbook_id',$guestbook_id);
		$command->execute();
		return $this->redirect(array('liuyan-list'));
		

	}

	//删除一条留言，包括删除留言回复
	public function actionDeleteLiuyan(){
		$liuyan_id=$_GET['liuyan_id'];
		$liuyan=Liuyan::findOne(['id'=>$liuyan_id]);
		//删除用户留言
		if($liuyan->delete()){
			//删除自己回复
			$connection=Yii::$app->db;
			$command=$connection->createCommand('DELETE FROM guestbook_reply WHERE guestbook_id=:guestbook_id');
			$command->bindParam(':guestbook_id',$liuyan_id);
			$command->execute();
			return $this->redirect(array('liuyan-list'));
		}
	}


	//回复列表
	public function actionLiuyanReplyList(){
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$liuyans=Liuyan::findAll(['uid'=>$uid]);
		$data=Guestbook_reply::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
			'totalCount'=>$data->count(),
			'defaultPageSize'=>10,
			]);
		$models=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['author_reply_time'=>SORT_DESC])->all();
		return $this->render('liuyanreplylist',[
				'models'=>$models,
				'pages'=>$pages,
				'username'=>$username,
				'user_headimage'=>$user_headimage,
				'liuyans'=>$liuyans,
			]);
	}

	//删除回复
	public function actionDeleteLiuyanReply(){
		$liuyan_reply_id=$_GET['liuyan_reply_id'];
		$liuyan_reply=Guestbook_reply::findOne(['id'=>$liuyan_reply_id]);
		if($liuyan_reply->delete()){
			//删除回复后设置isreply=0,未回复
			$liuyan_id=$liuyan_reply->guestbook_id;
			$liuyan=Liuyan::findOne(['id'=>$liuyan_id]);
			$liuyan->isreply=0;
			if($liuyan->save()){
				return $this->redirect(array('liuyan-reply-list'));
			}
		}
	}

}

 ?>