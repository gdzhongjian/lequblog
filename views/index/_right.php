

<?php 
use yii\helpers\Url;
 ?>
<div class="xl12 xm4">
				<?php if(isset($this->params['myinfo'])){ ?>
					<div style="text-align: center">
					
						<h3 style="text-align: left"><span class="icon-user"></span> 用户信息</h3>
						<br />
						<div style="width:60px;height:60px;border-radius: 50%;overflow: hidden;margin-left: 40%">
                        	<a class="float-left" href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$this->params['myinfo']->id]); ?>">
                        		<img src="<?=$this->params['myinfo']->headimage ?>" alt="<?=$this->params['myinfo']->username ?>" title="<?=$this->params['myinfo']->username ?>" width="60px" height="60px">
							</a>
						</div>
						<div style="">
							<h4>
							<span>
								<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$this->params['myinfo']->id]); ?>" title="<?=$this->params['myinfo']->username ?>"><?=$this->params['myinfo']->username ?></a>
								<?php if($this->params['myinfo']->sex==0){
								?>
								&nbsp;<span class="icon-male" style="color: #198FE2"></span> 
								<?php
									}else{
								?>
								&nbsp;<span class="icon-female" style="color: #FC8383"></span> 
								<?php
										} ?>
								<?php if(isset($this->params['session_uid'])){
									if($this->params['session_uid']){
										//不是本人用户才会显示关注按钮
										if($this->params['session_uid']!=$this->params['uid']){
											if(isset($this->params['follow_message'])){
												if($this->params['follow_message']==0){
								?>
								&nbsp;&nbsp;<a style="cursor: pointer" class="button button-little bg-red" id="follow" title="关注">关注</a>
								<?php 
												}else if($this->params['follow_message']==1) {
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
							</span>
							</h4>
						</div>
						<!-- <div style="">
							<h4>
								<span>
									<a style="cursor: pointer" class="button button-little bg-red">关注</a>
								</span>
							</h4>
						</div> -->
						<div style="">
							<h4>
								<span>
									<a style="cursor: pointer" href="<?=Url::toRoute(['index/fans/follow-list','uid'=>$this->params['uid']]) ?>">关注：
									<span id="followshuliang">
									<?php if(isset($this->params['follow_count'])){
										if($this->params['follow_count']){
											echo $this->params['follow_count'];
										}else{
											echo "0";
										}
										} ?>
										</span>
									人</a> &nbsp;|&nbsp; 
									<a style="cursor: pointer" href="<?=Url::toRoute(['index/fans/fans-list','uid'=>$this->params['uid']]) ?>">粉丝：
									<span id="fansshuliang">
									<?php if(isset($this->params['fans_count'])){
										if($this->params['fans_count']){
											echo $this->params['fans_count'];
										}else{
											echo "0";
										}
										} ?>
										</span>
									人</a>
								</span>
							</h4>
						</div>
						<div style="">
							<h4>
								<span>
									简介: <?php if($this->params['myinfo']->brief){
										echo $this->params['myinfo']->brief;
										}else{
											echo "暂无简介";
										} ?>
								</span>
							</h4>
						</div>
						
                        <!-- <img src="public/image/headimage/default/1.jpg" alt="" class="img-circle" width="50px" height="50px"> -->
						
					</div>
						
					<br />
					<hr />
					<?php  }?>
					<!-- <div>
						<h3><span class="icon-cloud-download"></span> 程序下载</h3>
						<br />
						<div class="tool">
							<h4><span>站点版本：Lunhui v1.50 beta1</span></h4>
							<h4><span>开源版本：Lunhui v1.42.20160106</span>
				<a href="#"><button id="download" class="button button-little bg-red">下载</button></a>
			</h4>
							<h4><span>提取密码：guvs</span>
		</div>
	</div> -->
	<!-- <br />
	<hr /> -->
	<div>
		<h3><span class="icon-wrench"></span> 我的标签</h3>		
		<h4>
			<div class="tag-ul">
                <volist name="tag" id="v" empty="暂时没有标签">
                	<?php if(isset($this->params['mylabels'])){
                		$uid=$this->params['uid'];
                		foreach ($this->params['mylabels'] as $mylabel) {
                			$rand=rand(1,6);
                			if($rand==1){
                	?>
                        <a class="button button-little bg-main shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
                	<?php }else if($rand==2){ ?>
                        <a class="button button-little bg-sub shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
					<?php } else if($rand==3){?>
                        <a class="button button-little bg-red shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
					<?php }else if($rand==4) {?>
                        <a class="button button-little bg-yellow shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
					<?php }else if($rand==5) {?>
                        <a class="button button-little bg-blue shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
					<?php }else {?>
                        <a class="button button-little bg-green shake-hover" href="<?=Url::toRoute(['index/label/index','label_id'=>$mylabel->id,'uid'=>$uid]) ?>"><?=$mylabel->name ?></a>
                	<?php
                		}
                		}
                		} ?>

                <!--     <if condition="$v['a_id'] % 6 ==1">
                        <a class="button button-little bg-main shake-hover" href="#">标签1</a>
                    </if>
                    <if condition="$v['a_id'] % 6 ==2">
                        <a class="button button-little bg-sub shake-hover" href="#">标签2</a>
                    </if>
                    <if condition="$v['a_id'] % 6 ==3">
                        <a class="button button-little bg-red shake-hover" href="#">标签3</a>
                    </if>
                    <if condition="$v['a_id'] % 6 ==4">
                        <a class="button button-little bg-yellow shake-hover" href="#">标签4</a>
                    </if>
                    <if condition="$v['a_id'] % 6 ==5">
                        <a class="button button-little bg-blue shake-hover" href="#">标签5</a>
                    </if>
                    <if condition="$v['a_id'] % 6 ==0">
                        <a class="button button-little bg-green shake-hover" href="#">标签6</a>
                    </if>
 -->

                </volist>
            </div>			
		</h4>
						</div>
						<hr />
						<h2 class="bg-main text-white padding">随机文章</h2>
						<div class="padding-big bg">
							<ul class="list-media list-underline">
							<?php if(isset($this->params['rand_articles'])){
								foreach ($this->params['rand_articles'] as $article) {
							?>

								<li>
									<div class="media media-x img-small">
										<a class="float-left" href="<?=Url::toRoute(['index/article/index','uid'=>$this->params['uid'],'article_id'=>$article['id']]) ?>"><img src="<?=$article['picture'] ?>" class="radius"></a>
										<div class="media-body">
											<strong><?=$article['title'] ?></strong>
											<?php $length=mb_strlen($article['remark'],'utf-8');
												if($length>43){
													$remark=mb_substr($article['remark'],0,43,'utf-8');
													$remark.="...";
													echo $remark;
												}else{
													$remark=mb_substr($article['remark'],0,43,'utf-8');
													echo $remark;
												}
											 ?>
											<!-- <?=$article['remark'] ?> -->

											<a class="button button-little border-red swing-hover" href="<?=Url::toRoute(['index/article/index','uid'=>$this->params['uid'],'article_id'=>$article['id']]) ?>">查看详情</a>
										</div>
									</div>
								</li>
								
							<?php 
								}
								} ?>
						
							</ul>
						</div>
						<br />
						<div class="tab border-main" data-toggle="hover" style="height: auto;">
							<div class="tab-head">

								<ul class="tab-nav">
									<li class="active"><a href="#tab-start2">最新留言</a> </li>
									<li><a href="#tab-css2">热门相册</a> </li>
									<li><a href="#tab-units2">热门文章</a> </li>
								</ul>
							</div>
							<div class="tab-body ">
								<div class="tab-panel active" id="tab-start2">
									<?php if(isset($this->params['newliuyans'])){
											if($this->params['newliuyans']){
												foreach ($this->params['newliuyans'] as $newliuyan) {
													if($newliuyan->ishidden==1){
									?>


									<div class="panel-group" style="border-top: solid 0px #ddd;">
										<div class="media media-x">
											<a class="float-left" href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$newliuyan->guest_id]); ?>" title="<?=$newliuyan->guest_author ?>" target="_blank">
												<img src="<?=$newliuyan->guest_picture ?>" class="radius-circle" width="60px" height="60px">
											</a>
											<div class="media-body">
												<strong><span class="icon-user"></span>  
												<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$newliuyan->guest_id]); ?>" title="<?=$newliuyan->guest_author ?>" target="_blank"><?=$newliuyan->guest_author ?></a>
												</strong>
												<span class="tag bg-dot"><?=$newliuyan->guest_from ?></span> <?=$newliuyan->guest_content ?>
											</div>
										</div>
									</div>
									
									<?php
												}else{?>
									<div class="panel-group" style="border-top: solid 0px #ddd;">
										<div class="media media-x">
											<a class="float-left" title="不是注册用户，无法访问" style="cursor: pointer">
												<img src="<?=$newliuyan->guest_picture ?>" class="radius-circle" width="60px" height="60px">
											</a>
											<div class="media-body">
												<strong><span class="icon-user"></span>  
												<a title="不是注册用户，无法访问" style="cursor: pointer"><?=$newliuyan->guest_author ?></a>
												</strong>
												<span class="tag bg-dot"><?=$newliuyan->guest_from ?></span> <?=$newliuyan->guest_content ?>
											</div>
										</div>
									</div>

									<?php
												} }} else{
													echo "暂无留言";
												}
										}
									?>    
									
									

								</div>
								<div class="tab-panel" id="tab-css2">
								<?php if(isset($this->params['hotalbums'])){
									if($this->params['hotalbums']){
										foreach ($this->params['hotalbums'] as $album) {
								?>

									<div class="panel-group" style="border-top: solid 0px #ddd;">
										<div class="media media-x">
											<a class="float-left" href="<?=Url::toRoute(['index/album/picture-list','album_id'=>$album->id,'uid'=>$this->params['uid']]) ?>" title="<?=$album->name ?>" target="_blank">
												<img src="<?=$album->url ?>" width="60px" height="60px" class="radius-circle">
											</a>
											<div class="media-body">
												<strong>  
												<a href="<?=Url::toRoute(['index/album/picture-list','album_id'=>$album->id,'uid'=>$this->params['uid']]) ?>" title="<?=$album->name ?>" target="_blank"><?=$album->name ?></a>
												</strong>
												<strong> 
												<span class="tag bg-dot"><big><?=$album->hits ?>&nbsp;热度</big></span> 
												
												</strong>
											</div>
										</div>
									</div>
										<!-- <volist name="hits" id="v">
											<li style="margin-bottom:8px"><h4>
											<a href=""><span class="icon-user"></span> 111</a>
											</h4></li>
										</volist> -->

								<?php 
									}
								}else{echo "暂无相册";}
								} ?>
	
								</div>
								<div class="tab-panel" id="tab-units2">
										<?php if(isset($this->params['mosthits'])){
												if($this->params['mosthits']){
												foreach ($this->params['mosthits'] as $mosthits) {
									?>


									<volist name="hits" id="v">
											<li style="margin-bottom:8px"><h4>
											<a href="<?=Url::toRoute(['index/article/index','uid'=>$this->params['uid'],'article_id'=>$mosthits->id]) ?>" title="<?=$mosthits->title ?>">
											<span class="icon-book"></span> 
											<?php $length=mb_strlen($mosthits->title,'utf-8');
												if($length>18){
													$remark=mb_substr($mosthits->title,0,18,'utf-8');
													$remark.="...";
													echo $remark;
												}else{
													$remark=mb_substr($mosthits->title,0,18,'utf-8');
													echo $remark;
												}
											 ?>
											<!-- <?=$mosthits->title ?> -->

											（<?=$mosthits->hits ?>）
											 </a>
											</h4></li>
										</volist>
									
									<?php
												}
										}else{
											echo "暂无文章";
										}}?> 

								</div>
							</div>
						</div>
						<br>	
						<hr>
						<br>		
						<div>
							<h3><span class="icon-star"></span> 热门博客</h3>
							<br />
							
							<div class="links">

							<?php if(isset($this->params['hotuser'])){
								if($this->params['hotuser']){
								foreach ($this->params['hotuser'] as $user) {
							?>

								<volist name="link" id="vo">
									<a href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute('index/index/index').'&uid='.$user->id; ?>" target="_blank" class="button border-blue" role="button"><?=$user->username ?></a>&nbsp;
								</volist>
							<?php
								}
								}else{echo "暂无热门博客！";} } ?>
							</div>
							

						</div>
						<br />
						<hr />
						<br />

						<div>
							<h3><span class="icon-tags"></span> 友情链接</h3>
							<br />
							<div class="links">
								<volist name="link" id="vo">
									<?php if(isset($this->params['links'])){
										if($this->params['links']){
										foreach ($this->params['links'] as $link) {
									?>

									<a href="<?=$link->url ?>" target="_blank" class="button border-blue" role="button"><?=$link->name ?></a>&nbsp;
									<?php 
										}
										}else{echo "暂无友情链接";} }  ?>
								</volist>
							</div>
						</div>
						<br />
						<hr />
						<br />

					</div>
					<script>
					$(document).ready(function(){
						$("#follow").click(function(){
							var value=$("#follow").attr('title');
							var url="<?=Url::toRoute(['index/fans/add-follow','uid'=>$this->params['uid']]) ?>"
							$.post(
								url,
								{
									value:value
								 }, 
								function(data){
									if(data==1){
										$("#follow").attr('title', '取消关注');
										$("#follow").text('已关注');
										var oldfans=$("#fansshuliang").text();
										oldfans++;
										$("#fansshuliang").text(oldfans);
									}else if(data==2){
										$("#follow").attr('title', '取消关注');
										$("#follow").text('相互关注');
										var oldfans=$("#fansshuliang").text();
										oldfans++;
										$("#fansshuliang").text(oldfans);
									}else if(data==0){
										$("#follow").attr('title','关注');
									}else if(data==3){
										$("#follow").attr('title','关注');
										$("#follow").text('关注');
										var oldfans=$("#fansshuliang").text();
										oldfans--;
										$("#fansshuliang").text(oldfans);
									}
									else{
										$("#follow").attr('title','取消关注');
									}
								}
								);
						});
					});
					</script>
				</div>
			</div>