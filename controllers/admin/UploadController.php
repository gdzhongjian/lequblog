<?php 
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\Upload;
use yii\web\UploadedFile;

class UploadController extends Controller
{   
    public $layout=false;
    public function actionUpload()
    {
        $model = new Upload();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            // echo $model->imageFile;
            // return;
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionUploadImage(){
        echo "xxx";
        // $model = new Upload();

        // if (Yii::$app->request->isPost) {
        //     $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        //     echo $model->imageFile;
        //     return;
        //     if ($model->upload()) {
        //         // 文件上传成功
        //         return;
        //     }
        // }else{
        //     echo "error";
        // }
    }
}

 ?>