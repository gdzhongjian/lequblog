<?php 
use yii\helpers\Url;
 ?>
<div class="container-layout bg-black">
				<div class="border-top padding-top foot">
					<div class="text-center">
						<ul class="nav nav-inline">

							<li><a href="<?=Url::toRoute(['index/index/index','uid'=>$this->params['uid']]) ?>">网站首页</a> </li>
							<li><a style="cursor: pointer" id="jishufankui">技术反馈</a> </li>
							<li><a href="<?=Url::toRoute(['index/liuyan/index','uid'=>$this->params['uid']]) ?>">留言反馈</a> </li>
							<li><a style="cursor: pointer" id="lianxifangshi">联系方式</a> </li>

						</ul>
					</div>
					<div class="text-center height-big">
						Copyright © 2016 - 2016 乐趣博客 & 版权所有 粤ICP备16013100号 |
						<a href="<?=Url::toRoute('admin/login/index') ?>" target="_blank"> 博客管理  </a> |
						<a href="<?=Url::toRoute(['index/link/index','uid'=>$this->params['uid']]) ?>" target="_blank"> 申请友链  </a> |
					</div>
				</div>
			</div>
			<script>
			$("#jishufankui").click(function(){
				alert('作者：乐趣博客\n联系方式：1104785781@qq.com');
			});
			$("#lianxifangshi").click(function(){
				alert('作者：乐趣博客\n联系方式：1104785781@qq.com');
			});
			</script>