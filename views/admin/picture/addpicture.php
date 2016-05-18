<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->params['username']=$username;
$this->params['user_headimage']=$user_headimage;
 ?>
  <!--main content start-->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>图片管理</li>
                            <li class="active">添加图片</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">添加图片</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                               
                                <!-- <form action="" method="post" class="form-horizontal" enctype="multipart/form-data"/> -->
                                <?php $form=ActiveForm::begin([
                                'options'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal'],
                                'action'=>Url::toRoute('admin/picture/check-add-picture')
                                ]) ?>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">相册类别</label>
                                    <div class="col-sm-8">

                                        <select name="album_id" class="form-control">
                                            <volist name="album_id" id="vo">
                                                <option value="-1" selected>请选择文章类别</option>
                                                <?php foreach ($albums as $album) {
                                                ?>

                                                <option value="<?=$album->id ?>"><?=$album->name ?></option>
                                                <?php 
                                                } ?>
                                            </volist>
                                        </select>

                                     

                                    </div>
                                </div>

                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">添加图片</label>
                                    <div class="col-sm-8">
                                    <div style="width: 200px; height: 110px; float: left;">
                                            <?=$form->field($model,'imageFile')->fileInput() ?>
                                    </div>
                                    <div style="height: 110px; float: left;">
                                        <img id="upload_img" src="" onerror="this.src='admin/admin/img/no_img.jpg'" style="height: 100px" />
                                    </div>
                                    <span class="error"></span>
                                </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否置顶</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" name="istop" value="0" checked/>不置顶</label>
                                    <label><input type="radio" name="istop" value="1"/>置顶</label>    
                                    </div>
                                </div>
                                          
                                <hr />
                                <div class="form-group">
                                    <div class="col-sm-offset-3 ">
                                        <button type="submit" class="btn btn-primary">添加图片</button>
                                    </div>
                                </div>
                                <!-- </form> -->
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!--main content end-->
        <!--sidebar right start-->
        
        <!--sidebar right end-->
    </section>
    <!--Global JS-->
    <script src="admin/assets/js/jquery-1.10.2.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="admin/assets/js/application.js"></script>
    <!--Page Level JS-->
    <script src="admin/assets/plugins/countTo/jquery.countTo.js"></script>
    <script src="admin/assets/plugins/weather/js/skycons.js"></script>
    <!-- FlotCharts  -->
    <!-- Morris  -->
    <script src="admin/assets/plugins/morris/js/raphael.2.1.0.min.js"></script>
    <!-- Vector Map  -->
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- ToDo List  -->
    <script src="admin/assets/plugins/todo/js/todos.js"></script>
    <!--Load these page level functions-->
    <script>
    $(document).ready(function() {
        app.timer();
        app.map();
        app.weather();
    });
    </script>
    <script type="text/javascript">

    $("#upload-imagefile").change(function(){
    var objUrl = getObjectURL(this.files[0]) ;
    console.log("objUrl = "+objUrl) ;
    if (objUrl) {
        $("#upload_img").attr("src", objUrl) ;
    }
});
    //建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null ; 
    if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
}
    </script>

