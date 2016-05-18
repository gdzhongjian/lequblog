<?php 
use yii\helpers\Url;
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
                            <li class="active">留言回复</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">

                    </div>
                </div>
<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					
					<div class="ibox-content">
						<form class="form-horizontal" method="post" action="<?=Url::toRoute('admin/liuyan/check-liuyan-reply') ?>" name="basic_validate" id="signupForm">							
							<input type="hidden" name="guestbook_id" value="<?=$liuyan['id'] ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label">留言昵称</label>
								<div class="col-sm-6">
									<input type="text" name="username" id="username" value="<?=$liuyan['guest_author'] ?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言邮箱</label>
								<div class="col-sm-6">
									<input type="text" name="email" id="email" value="<?=$liuyan['guest_email'] ?>" class="form-control" readonly="readonly">
								</div>
							</div>												
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言内容</label>
								<div class="col-sm-6">
									<textarea type="text" rows="4" name="a_content" id="content" class="form-control" readonly="readonly"><?=$liuyan['guest_content'] ?></textarea>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言IP</label>
								<div class="col-sm-6">
									<input type="text" name="ip" id="ip" value="<?=$liuyan['guest_ip'] ?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言人所在地</label>
								<div class="col-sm-6">
									<input type="text" name="ip" id="ip" value="<?=$liuyan['guest_location'] ?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言设备</label>
								<div class="col-sm-6">
									<input type="text" name="from" id="from" value="<?=$liuyan['guest_from'] ?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">留言时间</label>
								<div class="col-sm-6">
									<input type="text" name="add_time" id="add_time" value="<?php echo \Yii::$app->formatter->asDate($liuyan->guest_time,'php:Y-m-d H:i:s')?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">回复内容</label>
								<div class="col-sm-10">
									<script type="text/plain" id="editor" name="content" style="width:78%;height:200px;"></script>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button class="btn btn-primary" type="submit">回复留言</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!--Global JS-->
    <script type="text/javascript" charset="utf-8" src="admin/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="admin/Ueditor/ueditor.all.min.js"></script>
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
   
    <!-- ToDo List  -->
    <script src="admin/assets/plugins/todo/js/todos.js"></script>
    <!--Load these page level functions-->
    <script>
    $(document).ready(function() {
        app.timer();
        app.weather();
    });
    </script> 

		<script type="text/javascript" charset="utf-8" src="admin/said/Ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="admin/said/Ueditor/ueditor.all.min.js"></script>
		<script type="text/javascript">
		
		var editorOption = { 
		toolbars:[[
	            'fullscreen', 'source', '|', 'undo', 'redo', '|',
	            'bold', 'italic', 'underline','removeformat', 'formatmatch', 
	            'pasteplain', '|', 'forecolor', 'fontfamily', 'fontsize', '|', 'link', 'unlink',
	            'simpleupload','emotion','attachment']], 
		}; 
		var editor_a = new baidu.editor.ui.Editor(editorOption);
		editor_a.render('editor');
		
		</script>