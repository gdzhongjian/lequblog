<?php 
use yii\helpers\Url;
 ?>

 <?php if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){

 }else if(isset($_SERVER['HTTP_VIA'])){

 }else if(isset($_SERVER['HTTP_USER_AGENT'])){
 	$clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
 		 // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
    {
        
    }else{
    	?>
    	<div style="display: none;" id="rocket-to-top">
    		<div style="opacity:0;display: block;" class="level-2"></div>
    		<div class="level-3"></div>
		</div>
  <?php
    } 
 }else if(isset($_SERVER['HTTP_ACCEPT'])){
 	// 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {

        } 
    }else{
    	?>
<div style="display: none;" id="rocket-to-top">
    		<div style="opacity:0;display: block;" class="level-2"></div>
    		<div class="level-3"></div>
</div>
 <?php
    }
 	?>




<?php if(isset($this->params['session_uid'])){
	if(!$this->params['session_uid']){
?>

<div class="layout bg-black bg-inverse">
    <div class="container height-large">
				<!-- <span class="float-right text-small text-gray hidden-l">
				欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！
                <a class="text-main" href="http://www.pintuer.com">注册</a><span> | </span><a class="text-main" href="http://www.pintuer.com">登录</a><span>
				</span> -->
				<span class="float-right text-small text-gray hidden-l">
                <a class="text-main" href="<?=Url::toRoute('admin/login/index') ?>">登录</a><span> | </span><a class="text-main" href="<?=Url::toRoute('admin/register/index') ?>">注册</a><span> | </span><a class="text-main" href=""></a><span>  </span><a class="text-main"
                                                                                                                                                                                                                                                href=""></a>
				</span>
        欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！
        <!-- 欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！ -->
    </div>
</div>
<?php 		
	} } else{
?>
<div class="layout bg-black bg-inverse">
    <div class="container height-large">
				<!-- <span class="float-right text-small text-gray hidden-l">
				欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！
                <a class="text-main" href="http://www.pintuer.com">注册</a><span> | </span><a class="text-main" href="http://www.pintuer.com">登录</a><span>
				</span> -->
				<span class="float-right text-small text-gray hidden-l">
                <a class="text-main" href="<?=Url::toRoute('admin/login/index') ?>">登录</a><span> | </span><a class="text-main" href="<?=Url::toRoute('admin/register/index') ?>">注册</a><span> | </span><a class="text-main" href=""></a><span>  </span><a class="text-main"
                                                                                                                                                                                                                                                href=""></a>
				</span>
        欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！
        <!-- 欢迎访问<a href="http://www.pintuer.com">乐趣博客</a>！ -->
    </div>
</div>
<?php
	} ?>

		<div class="demo-nav padding-big-top fixed">
			<div class="container padding-top padding-bottom">
				<div class="line">
					<div class="xl12 xs3 xm3 xb2">
						<button class="button icon-navicon float-right" data-target="#header-demo"></button>
						<a href="#"><img src="index/images/logo.png" class="ring-hover" /></a>
					</div>
					<div class=" xl12 xs9 xm9 xb10 nav-navicon" id="header-demo">
						<div class="xs8 xm6 xb8 padding-small">
							<ul class="nav nav-menu nav-inline nav-big">
								<li><a href="<?=Url::toRoute(['index/index/index','uid'=>$this->params['uid']]) ?>">首页</a></li>
								<li>
									<a href="#">分类<span class="arrow"></span></a>
									<?php if(isset($this->params['categories'])){
											if($this->params['categories']){
									 ?>
									<ul class="drop-menu">
									<?php 
									foreach ($this->params['categories'] as $category) {?>
										<li><a href="<?=Url::toRoute(['index/category/index','uid'=>$this->params['uid'],'category_id'=>$category->id]) ?>" <?php if($category->open){echo "target='_blank'";} ?>><?=$category->name ?></a></li>
									<?php  }?>
									</ul>
									<?php } }?>
								</li>
								<li><a href="<?=Url::toRoute(['index/said/index','uid'=>$this->params['uid']]) ?>">说说</a></li>
								<li><a href="<?=Url::toRoute(['index/album/index','uid'=>$this->params['uid']]) ?>">相册</a></li>
								<li><a href="<?=Url::toRoute(['index/liuyan/index','uid'=>$this->params['uid']]) ?>">留言板</a></li>
								<li><a href="<?=Url::toRoute(['index/fangke/index','uid'=>$this->params['uid']]) ?>">访客</a></li>
								<!-- <li><a href="#">关于我</a></li> -->
							</ul>
						</div>
						<div class="xs4 xm3 xb4">
							<!-- <form>
								<div class="input-group padding-little-top">
									<input type="text" class="input border-main" name="keywords" size="30" placeholder="请输入关键词" />
									<span class="addbtn"><button type="button" class="button bg-main icon-search"></button></span>
								</div>
							</form> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--banner-->
		<div class="banner">
			<div class="carousel">
				<div class="item"><img src="<?=Url::to('@web/index/images/banner1.jpg') ?>" width="100%" height="300px" /></div>
				<div class="item"><img src="<?=Url::to('@web/index/images/banner2.jpg') ?>" width="100%" height="300px" /></div>
				<div class="item"><img src="<?=Url::to('@web/index/images/banner3.jpg') ?>" width="100%" height="300px" /></div>
			</div>
		</div>

		<br />