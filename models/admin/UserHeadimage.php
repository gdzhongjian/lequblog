<?php 
namespace app\models\admin;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
/**
* 用户头像上传模型
*/
class UserHeadimage extends Model
{
	
	public $imageFile;

	public function rules(){
		return [
			[['imageFile'],'file','skipOnEmpty'=>false,'extensions'=>'png,jpg,gif'],
		];
	}

	public function upload(){
		if($this->validate()){
			$time=time();
			$timeformat=date('Ymd',$time);
			//根据session获取当前用户名
			$session=Yii::$app->session;
			$username=$session->get('username');
			$uid=$session->get('uid');
			//判断目录是否存在,不存在就创建
			$dir='public/image/headimage/'.$uid.'/'.$username.'/'.$timeformat;
			if(!file_exists($dir)){
				// 判断是否是Windows系统还是Linux系统
				if(strrpos(strtolower(PHP_OS),"win") === FALSE){
					@mkdir($dir,0777,true);
				}else{
					@mkdir(iconv('utf-8','gbk',$dir),0777,true);
				}
			}
			$fileurl=$dir.'/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
			$this->imageFile->saveAs($fileurl);
			return $fileurl;
		}else{
			return 'error';
		}
	}

	public function attributLabels(){
		return ['imageFile'=>''];
	}
}
 ?>