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
					<li><a href="#" class="icon-home"> 首页</a> </li>					
					<li><a href="#">留言板</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							<?php if(isset($follows)){
								if($follows){
									$a=-1;
									foreach ($follows as $follow) {
										$a++;
							?>


								<div class="clearfix articlebox">
									<div class="liuyan_a">
									</div>
									<div class="said_img">
									<a href="<?=Url::toRoute(['index/index/index','uid'=>$follow->follow_uid]) ?>" title="" target="_blank">
										<img src="<?=$follow->follow_headimage ?>" class="radius-circle" width="60px" height="60px" title="<?=$follow->follow ?>"/>
									</a>
										<div class="liuyan_t">
											<span class="icon-user"></span>&nbsp;&nbsp;<a><?=$follow->follow ?></a>&nbsp;&nbsp;</span>
											<?php if($follow->follow_sex==0){
											?>
											&nbsp;<span class="icon-male" style="color: #198FE2"></span> 
											<?php
												}else{
											?>
											&nbsp;<span class="icon-female" style="color: #FC8383"></span> 
											<?php
											} ?>
										</div>
										<div class="liuyan_c">
											
										<?php if(isset($session_uid)){
											if($session_uid){
												//是本人用户才会显示关注按钮
												if($session_uid==$uid){
													if(isset($checkeachfollow)){
														if($checkeachfollow[$a]==1){
										?>
										&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="取消关注">已关注</a>
										<?php 
														}else{
										?>
										&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="取消关注">相互关注</a>

										<?php 
														}
													}
												}else{
													if(isset($checkotherfollow)){
														if($checkotherfollow[$a]==0){
													?>
													&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="关注">关注</a>
													<?php 
																	}else if($checkotherfollow[$a]==1) {
													?>
													&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="取消关注">已关注</a>

													<?php 
																	}else{
													?>
													&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="取消关注">相互关注</a>

													<?php 
																	}
																}
												}

											}
											} ?>

										</div>

									</div>

								</div>
								<br />
							
								<?php 
									}
								}
								} ?>
							
							
							<br />
							
							<br />
							<hr />

							
							<br />
						</div>
						<hr />
					</div>
					<br />
					<br />
					<br />
				</div>