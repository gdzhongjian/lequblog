<?php 
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
 ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>乐趣博客</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="admin/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="admin/assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="admin/assets/css/animate.css">
		<link rel="stylesheet" href="admin/assets/css/main.css">
    	<link rel="stylesheet" href="admin/assets/plugins/icheck/css/_all.css">
		<script src="admin/assets/js/modernizr-2.6.2.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>

	<body>

		<section id="login-container">
			<div class="">
				<div class="col-md-3" id="login-wrapper">
					<div class="panel panel-primary animated flipInY">
						<div class="panel-heading">
							<h3 class="panel-title">
                            	乐趣博客登录
                        </h3>
						</div>
						<div class="panel-body">
							<p>还没有有账号？
                            <a href="<?=Url::toRoute('admin/register/index') ?>">
                                <strong>注册</strong>
                            </a>
                        	</p>
							<form id="loginform" class="form-horizontal" role="form" action="<?=Url::toRoute('admin/login/check-login') ?>" method="post">
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control" required="" name="Register[email]" id="email" placeholder="请输入邮箱">
										<i class="fa fa-user"></i>
										<span class="error" style="color: red"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="password" class="form-control" required="" name="Register[password]" id="password" placeholder="请输入密码">
										<i class="fa fa-lock"></i>
										<span class="error1" style="color: red"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
                                    <input class="icheck" type="checkbox" checked="checked" name="Register[check]" value="on">
                                    <label>记住密码</label>
                                    <a href="<?=Url::toRoute('admin/login/find-password') ?>" class="help-block">忘记密码?</a>
                                    </div>
                                </div>
								<div class="form-group">
									<div class="col-md-12">
                                    	<button class="btn btn-primary btn-block">登录</button>
                                    	<hr />
                                </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</section>
		
	<script src="admin/assets/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
    var checkEmail="<?=Url::toRoute('admin/register/check-email')?>"
    var checkPassword="<?=Url::toRoute('admin/login/check-password')?>"
    </script>
		
    <script src="admin/assets/js/login.js"></script>
		
	

	</body>

</html>