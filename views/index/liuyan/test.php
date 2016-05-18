<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\i18n\Formatter;
$this->params['mylabels']=$mylabels;
$this->params['uid']=$uid;
$this->params['categories']=$categories;
$this->params['rand_articles']=$rand_articles;
$this->params['hotuser']=$hotuser;
$this->params['session_uid']=$session_uid;
 ?>
		<div class="container">
			<div class="">
				<ul class="bread">
					<h4>
					<li><a href="#" class="icon-home"> 首页</a> </li>					
					<li><a href="#">留言板</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							
								<div class="clearfix articlebox">
									<div class="liuyan_a">
									</div>
									<div class="said_img">
										<img src="images/18.jpg" class="radius-circle" width="60px" height="60px" />
										<div class="liuyan_t">
											<span class="icon-user"></span>&nbsp;&nbsp;<a>轮回</a>&nbsp;&nbsp;</span>
											<span class="icon-paper-plane"></span>&nbsp;2016年1月7日&nbsp;&nbsp;</span>
											<span class="tag bg-dot">win8.1</span>&nbsp;&nbsp;<span class="icon-map-marker"></span>&nbsp;甘肃兰州
										</div>
										<div class="liuyan_c">
											分享模板
										</div>

									</div>

									<!--回复-->
									<div class="f_liuyan">
										<hr />
										<div class="liuyan_a">
										</div>
										<div class="said_img">
											<img src="images/24.jpg" class="radius-circle" width="60px" height="60px" />
											<div class="liuyan_t">
												<span class="icon-user"></span>&nbsp;&nbsp;管理员&nbsp;&nbsp;</span>
												<span class="icon-paper-plane"></span>&nbsp;&nbsp;2016年1月7日&nbsp;&nbsp;
												<span>回复 @<a>轮回</a> 中说到：</span>
											</div>
											<div class="liuyan_c">
												谢谢
											</div>
										</div>
									</div>
								</div>
								<br />
							
							
							
							
							<br />
							
							<br />
							<hr />

							<div class="panel border-sub">
								<div class="panel-head border-sub bg-sub">
									<h3>留  言</h3>
								</div>
								<div class="panel-body">
									<div class="panel-body">
										<form action="#" method="post" class="form form-block">							
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">昵称</span>
													<input type="text" class="input" id="username" name="username" size="50" data-validate="required:请输入昵称" placeholder="昵称" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">邮箱</span>
													<input type="text" class="input"  id="email" name="email" size="20" data-validate="email:请输入正确的邮箱地址" placeholder="邮箱" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<textarea class="input" rows="5" name="content" cols="50" data-validate="required:请输入留言内容" placeholder="请输入留言内容"></textarea>
												</div>
											</div>
											
											<div class="form-button">
												<button class="button bg-blue button-big button-block" type="submit">
													提 交</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<br />
						</div>
						<hr />
					</div>
					<br />
					<br />
					<br />
				</div>