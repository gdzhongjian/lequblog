<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\i18n\Formatter;
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
                            <li class="active">相册列表</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">相册列表</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <link href="h+/css/animate.min.css" rel="stylesheet">
                    <?php if(isset($albums)){
                        if($albums){
                            foreach ($albums as $album) {
                    ?>


                        <div class="file-box" style="float: left;width: 260px">
                            <div class="file">
                                <a href="<?=Url::toRoute(['admin/picture/picture-list','album_id'=>$album->id]) ?>">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="<?=$album->name ?>" class="img-responsive" src="<?=$album->url ?>" width="200px" height="130px" title="<?=$album->name ?>"  style="width: 200px;"  >
                                    </div>
                                    <div class="file-name">
                                        相册名称：<?=$album->name ?>
                                        <br/>
                                        <small>添加时间：<?php echo \Yii::$app->formatter->asDate($album->addtime,'php:Y-m-d') ?></small>
                                        <hr>
                                    </div>
                                </a>

                            </div>
                        </div>
                       
                    <?php 
                            }
                        }else{
                            echo "暂无相册";
                        }
                        } ?>
                    
                            </div>
                            <?php echo LinkPager::widget(['pagination'=>$pages]); ?>
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
    <script src="h+/js/jquery.min.js?v=2.1.4"></script>
    <script src="h+/js/content.min.js?v=1.0.0"></script>
    <script>
        $(document).ready(function(){$(".file-box").each(function(){animationHover(this,"pulse")})});
    </script>
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

