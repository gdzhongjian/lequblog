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
                            <li>友链管理</li>
                            <li class="active">友链申请列表</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">友链申请列表</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pages->totalCount ?>个友链申请记录</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="10%">名称</th>
                                            <th style="text-align: center;" width="20%">地址</th>
                                            <th style="text-align: center;" width="20%">介绍</th>
                                            <th style="text-align: center;" width="10%">邮箱</th>
                                            <th style="text-align: center;" width="8%">是否通过</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="content" id="vo">
                                        <?php if(isset($models)){
                                            foreach ($models as $link) {
                                        ?>


                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <span class="badge badge-danager animated bounceIn"><?=$link->id ?></span></td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$link->name ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$link->url ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$link->remark ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$link->email ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php if($link->ispass==0){
                                                        echo "否";
                                                        }else{
                                                            echo "是";
                                                            } ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <a href="<?=Url::toRoute(['admin/link/edit-new-link','link_id'=>$link->id]) ?>">
                                                        <button class="btn btn-primary"><i class="icon-pencil icon-white"></i> 处理</button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="">
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
