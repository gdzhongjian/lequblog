<?php 
use yii\helpers\Url;
$this->params['user_headimage']=$user_headimage;

 ?>
 <?php $this->params['username']=$username; ?>
        <!--main content start-->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-8">

                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>栏目管理</li>
                            <li class="active"><?php if($status) {?>添加栏目 <?php }else { ?>修改栏目 <?php } ?></li>
                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php if($status) {?>添加栏目 <?php }else { ?>修改栏目 <?php } ?> </h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php if($status) {?>
                                <form action="<?=Url::toRoute('admin/category/check-add-category') ?>" method="post" class="form-horizontal" />
                                <?php }else {?>
                                <form action="<?=Url::toRoute('admin/category/check-update-category') ?>" method="post" class="form-horizontal" />
                                <?php } ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">栏目名称</label>
                                    <div class="col-sm-8">
                                        <?php if($status) {?>
                                        <input type="text" class="form-control" id="lanmuname" required="" placeholder="栏目名称" name="Category[name]" value=""/>
                                        <?php }else {?>
                                        <input type="text" class="form-control" id="lanmuname" required="" value="<?=$category->name ?>" name="Category[name]" value=""/>
                                        <input type="hidden" name="Category[id]" value="<?=$category->id ?>">
                                        <?php } ?>
                                        <span class="error" style="color: red"></span>
                                        <input type="hidden" name="Category[uid]" value="<?=$uid ?>">
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">栏目描述</label>
                                    <div class="col-sm-8">
                                        <?php if($status) {?>
                                        <textarea placeholder="栏目描述" class="form-control" required="" name="Category[remark]" ></textarea>
                                        <?php } else{?>
                                        <textarea  class="form-control" required="" name="Category[remark]" ><?=$category->remark ?></textarea>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">打开方式</label>
                                    <div class="col-sm-8">
                                    <?php if($status) {?>
                                    <label>
                                        <input type="radio" name="Category[open]" value="0" checked /> 原窗口   
                                    </label>
                                    <label>
                                        <input type="radio" name="Category[open]" value="1" /> 新窗口
                                    </label>
                                    <?php }else{ ?>
                                    <label>
                                        <input type="radio" name="Category[open]" value="0" <?php if(!$category->open) {echo "checked";}?> /> 原窗口   
                                    </label>
                                    <label>
                                        <input type="radio" name="Category[open]" value="1" <?php if($category->open){echo "checked";} ?> /> 新窗口
                                    </label>
                                    <?php } ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <div class="col-sm-offset-3 ">
                                        <button type="submit" class="btn btn-primary"><?php if($status) {?>添加栏目 <?php }else { ?>修改栏目 <?php } ?></button>
                                    </div>
                                </div>
                                </form>
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
  
    </script> 
    <script type="text/javascript">
    var checkName="<?=Url::toRoute('admin/category/check-name') ?>";
    </script>  
    <script type="text/javascript" src="admin/assets/js/category/category.js"></script>
