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
                            <li class="active">图片列表</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">图片列表</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <link href="h+/css/animate.min.css" rel="stylesheet">
                    <?php if(isset($pictures)){
                        if($pictures){
                            foreach ($pictures as $picture) {
                    ?>


                        <div class="file-box" style="float: left;width: 220px">
                            <div class="file">
                                    <span class="corner"></span>
                                    <input type="hidden" name="album_id" value="<?=$album_id ?>">
                                    <div class="image">
                                        <img alt="" class="img-responsive" src="<?=$picture->url ?>" width="200px" height="130px" title="   "  style="width: 200px;"  >
                                    </div>
                                    <div class="file-name" style="text-align: center">
                                    <small>
                                        添加时间：<?php echo \Yii::$app->formatter->asDate($picture->addtime,'php:Y-m-d') ?>
                                    </small>
                                        <br/>
                                        <small>
                                        <?php if($picture->istop==0) {?>
                                        <a href="<?=Url::toRoute(['admin/picture/turn-top','picture_id'=>$picture->id,'settop'=>1,'album_id'=>$album_id]) ?>">置顶</a>
                                        <?php }else {?>
                                        <a href="<?=Url::toRoute(['admin/picture/turn-top','picture_id'=>$picture->id,'settop'=>0,'album_id'=>$album_id]) ?>">取消置顶</a>
                                        <?php } ?>
                                        &nbsp;&nbsp; 
                                        <a href="<?=Url::toRoute(['admin/picture/delete','picture_id'=>$picture->id,'album_id'=>$album_id]) ?>">删除</a>
                                        </small>
                                        <hr>
                                    </div>

                            </div>
                        </div>
                       
                    <?php 
                            }
                        }else{
                            echo "暂无图片";
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
 

