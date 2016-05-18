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
                            <li class="active">回复留言</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">留言回复</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pages->totalCount ?>篇回复</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="10%">昵称</th>
                                            <th style="text-align: center;" width="30%">评论内容</th>
                                            <th style="text-align: center;" width="30%">回复内容</th>
                                            <th style="text-align: center;" width="15%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="content" id="vo">
                                        <?php if(isset($models)){
                                            foreach ($models as $liuyanreply) {
                                        ?>


                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <span class="badge badge-danager animated bounceIn"><?=$liuyanreply->id ?></span></td>
                                                <?php foreach ($liuyans as $liuyan) {
                                                    if($liuyan->id==$liuyanreply->guestbook_id){
                                                ?>

                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyan->guest_author ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyan->guest_content ?>
                                                </td>
                                                <?php 
                                                    }
                                                } ?>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$liuyanreply->author_reply ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <a href="<?=Url::toRoute(['admin/liuyan/edit-liuyan-reply','liuyan_id'=>$liuyanreply->guestbook_id]) ?>">
                                                        <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> 编辑</button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/liuyan/delete-liuyan-reply','liuyan_reply_id'=>$liuyanreply->id]) ?>">
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
