<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\Said;
use yii\data\Pagination;
use app\models\admin\User;
/**
* 说说控制器
*/
class SaidController extends CommonController
{
	//发表说说
	public function actionAddSaid(){
		//如果用户没有登录
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		//获取session
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('addsaid',['username'=>$username,'user_headimage'=>$user_headimage]);
	}

	//处理发表说说
	public function actionCheckAddSaid(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$model=new Said;
		$model->scenario='add';
		$post=Yii::$app->request->post();
		$uid=$this->ReturnSession('uid');
		$os=$this->getOS();
		$post['uid']=$uid;
		$post['from']=$os;
		$model->attributes=$post;
		if($model->save()){
			return $this->redirect(array('said-list'));
		}else{
			echo "发表说说失败！";
		}
	}

	//说说列表
	public function actionSaidList(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$uid=$this->ReturnSession('uid');
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$data=Said::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
			'totalCount'=>$data->count(),
			'defaultPageSize'=>10,
			]);
		$models=$data->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('saidlist',[
			'username'=>$username,
			'pages'=>$pages,
			'models'=>$models,
			'user_headimage'=>$user_headimage,
			]);
	}

	//编辑说说
	public function actionEditSaid(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$username=$this->ReturnSession('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$said_id=$_GET['said_id'];
		$said=Said::findOne(['id'=>$said_id]);
		return $this->render('editsaid',[
				'username'=>$username,
				'said'=>$said,
				'user_headimage'=>$user_headimage,
			]);
	}

	//处理编辑说说
	public function actionCheckEditSaid(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$post=Yii::$app->request->post();
		$said_id=$post['id'];
		$said=Said::findOne(['id'=>$said_id]);
		$said->scenario='edit';
		$os=$this->getOS();
		$said->from=$os;
		$said->title=$post['title'];
		$said->content=$post['content'];
		$said->type=$post['type'];
		$said->istop=$post['istop'];

		if($said->save()){
			return $this->redirect(array('said-list'));
		}else{
			echo "修改说说失败！";
		}
	}

	//删除说说
	public function actionDeleteSaid(){
		if(!$this->IsLogin()){
			echo "非法访问！";
			return;
		}
		$said_id=$_GET['said_id'];
		$said=Said::findOne($said_id);
		if($said->delete()){
			return $this->redirect(array('said-list'));
		}else{
			echo "删除失败！";
		}
	}
}
 ?>