<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="zh-cn">

    <head>
        <title>乐趣博客</title>
        <meta property="qc:admins" content="020436547764116211647676375636" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="<?=Url::to('@web/index/css/pintuer.css') ?>">
        <link rel="stylesheet" href="<?=Url::to('@web/index/css/my.css') ?>">
        <link rel="stylesheet" href="<?=Url::to('@web/index/css/page_css.cs') ?>s">
        <link rel="stylesheet" href="<?=Url::to('@web/index/css/gotop.css') ?>" />
        <script src="<?=Url::to('@web/index/js/jquery.js') ?>"></script>
        <script src="<?=Url::to('@web/index/js/pintuer.js') ?>"></script>
        <script src="<?=Url::to('@web/index/js/respond.js') ?>"></script>
        <script type="text/javascript" src="<?=Url::to('@web/index/js/gotop.js') ?>"></script>
    </head>

<body>
    <!--头部 -->
    <?php echo $this->render('../index/_top'); ?>

    <!--内容-->
    <?=$content?>

    <!--右部 -->
    <?php echo $this->render('../index/_right') ?>
    <!--底部 -->

    <?php echo $this->render('../index/_buttom') ?>

</body>
</html>
