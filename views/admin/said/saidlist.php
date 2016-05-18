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
                            <li>内容管理</li>
                            <li class="active">说说列表</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">
                        <a href="<?=Url::toRoute('admin/said/add-said') ?>">
                            <button class="btn btn-primary btn-trans"><i class="fa fa-archive"></i>&nbsp发布新说说</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">说说列表</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">
                                    已有<?=$pages->totalCount ?>篇说说
                                    </span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="5%">编号</th>
                                            <th style="text-align: center;" width="30%">标题</th>
                                            <th style="text-align: center;" width="10%">是否显示</th>
                                            <th style="text-align: center;" width="10%">是否置顶</th>
                                            <th style="text-align: center;" width="15%">发表时间</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="saidList" id="vo">
                                        <?php if(isset($models)){
                                            foreach ($models as $model) {
                                        ?>


                                            <tr>
                                                <td style="text-align: center;"><span class="badge badge-primary animated bounceIn"><?=$model['id']  ?></span></td>
                                                <td style="text-align: center;"><?=$model->title ?></td>
                                                <td style="text-align: center;">
                                                    <?php if($model['type']==0) {?>
                                                    显示
                                                    <?php }else {?>
                                                    不显示
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($model['istop']==0) {?>
                                                    不置顶
                                                    <?php }else {?>
                                                    置顶
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php echo \Yii::$app->formatter->asDate($model->post_time,'php:Y-m-d H:i:s'); ?>
                                                </td>

                                                <td style="text-align: center;">
                                                    <a href="<?=Url::toRoute(['admin/said/edit-said','said_id'=>$model['id']]) ?>">
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/said/delete-said','said_id'=>$model->id]) ?>">
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</button>
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
                                    <?php
                                        echo LinkPager::widget(['pagination'=>$pages]);
                                    ?>
                                </div>

                            </div>
                        </div>
                        <include file="Public:footer" />
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
