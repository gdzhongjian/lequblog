<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>
<script src="admin/assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="admin/assets/js/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" href="admin/assets/js/uploadify/uploadify.css"> 
<script type="text/javascript">
    var uploadUrl="<?php echo \Yii::$app->request->getHostInfo().'/yiiblog/web/index.php?r=admin/upload/upload-image' ?>";
 </script> 
<script type="text/javascript">
        $("#upload-imagefile").uploadify({
            'swf': 'admin/assets/js/uploadify/uploadify.swf',
            'uploader': uploadUrl,
            'cancelImg': 'admin/assets/js/uploadify/uploadify-cancel.png',
            'buttonText': '上传图片',
            'height': 35,
            'fileTypeExts': '*.gif;*.jpg;*.png',
            'queueSizeLimit': 1,
            'onUploadSuccess': function(file, data, response) {
                // $("#data_photo").val(data);
                $(".error").html(data);
                $("#upload_img").attr('src', 'admin/admin/img/Koala.jpg').show();
            }
        });
        
  </script>