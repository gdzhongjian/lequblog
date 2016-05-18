<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->params['user_headimage']=$user_headimage;
 ?>
 <?php $this->params['username']=$username; ?>
        <!--sidebar left end-->
        <!--main content start-->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-8">

                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>内容管理:文章内容</li>
                            <li class="active">
                            <?php if($status=="add") {?>
                            发表文章
                            <?php }else {?>
                            修改文章 
                            <?php } ?>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php if($status=="add") {?>
                                    发表文章
                                    <?php }else {?>
                                    修改文章 
                                    <?php } ?>
                                </h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" /> -->
                                <?php if($status=="add") {?>
                                <?php $form=ActiveForm::begin([
                                'options'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal'],
                                'action'=>Url::toRoute('admin/article/check-add-article')
                                ]) ?>
                                <?php }else {?>
                                <?php $form=ActiveForm::begin([
                                'options'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal'],
                                'action'=>Url::toRoute('admin/article/check-edit-article')
                                ]) ?>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章标题</label>
                                    <div class="col-sm-8">
                                        <?php if($status=="add") {?>
                                        <input type="text" class="form-control" id="title" required="" placeholder="文章标题" name="title" value="" />
                                        <?php }else {?>
                                        <input type="text" class="form-control" id="title" required=""  name="title" value="<?=$article['title'] ?>" />
                                        <input type="hidden" name="id" value="<?=$article->id ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">发表类别</label>
                                    <div class="col-sm-8">
                                        <?php if($status=="add") {?>

                                        <select name="tag_id" class="form-control">
                                            <volist name="t_id" id="vo">
                                                <option value="" selected>请选择文章类别</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?=$category->id ?>"><?=$category->name ?> </option>
                                                <?php  } ?>
                                            </volist>
                                        </select>

                                        <?php }else {?>

                                        <select name="tag_id" class="form-control">
                                            <volist name="t_id" id="vo">
                                                <option value="" selected>请选择文章类别</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?=$category->id ?>" <?php if($category_name==$category->name) echo "selected"; ?> ><?=$category->name ?> </option>
                                                <?php  } ?>
                                            </volist>
                                        </select>

                                        <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章关键字</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <input type="text" class="form-control" required="" placeholder="用中文逗号分隔..." name="keyword" value="" id="keyword" />
                                    <?php  }else{?>
                                        <input type="text" class="form-control" required="" name="keyword" value="<?=$article->keyword ?>" id="keyword" />
                                    <?php } ?>
                                    </div><br>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章描述</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <textarea placeholder="对文章进行描述，用于推荐时显示。" class="form-control" required="" name="remark"></textarea>
                                    <?php }else {?>
                                        <textarea  class="form-control" required="" name="remark"><?=$article->remark ?></textarea>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章封面</label>
                                    <div class="col-sm-6">
                                    <div style="width: 200px; height: 110px; float: left;">
                                        <!-- <input type="hidden" name="photo" value="" id="data_photo" /> -->
                                        <!-- <input id="photo_file" name="photo_file" type="file" multiple="true" value="" /> -->
                                            <?=$form->field($model,'imageFile')->fileInput() ?>
                                    </div>
                                    <div style="height: 110px; float: left;">
                                    <?php if($status=="add") {?>
                                        <img id="upload_img" src="" onerror="this.src='admin/admin/img/no_img.jpg'" style="height: 100px" />
                                    <?php }else {?>
                                        <img id="upload_img" src="<?=$article->picture ?>" onerror="this.src='admin/admin/img/no_img.jpg'" style="height: 100px" />
                                    <?php } ?>
                                    </div>
                                    <span class="error"></span>
                                </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章正文</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <script id="editor" name="content" required="" style="width:100%;height:300px;"></script>
                                    <?php }else {?>
                                        <script id="editor" name="content" required="" style="width:100%;height:300px;"><?=$article->content ?></script>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否显示</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <label>
                                            <input type="radio" name="type" value="0" checked />显示</label>
                                        <label>
                                            <input type="radio" name="type" value="1" />不显示</label>
                                    <?php }else {?>
                                        <label>
                                            <input type="radio" name="type" value="0" <?php if($article->type==0) echo "checked"; ?>/>显示</label>
                                        <label>
                                            <input type="radio" name="type" value="1" <?php if($article->type!=0) echo "checked"; ?>/>不显示</label>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否置顶</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <label>
                                            <input type="radio" name="istop" value="0" checked />不置顶</label>
                                        <label>
                                            <input type="radio" name="istop" value="1" />置顶</label>
                                    <?php }else {?>
                                        <label>
                                            <input type="radio" name="istop" value="0" <?php if($article->istop==0) echo "checked"; ?> />不置顶</label>
                                        <label>
                                            <input type="radio" name="istop" value="1" <?php if($article->istop!=0) echo "checked"; ?>/>置顶</label>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">显示类型</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <label>
                                            <input type="radio" name="original" value="0" checked/> 原创</label>
                                        <label>
                                            <input type="radio" name="original" value="1" /> 转载</label>
                                    <?php } else{?>
                                        <label>
                                            <input type="radio" name="original" value="0" <?php if($article->original==0) echo "checked"; ?>/> 原创</label>
                                        <label>
                                            <input type="radio" name="original" value="1" <?php if($article->original!=0) echo "checked"; ?>/> 转载</label>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">访问量</label>
                                    <div class="col-sm-8">
                                    <?php if($status=="add") {?>
                                        <input type="text" class="form-control" name="hits" value="0" readonly="readonly" />
                                    <?php }else{?>
                                        <input type="text" class="form-control" name="hits" value="<?=$article->hits ?>" readonly="readonly" />
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">作者</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="author" value="<?=$username ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <div class="col-sm-offset-3 ">
                                        <button type="submit" class="btn btn-primary">
                                            <?php if($status=="add") {?>
                                            发表文章
                                            <?php }else {?>
                                            修改文章 
                                            <?php } ?>
                                        </button>
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
    <script type="text/javascript" charset="utf-8" src="admin/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="admin/Ueditor/ueditor.all.min.js"></script>
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
   
    <!-- ToDo List  -->
    <script src="admin/assets/plugins/todo/js/todos.js"></script>
    <!--Load these page level functions-->
    <script>
    $(document).ready(function() {
        app.timer();
        app.weather();
    });
    </script>   
    <script type="text/javascript">
            window.UEDITOR_HOME_URL = "admin/Ueditor/";
            var ue = UE.getEditor('editor');
             // 自定义的编辑器配置项,此处定义的配置项将覆盖editor_config.js中的同名配置
            // var editor_a = new baidu.editor.ui.Editor(editorOption);
            // editor_a.render('editor');
        </script>
    <!-- <js file='admin/assets/js/uploadify/jquery.uploadify.min.js' />  -->
    <script type="text/javascript" src="admin/assets/js/uploadify/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" href="admin/assets/js/uploadify/uploadify.css"> 
    <script type="text/javascript">
    var uploadUrl="<?=Url::toRoute('admin/article/upload-article-image') ?>";
    </script> 
    <script type="text/javascript">
        $("#photo_file").uploadify({
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
