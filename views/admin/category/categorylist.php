<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->params['user_headimage']=$user_headimage;
 ?>
 <?php $this->params['username']=$username; ?>
 <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>栏目管理</li>
                            <li class="active">栏目列表</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">
                        <a href="<?=URL::toRoute('admin/category/add-category') ?>">
                            <button class="btn btn-primary btn-trans"><i class="fa fa-archive"></i>&nbsp增加新栏目</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">栏目详情</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pages->totalCount ?>个栏目</span>    
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="20%">栏目名</th>
                                            <th style="text-align: center;" width="15%">栏目描述</th>
                                            <th style="text-align: center;" width="15%">栏目打开方式</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="tagList" id="vo">
                                        <?php foreach ($models as $model) { ?>
                                            <tr>
                                                <td style="text-align: center;"><span class="badge badge-primary animated bounceIn"><?=$model->id ?></span></td>
                                                <td style="text-align: center;">
                                                    <?=$model->name ?>
                                                </td>
                                                <td style="text-align: center;">
                                                   <?=$model->remark ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($model->open==1) {?>新窗口
                                                    <?php }else{ ?>
                                                    原窗口
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?=Url::toRoute(['admin/category/edit-category','cid'=>$model->id]) ?>">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                                    </a> 
                                                <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/category/delete-category','cid'=>$model->id]) ?>" >
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</button>
                                                </a> 
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </volist>
                                    </tbody>

                                </table>
                                <div class="pages">
                                   <?php echo LinkPager::widget([
                                        'pagination'=>$pages,
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
    <!-- Vector Map  -->
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- ToDo List  -->
    <script src="admin/assets/plugins/todo/js/todos.js"></script>
    <!--Load these page level functions-->
    
