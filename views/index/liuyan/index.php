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
					<li><a href="#">留言板</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							
							<?php if(isset($liuyans)){
								foreach ($liuyans as $liuyan) {
									if($liuyan->ishidden==1){
							?>

								<div class="clearfix articlebox">
									<div class="liuyan_a">
									</div>
									<div class="said_img">
										<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$liuyan->guest_id]); ?>" target="_blank" title="<?=$liuyan->guest_author ?>">
										<img src="<?=$liuyan->guest_picture ?>" class="radius-circle" width="60px" height="60px" />
										</a>
										<div class="liuyan_t">
											<span class="icon-user"></span>&nbsp;&nbsp;
											<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$liuyan->guest_id]); ?>" target="_blank" title="<?=$liuyan->guest_author ?>"><?=$liuyan->guest_author ?></a>
											&nbsp;&nbsp;</span>
											<span class="icon-paper-plane"></span>&nbsp;<?php echo \Yii::$app->formatter->asDate($liuyan->guest_time,'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;</span>
											<span class="tag bg-dot"><?=$liuyan->guest_from ?></span>&nbsp;&nbsp;<span class="icon-map-marker"></span>&nbsp;<?=$liuyan->guest_location ?>
										</div>
										<div class="liuyan_c">
											<?=$liuyan->guest_content ?>
										</div>

									</div>
								
								<?php if($liuyan->isreply==1){ 
											foreach ($guestbook_replies as $guestbook_reply) {
												if($liuyan->id==$guestbook_reply['guestbook_id']){

								?>
									<!--回复-->
									<div class="f_liuyan">
										<hr />
										<div class="liuyan_a">
										</div>
										<div class="said_img">
										<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$bloger->id]); ?>" target="_blank" title="<?=$bloger->username ?>">
											<img src="<?=$bloger->headimage ?>" class="radius-circle" width="60px" height="60px" />
										</a>
											<div class="liuyan_t">
												<span class="icon-user"></span>&nbsp;&nbsp;
												<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$bloger->id]); ?>" target="_blank" title="<?=$bloger->username ?>"><?=$liuyan->author ?></a>
												&nbsp;&nbsp;</span>
												<span class="icon-paper-plane"></span>&nbsp;&nbsp;<?php echo \Yii::$app->formatter->asDate($guestbook_reply['author_reply_time'],'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;
												<span>回复 @<a><?=$liuyan->guest_author ?></a> 中说到：</span>
											</div>
											<div class="liuyan_c">
												<?=$guestbook_reply['author_reply'] ?>
											</div>
										</div>
									</div>
									<?php }}} ?>
								</div>
								<br />
							
							<?php 
								}else{
							?>
							<div class="clearfix articlebox">
									<div class="liuyan_a">
									</div>
									<div class="said_img">
										<a style="cursor: pointer;" title="不是注册用户，无法访问">
										<img src="<?=$liuyan->guest_picture ?>" class="radius-circle" width="60px" height="60px" />
										</a>
										<div class="liuyan_t">
											<span class="icon-user"></span>&nbsp;&nbsp;
											<a style="cursor: pointer;" title="不是注册用户，无法访问"><?=$liuyan->guest_author ?></a>
											&nbsp;&nbsp;</span>
											<span class="icon-paper-plane"></span>&nbsp;<?php echo \Yii::$app->formatter->asDate($liuyan->guest_time,'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;</span>
											<span class="tag bg-dot"><?=$liuyan->guest_from ?></span>&nbsp;&nbsp;<span class="icon-map-marker"></span>&nbsp;<?=$liuyan->guest_location ?>
										</div>
										<div class="liuyan_c">
											<?=$liuyan->guest_content ?>
										</div>

									</div>
								
								<?php if($liuyan->isreply==1){ 
											foreach ($guestbook_replies as $guestbook_reply) {
												if($liuyan->id==$guestbook_reply['guestbook_id']){

								?>
									<!--回复-->
									<div class="f_liuyan">
										<hr />
										<div class="liuyan_a">
										</div>
										<div class="said_img">
										<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$bloger->id]); ?>" target="_blank" title="<?=$bloger->username ?>">
											<img src="<?=$bloger->headimage ?>" class="radius-circle" width="60px" height="60px" />
										</a>
											<div class="liuyan_t">
												<span class="icon-user"></span>&nbsp;&nbsp;
												<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$bloger->id]); ?>" target="_blank" title="<?=$bloger->username ?>"><?=$liuyan->author ?></a>
												&nbsp;&nbsp;</span>
												<span class="icon-paper-plane"></span>&nbsp;&nbsp;<?php echo \Yii::$app->formatter->asDate($guestbook_reply['author_reply_time'],'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;
												<span>回复 @<a><?=$liuyan->guest_author ?></a> 中说到：</span>
											</div>
											<div class="liuyan_c">
												<?=$guestbook_reply['author_reply'] ?>
											</div>
										</div>
									</div>
									<?php }}} ?>
								</div>
								<br />
							<?php
								} }
								} ?>
							
							<?php echo LinkPager::widget([
								'pagination'=>$pages,
							]); ?>
	

						
						<?php if(!$session_uid) { ?>		
							<br />
							
							<br />
							<hr />
							<div class="panel border-sub">
								<div class="panel-head border-sub bg-sub">
									<h3>留  言</h3>
								</div>
								<div class="panel-body">
									<div class="panel-body">
										<form action="<?=Url::toRoute(['index/liuyan/check-liuyan','uid'=>$uid]) ?>" method="post" class="form form-block">							
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">昵称</span>

													<input type="text" class="input" id="username" name="guest_author" size="50" data-validate="required:请输入昵称" placeholder="昵称" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<div class="input-group">
														<span class="addon">邮箱</span>
													<input type="text" class="input"  id="email" name="guest_email" size="20" data-validate="email:请输入正确的邮箱地址;"  placeholder="邮箱" />
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="field">
													<textarea class="input" rows="5" name="guest_content" cols="50" data-validate="required:请输入留言内容" placeholder="请输入留言内容"></textarea>
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
								<h3>留  言</h3>
							</div>
							<div class="panel-body">
								<div class="panel-body">
									<form action="<?=Url::toRoute(['index/liuyan/check-liuyan','uid'=>$uid]) ?>" method="post" class="form form-block">							
										<div class="form-group">
											<div class="field">
												<div class="input-group">
													<span class="addon">昵称</span>

												<input type="text" class="input" id="username" name="guest_author" size="50" data-validate="required:请输入昵称" value="<?=$user->username ?>" readonly="readonly" />
												<input type="hidden" name="guest_picture" value="<?=$user->headimage ?>">
												<input type="hidden" name="guest_id" value="<?=$user->id ?>">
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="field">
												<div class="input-group">
													<span class="addon">邮箱</span>
												<input type="text" class="input"  id="email" name="guest_email" size="20" data-validate="email:请输入正确的邮箱地址" value="<?=$user->email ?>" readonly="readonly" />
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="field">
												<textarea class="input" rows="5" name="guest_content" cols="50" data-validate="required:请输入留言内容" placeholder="请输入留言内容"></textarea>
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
