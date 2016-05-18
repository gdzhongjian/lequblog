<?php 
namespace app\controllers\index;

use yii\web\Controller;
use Yii;
use app\models\admin\Article;
use app\models\admin\Category;
use yii\data\Pagination;
use yii\db\Command;
use app\models\admin\Login;
use yii\helpers\Url;
use app\models\admin\Liuyan;
use app\models\admin\User;
use app\models\admin\Link;
use app\models\admin\Album;
use app\models\admin\Fans;
/**
* 首页控制器
*/
class IndexController extends BaseController
{
	
	//显示首页
	public function actionIndex($uid=""){
		if($uid){
			//查找全部文章
			$session_uid=$this->ReturnSession('uid');
			$data=Article::find()->where(['uid'=>$uid,'type'=>0]);
			$pages=new Pagination([
					'totalCount'=>$data->count(),
					'defaultPageSize'=>8,
				]);
			$articles=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['istop'=>SORT_DESC,'post_time'=>SORT_DESC])->all();

			//查找全部分类
			$category_ids=array();
			$categories=Category::findAll(['uid'=>$uid]);
			
			//查找我的资料
			$myinfo=User::findOne(['id'=>$uid]);

			//查找关注情况
			$follow_message=Fans::find()->where(['fans_uid'=>$session_uid])->andWhere(['follow_uid'=>$uid])->one();
			if($follow_message){
				$fans_message=Fans::find()->where(['fans_uid'=>$uid])->andWhere(['follow_uid'=>$session_uid])->one();
				if($fans_message){
					//双方都关注了，显示相互关注
					$follow_message=2;
				}else{
					//单方面关注
					$follow_message=1;
				}
			}else{
				//0表示双方都没有关注
				$follow_message=0;
			}

			//查找该博客用户关注人数和粉丝人数
			$follow_count=Fans::find()->where(['fans_uid'=>$uid])->count();
			$fans_count=Fans::find()->where(['follow_uid'=>$uid])->count();

			//查找我的标签
			$mylabels=$this->MyLabel($uid);
			
			//随机文章
			$connect=Yii::$app->db;
			$command=$connect->createCommand('SELECT * FROM article WHERE uid=:uid AND type=0  order by rand() limit 5');
			$command->bindParam(':uid',$uid);
			$rand_articles=$command->queryAll();

			//查找最新留言
			$newliuyans=Liuyan::find()->where(['uid'=>$uid])->orderBy(['guest_time'=>SORT_DESC])->limit(5)->all();

			//查找热门相册
			$hotalbums=Album::find()->where(['uid'=>$uid])->andWhere(['status'=>0])->orderBy(['hits'=>SORT_DESC])->limit(5)->all();

			//查找热门文章
			$mosthits=Article::find()->where(['uid'=>$uid])->orderBy(['hits'=>SORT_DESC])->limit(10)->all();
			
			//热门博客
			$hotuser=Login::find()->where(['<>','id',$uid])->orderBy(['views'=>SORT_DESC])->limit(10)->all();

			//友情链接
			$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();


			return $this->render('index',[
					'articles'=>$articles,
					'pages'=>$pages,
					'categories'=>$categories,
					'myinfo'=>$myinfo,
					'mylabels'=>$mylabels,
					'uid'=>$uid,
					'rand_articles'=>$rand_articles,
					'hotuser'=>$hotuser,
					'session_uid'=>$session_uid,
					'newliuyans'=>$newliuyans,
					'mosthits'=>$mosthits,
					'links'=>$links,
					'hotalbums'=>$hotalbums,
					'follow_message'=>$follow_message,
					'follow_count'=>$follow_count,
					'fans_count'=>$fans_count,
				]);
		}else{
			if($this->IsLogin()){
				$uid=$this->ReturnSession('uid');
				return $this->redirect(array('index/index/index','uid'=>$uid));
			}else{
				return $this->redirect(array('admin/login/index'));
			}
		}
	}
}
 ?>