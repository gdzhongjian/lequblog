<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\User;
use app\models\admin\UserHeadimage;
use yii\web\UploadedFile;
use app\models\admin\Fangke;
use app\models\admin\Liuyan;
use app\models\admin\Article;
use app\models\admin\Article_comment_first;
use app\models\admin\Article_comment_Second;
/**
* 用户控制器，主要用于修改用户信息和密码
*/
class UserController extends CommonController
{
	
	//修改用户信息视图显示
	public function actionEditUser(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$uid=$this->ReturnSession('uid');
		$userinfo=User::findOne($uid);
		$user_headimage=$userinfo['headimage'];
		$model=new UserHeadimage;
		$username=$this->ReturnSession('username');
		return $this->render('edituser',[
			'username'=>$username,
			'model'=>$model,
			'user_headimage'=>$user_headimage,
			'userinfo'=>$userinfo
			]);
	}

	//检查用户修改信息
	public function actionCheckEditUser(){
		$oldusername=$this->ReturnSession('username');
		$post=Yii::$app->request->post();
		//查找用户名是否存在
		$uid=$this->ReturnSession('uid');
		// $find_user=User::find()->where(['username'=>$post['newusername']])->all();
		// var_dump($find_user);
		// return;
		$user=User::findOne($uid);
		$oldheadimage=$user->headimage;
		$user->scenario="edit";
		$upload=new UserHeadimage;
		$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
		//如果有上传封面
		if($upload->imageFile){
			$fileurl=$upload->upload();
			if($fileurl!='error'){
			//文件上传成功！
			$user->headimage=$fileurl;
			}else{
				echo "文件上传失败！";
			}
		}
		
		$user->username=$post['newusername'];
		$user->sex=$post['sex'];
		$user->brief=$post['brief'];
		//更新用户数据
		if($user->save()){
			// echo "更新成功!";
			//更新session中的username
			$session=Yii::$app->session;
			$session->set('username',$user->username);
			//更新各种关联数据库的用户名信息
			//更新访客表中的用户名,即是更新fangke_uid字段查询到的用户名
			if($oldusername!=$user->username||$oldheadimage!=$user->headimage){
				$fangkes=Fangke::findAll(['fangke_uid'=>$user->id]);
				foreach ($fangkes as $fangke) {
					$fangke->fangke_username=$user->username;
					$fangke->fangke_headimage=$user->headimage;
					$fangke->save();
				}
				//更新留言板该留言用户的信息（即是该用户评论其他用户留言的内容）
				$liuyans=Liuyan::find()->where(['guest_author'=>$oldusername])->andWhere(['ishidden'=>1])->all();
				foreach ($liuyans as $liuyan) {
					$liuyan->guest_author=$user->username;
					$liuyan->guest_picture=$user->headimage;
					$liuyan->save();
				}
				//更新留言板该留言所属用户的信息（即是留言评论的所有者）
				$liuyans=Liuyan::findAll(['uid'=>$user->id]);
				foreach ($liuyans as $liuyan) {
					$liuyan->author=$user->username;
					$liuyan->save();
				}

				//更改该用户所有文章的作者名称
				$articles=Article::findAll(['uid'=>$user->id]);
				foreach ($articles as $article) {
					$article->author=$user->username;
					$article->save();
				}

				//更改该用户所发表的第一评论表的评论中的名称和头像（只要是该用户发出的评论就更新）
				$first_comments=Article_comment_first::findAll(['comment_uid'=>$user->id]);
				foreach ($first_comments as $first_comment) {
					$first_comment->comment_author=$user->username;
					$first_comment->comment_picture=$user->headimage;
					$first_comment->save();
				}

				//更改该用户所发表的第二评论表的评论中的名称和头像（只要是该用户发出的评论就更新）
				$second_comments=Article_comment_Second::findAll(['comment_uid'=>$user->id]);
				foreach ($second_comments as $second_comment) {
					$second_comment->comment_author=$user->username;
					$second_comment->comment_picture=$user->headimage;
					$second_comment->save();
				}
			}
			

			return $this->redirect(array('admin/index/index'));
		}else{
			echo "更新失败";
		}
	}

	//修改密码视图
	public function actionChangePassword(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$uid=$this->ReturnSession('uid');
		$userinfo=User::findOne($uid);
		$user_headimage=$userinfo['headimage'];
		$username=$this->ReturnSession('username');
		return $this->render('changepassword',[
			'username'=>$username,
			'user_headimage'=>$user_headimage,
			'userinfo'=>$userinfo
			]);
	
	}

	//检查修改密码
	public function actionCheckChangePassword(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$post=Yii::$app->request->post();
		$checkoldpassword=$this->EncryptionPassword($post['oldpassword']);
		if($checkoldpassword){
			echo "原密码不正确！";
			return;
		}
		if($post['newpassword']!=$post['newpassword1']){
			echo "两次密码不正确！";
			return;
		}
		//加密新密码
		$password=$post['newpassword'];
		$uid=$this->ReturnSession('uid');
		$user=User::findOne(['id'=>$uid]);
		$user->scenario="change_password";
		//读取随机表的salt1和salt3
		$connection=Yii::$app->db;
		$command=$connection->createCommand('SELECT * FROM rand Where uid=:uid');
		$command->bindValue(':uid',$uid);
		$rand=$command->queryOne();
		$salt1=$rand['salt1'];
		$salt2=md5($password);
		$salt3=$rand['salt3'];
		$salt=$salt1.$salt2.$salt3;
		$password1=md5($salt);
		$user->password=Yii::$app->getSecurity()->generatePasswordHash($password1);
		if($user->save()){
			return $this->redirect(array('admin/index/index'));
		}else{
			echo "修改失败！";
		}
	}


	//异步检查密码是否正确
	public function actionCheckOldPassword(){
		$oldpassword=Yii::$app->request->post();
		//判断密码是否正确
		$result=$this->EncryptionPassword($oldpassword['oldpassword']);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}

	//对获取的密码进行加密
	public function EncryptionPassword($password){
		//读取用户的主码和密码
		$uid=$this->ReturnSession('uid');
		$user=User::findOne(['id'=>$uid]);
		//读取随机表的salt1和salt3
		$connection=Yii::$app->db;
		$command=$connection->createCommand('SELECT * FROM rand Where uid=:uid');
		$command->bindValue(':uid',$uid);
		$rand=$command->queryOne();
		$salt1=$rand['salt1'];
		$salt2=md5($password);
		$salt3=$rand['salt3'];
		$salt=$salt1.$salt2.$salt3;
		$password1=md5($salt);
		if(Yii::$app->getSecurity()->validatePassword($password1,$user->password)){
			//密码输入正确
			return 0;
		}else{
			//密码输入错误
			return 1;
		}
		
	}

}


 ?>