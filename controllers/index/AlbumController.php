<?php 
namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use app\models\admin\Login;
use app\models\admin\Category;
use app\models\admin\Liuyan;
use app\models\admin\Article;
use yii\data\Pagination;
use app\models\admin\User;
use app\models\admin\Album;
use app\models\admin\Picture;
use app\models\admin\Link;
use app\models\admin\Fans;
/**
* 相册控制器
*/
class AlbumController extends BaseController
{
	// public $layout=false;
	public function actionIndex(){
		$session_uid=$this->ReturnSession('uid');
		$uid=$_GET['uid'];

		//查找全部相册
		$data=Album::find()->where(['uid'=>$uid])->andWhere(['status'=>0]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>9,
			]);
		$albums=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['star'=>SORT_DESC,'addtime'=>SORT_DESC])->all();

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
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'newliuyans'=>$newliuyans,
				'mosthits'=>$mosthits,
				'myinfo'=>$myinfo,
				'albums'=>$albums,
				'pages'=>$pages,
				'links'=>$links,
				'hotalbums'=>$hotalbums,
				'follow_message'=>$follow_message,
				'follow_count'=>$follow_count,
				'fans_count'=>$fans_count,
			]);
	}

	//前台图片展示
	public function actionPictureList(){
		$session_uid=$this->ReturnSession('uid');
		$uid=$_GET['uid'];
		$album_id=$_GET['album_id'];
		//点击此链接就把指定相册阅读数加1(非本人用户)
		$album=Album::findOne(['id'=>$album_id]);
		$album->scenario="edit";
		if($session_uid!=$uid){
			if($album){
			$album->hits=$album->hits+1;
			if($album->save()){

			}else{
				echo "出现意外错误！";
				return;
			}
			}else{
			echo "非法访问！";
			return;
		}
		}

		//查找全部图片
		$data=Picture::find()->where(['album_id'=>$album_id]);
		$pages=new Pagination([
				'totalCount'=>$data->count(),
				'defaultPageSize'=>20,
			]);
		$pictures=$data->offset($pages->offset)->limit($pages->limit)->orderBy(['istop'=>SORT_DESC,'addtime'=>SORT_DESC])->all();

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
		$hotuser=Login::find()->where(['<>','id',$uid])->all();

		//友情链接
		$links=Link::find()->where(['uid'=>$uid])->andWhere(['ispass'=>1])->andWhere(['type'=>0])->orderBy(['level'=>SORT_DESC])->all();

		return $this->render('picturelist',[
				'mylabels'=>$mylabels,
				'uid'=>$uid,
				'categories'=>$categories,
				'rand_articles'=>$rand_articles,
				'hotuser'=>$hotuser,
				'session_uid'=>$session_uid,
				'newliuyans'=>$newliuyans,
				'mosthits'=>$mosthits,
				'myinfo'=>$myinfo,
				'pictures'=>$pictures,
				'pages'=>$pages,
				'links'=>$links,
				'hotalbums'=>$hotalbums,
				'follow_message'=>$follow_message,
				'follow_count'=>$follow_count,
				'fans_count'=>$fans_count,
			]);
	}
}
 ?>