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
                            <li>互动管理</li>
                            <li class="active">留言评论</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">留言评论</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pages->totalCount ?>篇评论</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="10%">昵称</th>
                                            <th style="text-align: center;" width="15%">邮箱</th>
                                            <th style="text-align: center;" width="30%">评论内容</th>
                                            <th style="text-align: center;" width="10%">评论时间</th>
                                            <th style="text-align: center;" width="8%">是否回复</th>
                                            <th style="text-align: center;" width="15%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="content" id="vo">
                                        <?php if(isset($models)){
                                            foreach ($models as $liuyan) {
                                        ?>


                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <span class="badge badge-danager animated bounceIn"><?=$liuyan->id ?></span></td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyan->guest_author ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyan->guest_email ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyan->guest_content ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php echo \Yii::$app->formatter->asDate($liuyan->guest_time,'php:Y-m-d H:i:s') ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php if($liuyan->isreply==0){
                                                        echo "否";
                                                        }else{
                                                            echo "是";
                                                            } ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                <?php if($liuyan->isreply==0){?>
                                                    <a href="<?=Url::toRoute(['admin/liuyan/liuyan-reply','liuyan_id'=>$liuyan->id]) ?>">
                                                        <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> 回复</button>
                                                    </a>
                                                <?php }else{ ?>
                                                    <a href="<?=Url::toRoute(['admin/liuyan/edit-liuyan-reply','liuyan_id'=>$liuyan->id]) ?>">
                                                        <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> 编辑</button>
                                                    </a>
                                                <?php } ?>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/liuyan/delete-liuyan','liuyan_id'=>$liuyan->id]) ?>">
                                                        <button class="btn btn-danger"><i class="icon-remove icon-white"></i> 删除</button>
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
                                   <?php echo LinkPager::widget([
                                        'pagination'=>$pages
                                   ]); ?>
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
