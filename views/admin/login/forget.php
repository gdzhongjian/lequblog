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
                            	乐趣博客
                        </h3>
						</div>
						<div class="panel-body">
							<p>找回
								<a href="">
                                <strong>密码</strong>
                            </a>
                        	</p>
							<form id="loginform" class="form-horizontal" role="form" action="<?=Url::toRoute('admin/login/find-password-with-email') ?>" method="post">
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control" required="" name="email" id="email" 
										<?php if ($email) {?> 
										placeholder="<?=$email ?>"
										<?php }else { ?>
										placeholder="请输入邮箱">
										<?php } ?>
										<i class="fa fa-user"></i>
										<?php if($error){ ?>
										<span class="error" style="color: red"><?=$error ?></span>
										<?php }else{ ?>
										<span class="error" style="color: red"></span>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
                                    	<button type="button" class="btn btn-primary btn-block">找回密码</button>
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
    var checkEmail="<?=Url::toRoute('admin/register/check-email') ?>"
    </script>
    <script src="admin/assets/js/forget.js"></script>
	
	

	</body>

</html>