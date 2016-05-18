<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\controllers;
use app\models\admin\Upload;
use app\models\admin\User;
use app\models\admin\Album;
use app\models\admin\Picture;
use yii\web\UploadedFile;
use yii\data\Pagination;
/**
* 图片控制器
*/
class PictureController extends CommonController
{
	//新增图片视图
	public function actionAddPicture(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$model=new Upload;
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$uid=$this->ReturnSession('uid');
		$albums=Album::find()->where(['uid'=>$uid])->orderBy(['star'=>SORT_DESC,'addtime'=>SORT_DESC])->all();
		return $this->render('addpicture',[
			'username'=>$username,
			'model'=>$model,
			'user_headimage'=>$user_headimage,
			'albums'=>$albums,
			]);
	}

	//处理新增图片
	public function actionCheckAddPicture(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}

		$uid=$this->ReturnSession('uid');
		$post=Yii::$app->request->post();
		$upload=new Upload;
		$upload->imageFile=UploadedFile::getInstance($upload,'imageFile');
		//如果有上传图片
		if($upload->imageFile){
			$fileurl=$upload->upload(2);
			if($fileurl!='error'){
				//文件上传成功！
				$post['url']=$fileurl;
				}else{
					echo "文件上传失败！";
				}
		}else{
				//没有上传图片,报错
				echo "没有上传图片";
				return;

		}
		if($post['album_id']==-1){
			echo "请选择相册类别";
			return;
		}
		$picture=new Picture;
		$picture->attributes=$post;
		if($picture->save()){
			// echo "上传成功！";
			return $this->redirect(array('picture-list','album_id'=>$picture->album_id));
		}else{
			echo "新增图片失败！";
			var_dump($picture->getErrors());
		}

	}


	//相册视图
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
				'defaultPageSize'=>9,
			]);
		$albums=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['star'=>SORT_DESC,'addtime'=>SORT_DESC])->all();
		return $this->render('albumlist',[
			'username'=>$username,
			'user_headimage'=>$user_headimage,
			'albums'=>$albums,
			'pages'=>$pages,
			]);
	}

	//图片列表
	public function actionPictureList(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$album_id=$_GET['album_id'];
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		//查询图片
		$data=Picture::find()->where(['album_id'=>$album_id]);
		$pages=	new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>9,
			]);
		$pictures=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['istop'=>SORT_DESC,'addtime'=>SORT_DESC])->all();
		return $this->render('picturelist',[
				'username'=>$username,
				'user_headimage'=>$user_headimage,
				'pages'=>$pages,
				'pictures'=>$pictures,
				'album_id'=>$album_id,
			]);
	}

	//图片置顶和取消置顶处理
	public function actionTurnTop(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$picture_id=$_GET['picture_id'];
		$settop=$_GET['settop'];
		$album_id=$_GET['album_id'];
		$picture=Picture::findOne(['id'=>$picture_id]);
		if($settop==1){
			//置顶操作
			$picture->istop=1;
			if($picture->save()){
				return $this->redirect(array('picture-list','album_id'=>$album_id));
			}else{
				echo "置顶出错！";
				return;
			}
		}
		if($settop==0){
			//取消置顶操作
			$picture->istop=0;
			if($picture->save()){
				return $this->redirect(array('picture-list','album_id'=>$album_id));
			}else{
				echo "取消置顶出错！";
				return;
			}
		}
	}

	//删除图片
	public function actionDelete(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$album_id=$_GET['album_id'];
		$picture_id=$_GET['picture_id'];
		$picture=Picture::findOne($picture_id);
		if($picture->delete()){
			return $this->redirect(array('picture-list','album_id'=>$album_id));

		}else{
			echo "删除图片出错！";
			return;
		}

	}
}

 ?>