<?php 
namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\admin\Category;
use yii\data\Pagination;
use app\models\admin\User;
/**
* 栏目分类控制器
*/
class CategoryController extends CommonController
{
	// public $layout=false;
	public $enableCsrfValidation=false;
	public function actionAddCategory(){
		//获取session
		$session=Yii::$app->session;
		$uid=$session->get('uid');
		$username=$session->get('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('addcategory',[
			'status'=>true,
			'uid'=>$uid,
			'username'=>$username,
			'user_headimage'=>$user_headimage,
			]);
	}

	//编辑栏目视图显示
	public function actionEditCategory(){
		$cid=$_GET['cid'];
		$category=Category::findOne($cid);
		//获取session
		$session=Yii::$app->session;
		$uid=$session->get('uid');
		$username=$session->get('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		return $this->render('addcategory',[
			'status'=>false,
			'uid'=>$uid,
			'category'=>$category,
			'username'=>$username,
			'user_headimage'=>$user_headimage,
			]);
	}

	//新增栏目
	public function actionCheckAddCategory(){
		$model=new Category;
		$model->scenario='add';
		// $model->attributes=Yii::$app->request->post('Category');
		if($model->load(Yii::$app->request->post())){
			if($model->save()){
				return $this->redirect(array('category-list'));
			}else{
				var_dump($model->attributes);
				var_dump($model->hasErrors());
				print_r($model->getErrors());
			}
		}else{
			echo "cuowu";
		}
	}

	//更新栏目
	public function actionCheckUpdateCategory(){
		$data=Yii::$app->request->post('Category');
		$category=Category::findOne($data['id']);
		$category->scenario='update';
		$category->name=$data['name'];
		$category->remark=$data['remark'];
		$category->open=$data['open'];
		$category->uid=$data['uid'];
		if($category->validate()){
			if($category->update()){
				return $this->redirect(array('category-list'));
			}else{
				var_dump($model->attributes);
				var_dump($model->hasErrors());
				print_r($model->getErrors());
			}
		}else{
			print_r($model->getErrors());
		}
	}

	//删除栏目
	public function actionDeleteCategory(){
		$cid=$_GET['cid'];
		$model=Category::findOne($cid);
		if($model->delete()){
			return $this->redirect(array('category-list'));
		}else{
			var_dump($model->getErrors());
			var_dump($model->hasErrors());
		}
	}


	//异步查询栏目名称是否存在！
	public function actionCheckName(){
		$post=Yii::$app->request->post();
		$name=$post['name'];
		$model=new Category;
		$message=$model->findByName($name);
		//栏目名称存在
		if($message){
			return 1;
		}else{
			return 0;
		}
	}

	//栏目列表，查询输出栏目
	public function actionCategoryList(){
		$session=Yii::$app->session;
		$uid=$session->get('uid');
		$username=$session->get('username');
		$userinfo=User::findOne(['username'=>$username]);
		$user_headimage=$userinfo->headimage;
		$data=Category::find()->where(['uid'=>$uid]);
		$pages=new Pagination([
			'totalCount'=>$data->count(),
			'defaultPageSize'=>10,
			]);
		$models=$data->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('categorylist',[
				'models'=>$models,
				'pages'=>$pages,
				'username'=>$username,
				'user_headimage'=>$user_headimage,
			]);
	}
}
 ?>