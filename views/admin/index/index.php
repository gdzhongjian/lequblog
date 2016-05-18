<?php 
use yii\helpers\Url;
use yii\i18n\Formatter;
 ?>
 <?php $this->params['username']=$username;
    $this->params['user_headimage']=$user_headimage;
    $this->params['weidu_liuyan_count']=$weidu_liuyan_count;
    $this->params['weidu_liuyans']=$weidu_liuyans;
  ?>

        <section class="main-content-wrapper">
            <section id="main-content">
                <!--tiles start-->
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-red">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="<?=$albumcount ?>" data-speed="1000"></h1>
                                <p>相册总数
                                </p>
                            </div>
                            <div class="icon"><i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-turquoise">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="<?=$articlecount ?>" data-speed="1000"></h1>
                                <p>文章总数</p>
                            </div>
                            <div class="icon"><i class="fa fa-comments"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-blue">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="<?=$saidcount ?>" data-speed="1000"></h1>
                                <p>说说总数</p>
                            </div>
                            <div class="icon"><i class="fa fa fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-purple">
                            <div class="content">
                                <h1 class="text-left timer" data-to="<?=$liuyancount ?>" data-speed="1000"></h1>
                                <p>留言总数</p>
                            </div>
                            <div class="icon"><i class="fa fa-bar-chart-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tiles end-->
                <!--dashboard charts and map start-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <!-- <h3 class="panel-title">程序信息</h3> -->
                                <h3 class="panel-title">个人信息</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                        <!-- <tr>
                                            <td>
                                                <h5>服务器环境：<a>&nbsp;&nbsp;<?php echo $_SERVER['SERVER_SOFTWARE'] ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PHP版本：<a>&nbsp;&nbsp;<?php echo PHP_VERSION ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>服务器IP：<a>&nbsp;&nbsp;<?php echo $_SERVER['SERVER_ADDR'] ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>数据库信息：<a>&nbsp;&nbsp;<?php echo mysql_get_client_info() ?></a></h5>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td>
                                                <h5>个人主页：<a href="<?=$personal_website ?>" target="_blank">&nbsp;&nbsp;<?=$personal_website ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>用户名：<a>&nbsp;&nbsp;<?=$username ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>邮箱：<a>&nbsp;&nbsp;<?=$userinfo['email'] ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>博客访问量：<a>&nbsp;&nbsp;<?=$userinfo['views'] ?></a></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">最近登录</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                        <volist name="said" id="vo">
                                            <tr>
                                                <td>  
                                                    <h5>上次登录时间：<a>&nbsp;&nbsp;<?php echo \Yii::$app->formatter->asDate($userinfo['last_time'],'php:Y-m-d H:i:s'); ?></a></h5>
                                                </td>
                                            </tr>
                                            <tr>    
                                                <td>
                                                    <h5>上次登录IP：<a>&nbsp;&nbsp;<?=$userinfo['last_ip'] ?></a></h5>
                                                </td>
                                            </tr> 
                                            <?php if(isset($last_location)){
                                                if($last_location){
                                            ?>
                                            <tr>    
                                                <td>
                                                    <h5>上次登录地点：<a>&nbsp;&nbsp;<?=$last_location ?></a></h5>
                                                </td>
                                            </tr>  
                                            <?php
                                                }
                                                } ?>
                                        </volist>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <!--ToDo end-->
            </section>
        </section>
        <!--main content end-->
        <!--sidebar right start-->
        
        <!--sidebar right end-->
    </section>
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
                $("#toggle-left").click(function(){
                    if($("#toggle-left").attr('data-original-title')=="收起列表"){
                        $("#toggle-left").attr('data-original-title',"展开列表");
                    }else{
                        $("#toggle-left").attr('data-original-title',"收起列表");
                    }
                });
            </script>

</body>

</html>
