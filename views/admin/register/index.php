<?php 
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>乐趣博客</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="admin/assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="admin/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Fonts from Font Awsome -->
    <link rel="stylesheet" href="admin/assets/css/font-awesome.min.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="admin/assets/css/animate.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="admin/assets/css/main.css">
    <!-- Fonts -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
    <!-- Feature detection -->
    <script src="admin/assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <section id="login-container">

        <div class="row">
            <div class="col-md-3" id="login-wrapper">
                <div class="panel panel-primary animated flipInY">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            乐趣博客注册
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>已有账号？
                            <a href="<?=Url::toRoute('admin/login/index') ?>">
                                <strong>登录</strong>
                            </a>
                        </p>
                        

                        <form id="registerform" role="form" action="<?=Url::toRoute('admin/register/check-register') ?>" method="post">
                            <!-- <input type="hidden" name="Register[token_status]" value="0"> -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">用户名</label>
                                <input type="text" class="form-control" id="username" name="Register[username]" placeholder="请输入用户名">
                                <span class="error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">邮箱</label>
                                <input type="text" class="form-control" id="mail" name="Register[email]" placeholder="请输入邮箱">
                                <span class="error1" style="color: red"></span>
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" class="form-control" id="pwd" name="Register[password]" placeholder="请输入密码">
                                <span class="error2" style="color: red"></span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">确认密码</label>
                                <input type="password" class="form-control" id="pwd1" name="Register[password1]" placeholder="请确认密码">
                                <span class="error3" style="color: red"></span>

                            </div>

                            <button class="btn btn-primary btn-block">注册</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--Global JS-->
    <script src="admin/assets/js/jquery-1.10.2.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="admin/assets/plugins/nanoScroller/jquery.nanoscroller.min.js"></script>
    <script src="admin/assets/js/application.js"></script>
    <script type="text/javascript">
    var checkUsername="<?=Url::toRoute('admin/register/check-username') ?>"
    var checkEmail="<?=Url::toRoute('admin/register/check-email') ?>"
    
    </script>
    <script src="admin/assets/js/register.js"></script>

</body>

</html>
