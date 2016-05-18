<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\i18n\Formatter;
$this->params['username']=$username;
$this->params['user_headimage']=$user_headimage;
 ?>
       <!--main content start-->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>相册管理</li>
                            <li class="active">相册列表</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">
                        <a href="<?=Url::toRoute('admin/album/add-album') ?>">
                            <button class="btn btn-primary btn-trans"><i class="fa fa-archive"></i>&nbsp添加新相册</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">相册详情</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pages->totalCount ?>个相册</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="20%">名称</th>
                                            <th style="text-align: center;" width="20%">添加时间</th>
                                            <th style="text-align: center;" width="15%">封面</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <volist name="albumList" id="vo">
                                        <?php if(isset($albums)){
                                            foreach ($albums as $album) {
                                        ?>


                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                <span class="badge badge-primary  animated bounceIn">
                                                <?=$album['id'] ?>
                                                </span></td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$album['name'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php echo \Yii::$app->formatter->asDate($album['addtime'],'php:Y-m-d H:i:s'); ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <img src="<?=$album['url'] ?>" width="80px" height="80px"/>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <a href="<?=Url::toRoute(['admin/album/edit-album','album_id'=>$album['id']]) ?>">
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/album/delete-album','album_id'=>$album['id']]) ?>">
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                                    <a href="">
                                                        <button class="btn btn-info btn-sm"><i class="fa fa-search"></i> 查看</button>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php 
                                            }
                                            } ?>
                                        </volist>
                                    </tbody>
                                </table>
                                <div class="pages">
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

</body>

</html>
