<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\Upload;
use yii\web\UploadedFile;
use app\models\admin\Album;
use yii\data\Pagination;
use app\models\admin\User;
/**
* 相册控制器
*/
class AlbumController extends CommonController
{
	//新增相册
	public function actionAddAlbum(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$model=new Upload;
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('addalbum',[
			'username'=>$username,
			'model'=>$model,
			'user_headimage'=>$user_headimage,
			]);
	}


	//处理新增相册
	public function actionCheckAddAlbum(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}

		$uid=$this->ReturnSession('uid');
		$post=Yii::$app->request->post();
		$upload=new Upload;
		$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
		//如果有上传封面
		if($upload->imageFile){
			$fileurl=$upload->upload(1);
			if($fileurl!='error'){
				//文件上传成功！
				$post['url']=$fileurl;
				}else{
					echo "文件上传失败！";
				}
		}else{
				//没有上传封面,使用默认封面图
				$fileurl='public/upload/article/cover/default/Lighthouse.jpg';
				$post['url']=$fileurl;

		}
		//获取客户端操作系统
		$os=$this->getOS();
		$post['from']=$os;
		$post['uid']=$uid;
		$album=new Album;
		$album->scenario="add";
		$album->attributes=$post;
		if($album->save()){
			return $this->redirect(array('album-list'));
		}else{
			echo "新增相册失败！";
		}
	}


	//编辑相册
	public function actionEditAlbum(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$album_id=$_GET['album_id'];
		$album=Album::findOne($album_id);
		$model=new Upload;
		return $this->render('editalbum',[
				'username'=>$username,
				'album'=>$album,
				'model'=>$model,
				'user_headimage'=>$user_headimage,
			]);

	}

	//处理编辑相册
	public function actionCheckEditAlbum(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}

		$post=Yii::$app->request->post();
		$album_id=$post['id'];
		$album=Album::findOne(['id'=>$album_id]);
		$album->scenario="edit";
		$upload=new Upload;
		$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
		//如果有上传封面
		if($upload->imageFile){
			$fileurl=$upload->upload(1);
			if($fileurl!='error'){
				//文件上传成功！
				$album->url=$fileurl;
				}else{
					echo "文件上传失败！";
				}
		}else{
				//没有上传封面,使用数据库原来封面图
		}
		//获取客户端操作系统
		$os=$this->getOS();
		$album->from=$os;
		$album->name=$post['name'];
		$album->star=$post['star'];
		$album->status=$post['status'];
		if($album->save()){
			return $this->redirect(array('album-list'));
		}else{
			echo "修改相册失败！";
		}
	}


	//相册列表
	public function actionAlbumList(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}

		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$uid=$this->ReturnSession('uid');
		$data=Album::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>10,
			]);
		$albums=$data->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('albumlist',[
			'username'=>$username,
			'albums'=>$albums,
			'pages'=>$pages,
			'user_headimage'=>$user_headimage,
			]);
	}


	//删除相册
	public function actionDeleteAlbum(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}

		$album_id=$_GET['album_id'];
		$album=Album::findOne($album_id);
		if($album->delete()){
			return $this->redirect(array('album-list'));
		}else{
			echo "删除失败！";
		}
	}

}
 ?>