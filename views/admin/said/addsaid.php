<?php 
use yii\helpers\Url;
$this->params['user_headimage']=$user_headimage;
 ?>
 <?php $this->params['username']=$username; ?>
     <section class="main-content-wrapper">
			<section id="main-content">
				<div class="row">
					<div class="col-md-8">

						<ul class="breadcrumb">
							<li><a href="">主面板</a>
							</li>
							<li>发表内容</li>
							<li class="active">发表说说</li>
						</ul>

					</div>
				</div>
			
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">发表说说</h3>
								<div class="actions pull-right">
									<i class="fa fa-chevron-down"></i>
									<i class="fa fa-times"></i>
								</div>
							</div>
							<div class="panel-body">

								
								<form action="<?=Url::toRoute('admin/said/check-add-said') ?>" method="post" class="form-horizontal form-border" id="form" />
								<div class="form-group">
                                    <label class="col-sm-2 control-label">说说标题</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="input1" required="" placeholder="说说标题" name="title" value="" />
                                    </div>
                                </div>
								<div class="form-group">
									<label class="col-sm-2 control-label">说说正文</label>
									<div class="col-sm-8">
										<script id="editor" name="content" style="width:100%;height:300px;"></script>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">是否显示</label>
									<div class="col-sm-8">
										<label>
											<input type="radio" name="type" value="0" checked/>显示</label>
										<label>
											<input type="radio" name="type" value="1" />不显示</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">是否置顶</label>
									<div class="col-sm-8">
										<label>
											<input type="radio" name="istop" value="0" checked/>不置顶</label>
										<label>
											<input type="radio" name="istop" value="1" />置顶</label>
									</div>
								</div>
								<div class="form-group">
                                        <div class="col-sm-offset-3 ">
                                            <button type="submit" class="btn btn-primary">发表说说</button>
                                        </div>
                                    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>

        <script type="text/javascript" charset="utf-8" src="admin/said/Ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="admin/said/Ueditor/ueditor.all.min.js"></script>
		<script type="text/javascript">
			var ue = UE.getEditor('editor');
			 // 自定义的编辑器配置项,此处定义的配置项将覆盖editor_config.js中的同名配置
			// var editor_a = new baidu.editor.ui.Editor(editorOption);
			// editor_a.render('editor');
	
		</script>

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
