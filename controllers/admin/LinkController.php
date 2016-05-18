<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\User;
use yii\data\Pagination;
use app\models\admin\Link;
/**
* 友链管理控制器
*/
class LinkController extends CommonController
{
	//友链申请列表
	public function actionLinkList(){
		if(!$this->IsLogin()){
			echo "非法访问";
			return;
		}
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$data=Link::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
			'totalCount'=>$data->count(),
			'defaultPageSize'=>10,
			]);
		$models=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['addtime'=>SORT_DESC])->all();
		return $this->render('linklist',[
				'models'=>$models,
				'pages'=>$pages,
				'username'=>$username,
				'user_headimage'=>$user_headimage,
			]);
	}

	//新增友情链接处理显示
	public function actionEditNewLink(){
		if(!$this->IsLogin()){
			echo "非法访问!";
			return;
		}
		$link_id=$_GET['link_id'];
		$link=Link::findOne($link_id);
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('editlink',[
				'username'=>$username,
				'user_headimage'=>$user_headimage,
				'link'=>$link,
			]);
	}

	//处理友情链接
	public function actionCheckEditLink(){
		if(!$this->IsLogin()){
			echo "非法访问!";
			return;
		}
		$post=Yii::$app->request->post();
		$link=Link::findOne(['id'=>$post['id']]);
		$link->attributes=$post;
		if($link->save()){
			return $this->redirect(array('link-list'));
		}else{
			echo "处理友情链接失败！";
			return;
		}

	}
}

 ?>