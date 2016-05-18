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
                    <div class="col-md-8">

                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li>友链管理</li>
                            <li class="active">友情链接处理</li>
                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">友情链接处理</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="<?=Url::toRoute('admin/link/check-edit-link') ?>" method="post" class="form-horizontal" />
                                    <input name="id" value="<?=$link->id ?>" type="hidden"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">友链名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"  name="name" value="<?=$link->name ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">域名</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="url" value="<?=$link->url ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">申请人邮箱</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="email" value="<?=$link->email ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">申请时间</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="addtime" value="<?php echo \Yii::$app->formatter->asDate($link->addtime,'php:Y-m-d H:i:s'); ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <hr />
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">友链描述</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="remark" readonly="readonly">
                                            <?=$link->remark ?>
                                        </textarea>
                                    </div>
                                </div>
                
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否通过</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" name="ispass" value="0" <?php if($link->ispass==0){echo "checked";} ?>/>不通过</label>
                                    <label><input type="radio" name="ispass" value="1" <?php if($link->ispass==1){echo "checked";} ?>/>通过</label>    
                                    </div>
                                </div>
                                <hr />
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">友链级别</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" name="level" value="0" <?php if($link->level==0){echo "checked";} ?>/>0</label>&nbsp;
                                    <label><input type="radio" name="level" value="1" <?php if($link->level==1){echo "checked";} ?>/>1</label>&nbsp;    
                                    <label><input type="radio" name="level" value="2" <?php if($link->level==2){echo "checked";} ?>/>2</label>&nbsp;    
                                    <label><input type="radio" name="level" value="3" <?php if($link->level==3){echo "checked";} ?>/>3</label>&nbsp;    
                                    <label><input type="radio" name="level" value="4" <?php if($link->level==4){echo "checked";} ?>/>4</label>&nbsp;    
                                    <label><input type="radio" name="level" value="5" <?php if($link->level==5){echo "checked";} ?>/>5</label>&nbsp;    
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否显示</label>
                                    <div class="col-sm-8">
                                        <label><input type="radio" name="type" value="0" <?php if($link->type==0){echo "checked";} ?>/>显示</label>
                                    <label><input type="radio" name="type" value="1" <?php if($link->type==1){echo "checked";} ?>/>不显示</label>    
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <div class="col-sm-offset-3 ">
                                        <button type="submit" class="btn btn-primary">确认</button>
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
    $(document).ready(function() {
        app.timer();
        app.map();
        app.weather();
    });
    </script>   

</body>

</html>
