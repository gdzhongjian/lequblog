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
$this->params['newliuyans']=$newliuyans;
$this->params['mosthits']=$mosthits;
$this->params['myinfo']=$myinfo;
$this->params['links']=$links;
$this->params['hotalbums']=$hotalbums;
$this->params['follow_message']=$follow_message;
$this->params['follow_count']=$follow_count;
$this->params['fans_count']=$fans_count;
 ?>
		<div class="container">
			<div class="">
				<ul class="bread">
					<h4>
					<li><a href="<?=Url::toRoute(['index/index/index','uid'=>$uid]) ?>" class="icon-home"> 首页</a> </li>					
					<li><a href="#">申请友链</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
						
						<?php if(!$session_uid) { ?>		
							<br />
							
							<br />
							<hr />
							<div class="panel border-sub">
								<div class="panel-head border-sub bg-sub">
									<h3>申  请	友	链</h3>
								</div>
								<div class="panel-body">
									<div class="panel-body">
										<form action="<?=Url::toRoute(['index/link/check-link','uid'=>$uid]) ?>" method="post" class="form form-block">							
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">友链名称</span>

													<input type="text" class="input" id="name" name="name" size="50" data-validate="required:请输入友链名称" placeholder="请输入友情链接名称" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">友链地址</span>

													<input type="text" class="input" id="url" name="url" size="50" data-validate="required:请输入友链地址" placeholder="请输入友情链接地址" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">邮箱</span>
													<input type="text" class="input"  id="email" name="email" size="20" data-validate="email:请输入正确的邮箱地址" placeholder="请输入您的邮箱" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<textarea class="input" rows="5" name="remark" cols="50" data-validate="required:请输入友情链接介绍" placeholder="请输入友情链接介绍内容"></textarea>
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
						<?php }else{
							if($session_uid!=$uid){
						?>
							<br />
							
							<br />
							<hr />
							<div class="panel border-sub">
								<div class="panel-head border-sub bg-sub">
									<h3>申  请	友	链</h3>
								</div>
								<div class="panel-body">
									<div class="panel-body">
										<form action="<?=Url::toRoute(['index/link/check-link','uid'=>$uid]) ?>" method="post" class="form form-block">							
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">友链名称</span>

													<input type="text" class="input" id="name" name="name" size="50" data-validate="required:请输入友链名称" value="<?=$user->username ?>" readonly="readonly"/>
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">友链地址</span>

													<input type="text" class="input" id="url" name="url" size="50" data-validate="required:请输入友链地址" value="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$user->id]); ?>" readonly="readonly"/>
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">邮箱</span>
													<input type="text" class="input"  id="email" name="email" size="20" data-validate="email:请输入正确的邮箱地址" value="<?=$user->email ?>" readonly="readonly"/>
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<textarea class="input" rows="5" name="remark" cols="50" data-validate="required:请输入友情链接介绍" placeholder="请输入友情链接介绍内容"></textarea>
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
						<?php }else{?>

						<?php }} ?>


							<br />
						</div>
						<hr />
					</div>
					<br />
					<br />
					<br />
				</div>
