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
<link rel="stylesheet" href="admin/Ueditor/third-party/SyntaxHighlighter/shCore.min.css" ></script>
 <script type="text/javascript" src="admin/Ueditor/third-party/SyntaxHighlighter/shCore.min.js" ></script>         
        <script>  
        	SyntaxHighlighter.config.clipboardSwf = 'public/clipboard.swf';
			SyntaxHighlighter.all();    
		</script>
		
		<div class="container">
			<div class="">
				<ul class="bread">
					<h4>
					<li><a href="<?=Url::toRoute(['index/index/index','uid'=>$uid]) ?>" class="icon-home"> 首页</a> </li>					
					<li><a href="#">文章正文</li></a>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							<div class="a_title"><?=$article->title ?></div>
							<div class="a-write">时间：&nbsp;<?php echo \Yii::$app->formatter->asDate($article->post_time,'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;作者：<a><?=$article->author ?></a>&nbsp;&nbsp;阅读：（<?=$article->hits ?>）</div>
							<div class="a-content">
								<?=$article->content ?>
							</div>
							<div class="a-write hidden-xs">
								<eq name="Article.a_type" value="1">本文为原创，转载请注明出处:&nbsp;&nbsp;
								<a>
									<?php echo \Yii::$app->request->getHostInfo().Url::toRoute('index/article/index').'&uid='.$uid.'&article_id='.$article->id; ?>
								</a>
									<br>
								</eq>
								发表自：&nbsp;<?=$article->from ?>&nbsp;&nbsp;地址：<?=$article->article_location ?>&nbsp;&nbsp;评论：&nbsp;0&nbsp;&nbsp;关键词：&nbsp;
								<?php if(isset($labels_name)){
									for($i=0;$i<count($labels_name);$i++){
										echo $labels_name[$i];
										echo " ";
									}
									}else{
										echo "暂无关键词";
										} ?>
								&nbsp;&nbsp;
							</div>
							<br />
							<div class="bdsharebuttonbox fenxiang">
								<a class="bds_more" href="#" data-cmd="more"></a>
								<a title="分享到QQ空间" class="bds_qzone" href="#" data-cmd="qzone"></a>
								<a title="分享到腾讯微博" class="bds_tqq" href="#" data-cmd="tqq"></a>
								<a title="分享到微信" class="bds_weixin" href="#" data-cmd="weixin"></a>
								<a title="分享到百度贴吧" class="bds_tieba" href="#" data-cmd="tieba"></a>
								<a title="分享到百度云收藏" class="bds_bdysc" href="#" data-cmd="bdysc"></a>
								<a title="分享到QQ好友" class="bds_sqq" href="#" data-cmd="sqq"></a>
							</div>
							<script>
								var host="<?php echo \Yii::$app->request->getHostInfo(); ?>";
								var basehome="<?php echo \Yii::$app->request->baseUrl; ?>";
								basehome=basehome.substr(1);
								var xiangxiurl="<?php echo $article->picture; ?>";
								var url=host+'/'+basehome+'/'+xiangxiurl;
								window._bd_share_config = {
									"common": {
										"bdSnsKey": {},
										"bdText": "<?=$article->author ?>的分享",
										"bdMini": "2",
										"bdMiniList": false,
										"bdPic": url,
										"bdStyle": "1",
										"bdSize": "24"
									},
									"share": {}
								};
								with(document)
								0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
							</script>
						</div>
						<hr />
						<div class="a-up">
							<p>上一篇：
							<?php if(isset($prev_articles)){
								if($prev_articles){
									foreach ($prev_articles as $prev_article) {
							?>
							<a title='<?=$prev_article['title'] ?>' href="<?=Url::toRoute(['index/article/index','uid'=>$uid,'article_id'=>$prev_article['id']]) ?>"><?=$prev_article['title'] ?></a>
							<?php }}else {?>
									<a title='没有了'>&nbsp;没有了</a>
							<?php 		
								}
								} ?>
							</p>
						</div>
						<div class="a-down">
							<p>下一篇：
								<?php if(isset($next_articles)){
								if($next_articles){
									foreach ($next_articles as $next_article) {
							?>
							<a title='<?=$next_article['title'] ?>' href="<?=Url::toRoute(['index/article/index','uid'=>$uid,'article_id'=>$next_article['id']]) ?>"><?=$next_article['title'] ?></a>
							<?php }}else {?>
									<a title='没有了'>&nbsp;没有了</a>
							<?php 		
								}
								} ?>
							</p>
							</p>
						</div>

						<hr>
						<br>
						<?php if(isset($first_comments)){
							if($first_comments){
								$i=1;
								foreach ($first_comments as $first_comment) {
						?>


						<div class="clearfix articlebox">
									<div class="liuyan_a">
									<span style="margin-left: 80%;color: #EF9595">
											<big>
											<?php 
												if(isset($_GET['page'])){
													echo ($_GET['page']-1)*10+$i;
												}else{
													echo $i;
											} ?>
											楼</big>
											</span>
									</div>
									<div class="said_img">

									<input type="hidden" id="second_author_uid<?=$i?>" value="<?=$first_comment->comment_uid ?>">
									<input type="hidden" id="article_comment_first_id<?=$i ?>" value="<?=$first_comment->id ?>">
									<input type="hidden" id="second_author<?=$i ?>" value="<?=$first_comment->comment_author ?>">
									<a href="<?=Url::toRoute(['index/index/index','uid'=>$first_comment->comment_uid]) ?>" title="<?=$first_comment->comment_author ?>" target="_blank">
										<img src="<?=$first_comment->comment_picture ?>" class="radius-circle" width="60px" height="60px" />
									</a>
										<div class="liuyan_t">
									<a href="<?=Url::toRoute(['index/index/index','uid'=>$first_comment->comment_uid]) ?>" title="<?=$first_comment->comment_author ?>" target="_blank">
											<span class="icon-user"></span>&nbsp;&nbsp;
											<?=$first_comment->comment_author ?>
											&nbsp;&nbsp;</span>
									</a>
											<span class="icon-paper-plane"></span>&nbsp;<?php echo \Yii::$app->formatter->asDate($first_comment->comment_time,'php:Y-m-d H:i:s'); ?>&nbsp;&nbsp;</span>
											<span class="tag bg-dot"><?=$first_comment->comment_from ?></span>&nbsp;&nbsp;<span class="icon-map-marker"></span>&nbsp;<?=$first_comment->comment_location ?>
											
										</div>
										<div class="liuyan_c">
											<?=$first_comment->comment_content ?>
										</div>
										<div style="text-align: right">
										<?php 
												if($session_uid){
													//如果session存在
												if($praises1){
													//用户点赞信息存在
													//status判断是否在一级评论中找到该用户的点赞，找到设为1，默认未找到为0
													$status=0;
												foreach ($praises1 as $praise1) {
													if($praise1->article_comment_first_id==$first_comment->id){
														$status=1;
														if($praise1->is_good==1&&$praise1->is_bad==0){
															//已点赞，未鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
															<span class="icon-thumbs-up" id="icon-thumbs-o-up<?=$i ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
															<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>"></span>
															(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
														</a>
										<?php					
														}else if($praise1->is_good==0&&$praise1->is_bad==0){
															//未点赞，未鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
															<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
															<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>"></span>
															(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
														</a>
										<?php
														}else if($praise1->is_good==0&&$praise1->is_bad==1){
															//未点赞，已鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
															<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
															<span class="icon-thumbs-down" id="icon-thumbs-o-down<?=$i ?>"></span>
															(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
														</a>
										<?php 
														}else{
															//已点赞，已鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
															<span class="icon-thumbs-up" id="icon-thumbs-o-up<?=$i ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
															<span class="icon-thumbs-down" id="icon-thumbs-o-down<?=$i ?>"></span>
															(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
														</a>
										<?php 
														}
													}
												}
												if($status==0){
										?>
													<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
														<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>"></span>
														(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
													</a>
													<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
														<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>"></span>
														(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
													</a>
										<?php 
												}
											}else{
										?>
										<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
											<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>"></span>
											(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
										</a>
										<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
											<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>"></span>
											(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
										</a>
										<?php 
											}
											}else{
												//session不存在
										?>
										<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>">
											<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>"></span>
											(<span id="dianzanrenshu<?=$i ?>"><?=$first_comment->good ?></span>)
										</a>
										<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>">
											<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>"></span>
											(<span id="bishirenshu<?=$i ?>"><?=$first_comment->bad ?></span>)
										</a>
										<?php
												} ?>

										<a href="javascript:void(0)" style="margin: 3%" id="comment_reply<?=$i ?>"><span class="icon-reply">回复</a>
							
										</div>
										<br> 
											<div style="text-align: right;">
												<a id="error_good<?=$i ?>" style="margin-right: 15%;color: #F20620;display: none"></a>
											</div>
										<br>
									</div>

									<!--回复-->
									<?php if(isset($second_comments)){
										if($second_comments){
											$j=1;
											foreach ($second_comments[$i] as $second_comment) {
											?>

									<div class="f_liuyan" style="display: <?php if($j>3){echo "none"; }else{echo "block"; } ?>" id="second-comment-list<?=$i?>_<?=$j ?>">
										<hr />
										<div class="liuyan_a">

										</div>
										<div class="said_img">
										<!--回复其他人的二级评论  -->
											<input type="hidden" id="other_second_author_uid<?=$i ?>_<?=$j ?>" value="<?=$second_comment->comment_uid ?>">
											<input type="hidden" id="other_second_author<?=$i ?>_<?=$j ?>" value="<?=$second_comment->comment_author ?>">
											<input type="hidden" id="article_comment_second_id<?=$i ?>_<?=$j ?>" value="<?=$second_comment->id ?>">
                                        <!--点击回复时判断显示哪一个输入框，显示该二级评论的一级评论的输入框 -->
                                        	<input type="hidden" id="second_shurukuang<?=$i ?>_<?=$j ?>" value="<?=$i ?>">
											<a href="<?=Url::toRoute(['index/index/index','uid'=>$second_comment->comment_uid]) ?>" title="<?=$second_comment->comment_author ?>" target="_blank">
											<img src="<?=$second_comment->comment_picture ?>" class="radius-circle" width="60px" height="60px" />
											</a>
											<div class="liuyan_t">
												<a href="<?=Url::toRoute(['index/index/index','uid'=>$second_comment->comment_uid]) ?>" title="<?=$second_comment->comment_author ?>" target="_blank">
												<span class="icon-user"></span>&nbsp;&nbsp;<?=$second_comment->comment_author ?>&nbsp;&nbsp;</span>
												</a>
												<span class="icon-paper-plane"></span>&nbsp;&nbsp;<?php echo \Yii::$app->formatter->asDate($second_comment->comment_time,'php:Y-m-d H:i:s'); ?>&nbsp;&nbsp;
												<span>回复 @
											
												<a href="<?=Url::toRoute(['index/index/index','uid'=>$second_comment->second_author_uid]) ?>" title="<?=$second_comment->second_author ?>" target="_blank">
												<!--判断是回复谁 -->
												<?=$second_comment->second_author ?>
												</a>
												 中说到：</span>
											</div>
											<div class="liuyan_c">
												<?=$second_comment->comment_content ?>
											</div>
											<div style="text-align: right">

											<?php 
												if($session_uid){
													//如果session存在
												if($praises2){
													//用户点赞信息存在
													//status判断是否在二级评论中找到该用户的点赞，找到设为1，默认未找到为0
													$status=0;
												foreach ($praises2 as $praise2) {
													if($praise2->article_comment_second_id==$second_comment->id){
														$status=1;
														if($praise2->is_good==1&&$praise2->is_bad==0){
															//已点赞，未鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
															(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
														</a>
										<?php					
														}else if($praise2->is_good==0&&$praise2->is_bad==0){
															//未点赞，未鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
															(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
														</a>
										<?php
														}else if($praise2->is_good==0&&$praise2->is_bad==1){
															//未点赞，已鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
															(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
														</a>
										<?php 
														}else{
															//已点赞，已鄙视
										?>
														<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
															(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
														</a>
														<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
															<span class="icon-thumbs-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
															(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
														</a>
										<?php 
														}
													}
												}
												if($status==0){
										?>
													<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
														<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
														(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
													</a>
													<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
														<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
														(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
													</a>
										<?php 
												}
											}else{
										?>
										<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
											<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
											(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
										</a>
										<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
											<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
											(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
										</a>
										<?php 
											}
											}else{
												//session不存在
										?>
										<a href="javascript:void(0)" style="margin: 3%" id="good<?=$i ?>_<?=$j ?>">
											<span class="icon-thumbs-o-up" id="icon-thumbs-o-up<?=$i ?>_<?=$j ?>"></span>
											(<span id="dianzanrenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->good ?></span>)
										</a>
										<a href="javascript:void(0)" style="margin: 3%" id="bad<?=$i ?>_<?=$j ?>">
											<span class="icon-thumbs-o-down" id="icon-thumbs-o-down<?=$i ?>_<?=$j ?>"></span>
											(<span id="bishirenshu<?=$i ?>_<?=$j ?>"><?=$second_comment->bad ?></span>)
										</a>
										<?php
												} ?>




												<a href="javascript:void(0)" style="margin: 3%" id="second_comment_reply<?=$i ?>_<?=$j ?>"><span class="icon-reply">回复</a>
											</div>
											<br> 
											<div style="text-align: right;">
												<a id="error_good<?=$i ?>_<?=$j ?>" style="margin-right: 15%;color: #F20620;display: none"></a>
											</div>	
											<br>
											<?php if(isset($second_comments_count[$i])){
											if($j==3&&$second_comments_count[$i]>3) {?>
											<a style="cursor: pointer" id="more-reply<?=$i ?>">
												<span style="margin-left: 40%">展开更多回复<span class="icon-arrow-down"></span></span>
											</a>
											<?php }} ?>
										</div>

									</div>
									<?php		
										$j++;  }
										}} ?>
									<?php if(isset($second_comments_count[$i])){
										if($second_comments_count[$i]>10){
									?>
									<br>

									<div style="text-align: right;margin-right: 5%" id="more-reply-all<?=$i ?>" style="display: none">
										<?php echo LinkPager::widget(['pagination'=>$second_comments_pages[$i]]); ?>
										<!-- <a href="" style="display: none;" id="more-reply-all<?=$i ?>">更多回复（共<?=$second_comments_count[$i] ?>条）</a> -->
									</div>
									<?php
										}
										} ?>

						

							<div class="panel border-sub" style="display: none" id="comment<?=$i ?>">
								<div class="panel-head border-sub bg-sub">
									<h3>评  论</h3>
								</div>
								<div class="panel-body">
									<div class="panel-body btn-box">
											<div class="form-group">
												<div class="field">
													<textarea class="input" id="input<?=$i ?>" rows="5" name="content" cols="50"  placeholder="请输入留言内容"></textarea>
													<span id="error<?=$i ?>"></span>
												</div>
											</div>
											<div class="form-button">
												<button class="button bg-blue button-big button-block first_comment<?=$i ?>" type="submit" id="first_comment<?=$i?>">
													提 交</button>
											</div>
									</div>
								</div>
							</div>
							<br />

								</div>
							
							<br />

						<?php
							$i++;	}
							}
							} ?>

						<?php echo LinkPager::widget(['pagination'=>$first_comments_pages]); ?>
						

							
							
							
							
							<br />
							
							<br />
							<hr />

							<!-- <div class="panel border-sub" style="border-color: #08BC4F"> -->
							<div class="panel border-sub">
								<div class="panel-head border-sub bg-sub">
									<h3 style="cursor:pointer"  id="comment">评  论</h3>
								</div>
								<div class="panel-body" style="display: none" id="panel-body2">
									<div class="panel-body ">
											<div class="form-group">
												<div class="field">
													<textarea class="input" id="input" rows="5" name="content" cols="50" placeholder="请输入留言内容"></textarea>
													<span id="error"></span>
												</div>
											</div>
											<div class="form-button">
												<button class="button bg-blue button-big button-block" type="submit" id="first_comment_one">
													提 交</button>
											</div>

									</div>
								</div>
							</div>
							


							<br />

                        

						<div class="pages" style=" text-align: right;">
							
						</div>
					</div>
					<br />
					<br />
					<br />
				</div>
				<script type="text/javascript">
				$(document).ready(function(){  //页面刷新一次，就要执行一次
					//使用jQuery事件
					//回复评论点击事件
					for(var i=1;i<=10;i++){
						$("#comment_reply"+i).bind("click",{index:i},clickHandler);
					}
					function clickHandler(event){
						var i=event.data.index;
						var second_author=$("#second_author"+i).val();

						//获取提交按钮的name属性值和id属性值
						var name=$(".first_comment"+i).attr('name');
						var id=$(".first_comment"+i).attr('id');
						if((name!="")&&(id!=('second_comment'+i+'_'+j))){
							//name属性为空，并且id的值不等于现在点击的框的提交按钮的id值，
							//说明是其他二级回复的输入框，移除此输入框
							$("#comment"+i).css('display','none');
							$(".first_comment"+i).attr('name','');
							//解绑事件
							$(".first_comment"+i).unbind("click");
						}

						var display=$("#comment"+i).css('display');
						if(display=="none"){
							$("#comment"+i).css('display','block');
							$(".first_comment"+i).attr('name','');
							$(".first_comment"+i).attr('id','first_comment'+i);
							$("#input"+i).focus();
							$("#input"+i).attr('placeholder','回复@'+second_author);
							//移除提示
							$("#input"+i).css('border-color','');
							$("#error"+i).css('color','');
							$("#error"+i).html('');

							//绑定事件
							$("#first_comment"+i).bind("click",{index:i},comment_tijiao);
						}else{
							$("#comment"+i).css('display','none');
							$(".first_comment"+i).attr('name','');
							$("#input"+i).css('border-color','');
							$("#error"+i).css('color','');
							$("#error"+i).html('');
						}
					}
					// 回复评论提交事件
					// for(var i=1;i<=10;i++){
					// 	$("#first_comment"+i).bind("click",{index:i},comment_tijiao);
						
					// }

					function comment_tijiao(event){
						var i=event.data.index;
						//回复提交路径是二级评论
						var url="<?=Url::toRoute('index/article/second-comment') ?>";
						var value=$("#input"+i).val();
						if(value==""){
							$("#input"+i).css('border-color','red');
							$("#error"+i).css('color','red');
							$("#error"+i).html('请输入留言内容');
						}else{
							//非空时异步提交
							var article_author="<?=$myinfo->username ?>";
							var article_author_uid="<?=$uid ?>";
							var article_id="<?=$article->id ?>";
							var comment_content=$("#input"+i).val();
							var second_author=$("#second_author"+i).val();
							var second_author_uid=$("#second_author_uid"+i).val();
							var article_comment_first_id=$("#article_comment_first_id"+i).val();
							$.post(
								url, 
								{
									article_author:article_author,
									article_author_uid:article_author_uid,
									article_id:article_id,
									comment_content:comment_content,
									second_author:second_author,
									second_author_uid:second_author_uid,
									article_comment_first_id:article_comment_first_id
								}, 
								function(data){
									if(data==0){
										$("#error"+i).css('color','red');
										$("#error"+i).html('请先登录再评论');
									}else if(data==1) {
										$("#error"+i).html('评论成功');
										window.location.reload();
									}else{
										$("#error"+i).html('评论失败');
									}
								});
						}
					}
					// //离开回复评论框事件
					// for(var i=1;i<=10;i++){
					// 	$("#input"+i).bind("blur",{index:i},left_comment);
					// }
					// function left_comment(event){
					// 	var i=event.data.index;
					// 	var value=$("#input"+i).val();
					// 	if(value==""){
					// 		$("#input"+i).css('border-color','red');
					// 		$("#error"+i).css('color','red');
					// 		$("#error"+i).html('请输入留言内容');
					// 	}else{
					// 		$("#input"+i).css('border-color','#35DB6F');
					// 		$("#error"+i).css('color','');
					// 		$("#error"+i).html('');
					// 	}
					// }


					//回复二级评论点击
					for(var i=1;i<=10;i++){
						for(var j=1;j<=10;j++){
						$("#second_comment_reply"+i+"_"+j).bind("click",{i:i,j:j},second_comment_click);
						}
					}
					function second_comment_click(event){

						// var i=$("#second_shurukuang").val();
						var i=event.data.i;
						var j=event.data.j;
						var second_author=$("#other_second_author"+i+"_"+j).val();
						
						//获取提交按钮的name属性值和id属性值
						var name=$(".first_comment"+i).attr('name');
						var id=$(".first_comment"+i).attr('id');
						if((name!="")&&(id!=('second_comment'+i+'_'+j))){
							//name属性为空，并且id的值不等于现在点击的框的提交按钮的id值，
							//说明是其他二级回复的输入框，移除此输入框
							$("#comment"+i).css('display','none');
							$(".first_comment"+i).attr('name','');
							//解绑事件
							$("#"+id).unbind("click");
						}
						if((name=="")&&(id==('first_comment'+i))){
							//name属性为空，并且id值等于一级评论的输入框中的提交按钮的id值
							//说明是一级回复的输入框，移除此输入框
							$("#comment"+i).css('display','none');
						}
						var display=$("#comment"+i).css('display');
						if(display=="none"){
							$("#comment"+i).css('display','block');
							$(".first_comment"+i).attr('name','second_comment'+i+"_"+j);
							$(".first_comment"+i).attr('id','second_comment'+i+"_"+j);
							$("#input"+i).focus();
							$("#input"+i).attr('placeholder','回复@'+second_author);
							
							//移除提示信息
							$("#input"+i).css('border-color','');
							$("#error"+i).css('color','');
							$("#error"+i).html('');

							//绑定事件
							$("#second_comment"+i+"_"+j).bind("click",{i:i,j:j},second_comment_tijiao);
								


						}else{
							$("#comment"+i).css('display','none');
							$(".first_comment"+i).attr('name','');
							$("#input"+i).css('border-color','');
							$("#error"+i).css('color','');
							$("#error"+i).html('');

						}
					}

					
					//回复二级评论提交事件
					// for(var i=1;i<=10;i++){
					// 	for(var j=1;j<=10;j++){

					// 	$("#second_comment"+i+"_"+j).bind("click",{i:i,j:j},second_comment_tijiao);
					// 	}
					// }
					
					
					function second_comment_tijiao(event){
						var i=event.data.i;
						var j=event.data.j;
						//回复提交路径是二级评论
						var url="<?=Url::toRoute('index/article/second-comment') ?>";
						var value=$("#input"+i).val();
						if(value==""){
							$("#input"+i).css('border-color','red');
							$("#error"+i).css('color','red');
							$("#error"+i).html('请输入留言内容');
						}
						else{
							// 非空时异步提交
							var article_author="<?=$myinfo->username ?>";
							var article_author_uid="<?=$uid ?>";
							var article_id="<?=$article->id ?>";
							var comment_content=$("#input"+i).val();
							var second_author=$("#other_second_author"+i+"_"+j).val();
							var second_author_uid=$("#other_second_author_uid"+i+"_"+j).val();
							var article_comment_first_id=$("#article_comment_first_id"+i).val();
							$.post(
								url, 
								{
									article_author:article_author,
									article_author_uid:article_author_uid,
									article_id:article_id,
									comment_content:comment_content,
									second_author:second_author,
									second_author_uid:second_author_uid,
									article_comment_first_id:article_comment_first_id
								}, 
								function(data){
									if(data==0){
										$("#error"+i).css('color','red');
										$("#error"+i).html('请先登录再评论');
									}else if(data==1) {
										$("#error"+i).html('评论成功');
										window.location.reload();
										
									}else{
										$("#error"+i).html('评论失败');
									}
								});
						}
					}
					

					$("#comment").click(function(){
							var display=$("#panel-body2").css('display');
							if(display=="none"){
								$("#panel-body2").css('display','block');
								$("#input").focus();
							}else{
								$("#panel-body2").css('display','none');
								$("#input").css('border-color','');
								$("#error").css('color','');
								$("#error").html('');
							}
							
					});
					//点击提交按钮
					$("#first_comment_one").click(function(){
						var url="<?=Url::toRoute('index/article/first-comment') ?>";
						var value=$("#input").val();
						if(value==""){
							$("#input").css('border-color','red');
							$("#error").css('color','red');
							$("#error").html('请输入留言内容');
						}else{
							//非空时就异步提交数据
							var article_author="<?=$myinfo->username ?>";
							var article_author_uid="<?=$uid ?>";
							var article_id="<?=$article->id ?>";
							var comment_content=$("#input").val();
							$.post(
								url, 
								{
									article_author:article_author,
									article_author_uid:article_author_uid,
									article_id:article_id,
									comment_content:comment_content
								},
								function(data){
									if(data==0){
										$("#error").css('color','red');
										$("#error").html('请先登录再评论');
									}else if(data==1) {
										$("#error").html('评论成功');
										window.location.reload();
									}else{
										$("#error").html('评论失败');
									}
								}
								);
						}
					});
					//点击展开更多回复
					for(var i=1;i<=10;i++){
						$("#more-reply"+i).bind("click",{i:i},zhankaihuifu);
					}
					function zhankaihuifu(event){
						var i=event.data.i;
						for(var j=1;j<=10;j++){
							$("#second-comment-list"+i+"_"+j).css('display','block');
							$("#more-reply"+i).css('display','none');
							$("#more-reply-all"+i).css('display','block');
						}
					}

					//一级评论点赞事件
					for(var i=1;i<=10;i++){
						$("#good"+i).bind("click",{i:i},good_level_one);
					}
					function good_level_one(event){
						var i=event.data.i;
						//判断是点赞还是取消点赞
						var class_value=$("#icon-thumbs-o-up"+i).attr('class');
						if(class_value=="icon-thumbs-o-up"){
							//点赞
							var action="add";
						}else{
							//取消点赞
							var action="del";
						}
						var article_id="<?=$article->id ?>";
						var article_comment_first_id=$("#article_comment_first_id"+i).val();
						var url="<?=Url::toRoute('index/article/good-level-one') ?>";
						$.post(
							url, 
							{
								article_id:article_id,
								article_comment_first_id:article_comment_first_id,
								type:"good",
								action:action
							}, 
							function(data){
								if(data==0){
									$("#error_good"+i).css('display','block').html('请先登录').fadeOut(3000);
								}else if(data==1){
									// $("#error_good"+i).css('display','block').html('点赞成功').fadeOut(3000);
									$("#icon-thumbs-o-up"+i).attr('class','icon-thumbs-up');
									//点赞人数加1
									var dianzanrenshu=$("#dianzanrenshu"+i).html();
									dianzanrenshu++;
									$("#dianzanrenshu"+i).html(dianzanrenshu);
								}else if(data==2){
									$("#error_good"+i).css('display','block').html('点赞失败').fadeOut(3000);
								}else if(data==3){
									// $("#error_good"+i).css('display','block').html('取消点赞成功').fadeOut(3000);
									$("#icon-thumbs-o-up"+i).attr('class','icon-thumbs-o-up');
									//点赞人数减1
									var dianzanrenshu=$("#dianzanrenshu"+i).html();
									dianzanrenshu--;
									$("#dianzanrenshu"+i).html(dianzanrenshu);
								}else if(data==4){
									$("#error_good"+i).css('display','block').html('取消点赞失败').fadeOut(3000);
								}
							});
					}

					//一级评论鄙视事件
					for(var i=1;i<=10;i++){
						$("#bad"+i).bind("click",{i:i},bad_level_one);
					}
					function bad_level_one(event){
						var i=event.data.i;
						//判断是鄙视还是取消鄙视
						var class_value=$("#icon-thumbs-o-down"+i).attr('class');
						if(class_value=="icon-thumbs-o-down"){
							//鄙视
							var action="add";
						}else{
							//取消鄙视
							var action="del";
						}
						var article_id="<?=$article->id ?>";
						var article_comment_first_id=$("#article_comment_first_id"+i).val();
						var url="<?=Url::toRoute('index/article/good-level-one') ?>";
						$.post(
							url, 
							{
								article_id:article_id,
								article_comment_first_id:article_comment_first_id,
								type:"bad",
								action:action
							}, 
							function(data){
								if(data==0){
									$("#error_good"+i).css('display','block').html('请先登录').fadeOut(3000);
								}else if(data==5){
									// $("#error_good"+i).css('display','block').html('鄙视成功').fadeOut(3000);
									$("#icon-thumbs-o-down"+i).attr('class','icon-thumbs-down');
									//鄙视人数加1
									var bishirenshu=$("#bishirenshu"+i).html();
									bishirenshu++;
									$("#bishirenshu"+i).html(bishirenshu);
								}else if(data==6){
									$("#error_good"+i).css('display','block').html('鄙视失败').fadeOut(3000);
								}else if(data==7){
									// $("#error_good"+i).css('display','block').html('取消鄙视成功').fadeOut(3000);
									$("#icon-thumbs-o-down"+i).attr('class','icon-thumbs-o-down');
									//鄙视人数减1
									var bishirenshu=$("#bishirenshu"+i).html();
									bishirenshu--;
									$("#bishirenshu"+i).html(bishirenshu);
								}else if(data==8){
									$("#error_good"+i).css('display','block').html('取消鄙视失败').fadeOut(3000);
								}
							})
					}

					//二级评论点赞事件
					for(var i=1;i<=10;i++){
						for(var j=1;j<=10;j++){
							$("#good"+i+"_"+j).bind("click",{i:i,j:j},good_level_two);
						}
					}

					function good_level_two(event){
						var i=event.data.i;
						var j=event.data.j;
						//判断是点赞还是取消点赞
						var class_value=$("#icon-thumbs-o-up"+i+"_"+j).attr('class');
						if(class_value=="icon-thumbs-o-up"){
							//点赞
							var action="add";
						}else{
							//取消点赞
							var action="del";
						}
						var article_id="<?=$article->id ?>";
						var article_comment_second_id=$("#article_comment_second_id"+i+"_"+j).val();
						var url="<?=Url::toRoute('index/article/good-level-two') ?>";
						$.post(
							url, 
							{
								article_id:article_id,
								article_comment_second_id:article_comment_second_id,
								type:"good",
								action:action
							}, 
							function(data){
								if(data==0){
									$("#error_good"+i+"_"+j).css('display','block').html('请先登录').fadeOut(3000);
								}else if(data==1){
									// $("#error_good"+i+"_"+j).css('display','block').html('点赞成功').fadeOut(3000);
									$("#icon-thumbs-o-up"+i+"_"+j).attr('class','icon-thumbs-up');
									//点赞人数加1
									var dianzanrenshu=$("#dianzanrenshu"+i+"_"+j).html();
									dianzanrenshu++;
									$("#dianzanrenshu"+i+"_"+j).html(dianzanrenshu);
								}else if(data==2){
									$("#error_good"+i+"_"+j).css('display','block').html('点赞失败').fadeOut(3000);
								}else if(data==3){
									// $("#error_good"+i+"_"+j).css('display','block').html('取消点赞成功').fadeOut(3000);
									$("#icon-thumbs-o-up"+i+"_"+j).attr('class','icon-thumbs-o-up');
									//点赞人数减1
									var dianzanrenshu=$("#dianzanrenshu"+i+"_"+j).html();
									dianzanrenshu--;
									$("#dianzanrenshu"+i+"_"+j).html(dianzanrenshu);
								}else if(data==4){
									$("#error_good"+i+"_"+j).css('display','block').html('取消点赞失败').fadeOut(3000);
								}
							});
					}


					//二级评论鄙视事件
					for(var i=1;i<=10;i++){
						for(var j=1;j<=10;j++){
							$("#bad"+i+"_"+j).bind("click",{i:i,j:j},bad_level_two);
						}
					}

					function bad_level_two(event){
						var i=event.data.i;
						var j=event.data.j;
						//判断是点赞还是取消点赞
						var class_value=$("#icon-thumbs-o-down"+i+"_"+j).attr('class');
						if(class_value=="icon-thumbs-o-down"){
							//鄙视
							var action="add";
						}else{
							//取消鄙视
							var action="del";
						}
						var article_id="<?=$article->id ?>";
						var article_comment_second_id=$("#article_comment_second_id"+i+"_"+j).val();
						var url="<?=Url::toRoute('index/article/good-level-two') ?>";
						$.post(
							url, 
							{
								article_id:article_id,
								article_comment_second_id:article_comment_second_id,
								type:"bad",
								action:action
							}, 
							function(data){
								if(data==0){
									$("#error_good"+i+"_"+j).css('display','block').html('请先登录').fadeOut(3000);
								}else if(data==5){
									// $("#error_good"+i).css('display','block').html('鄙视成功').fadeOut(3000);
									$("#icon-thumbs-o-down"+i+"_"+j).attr('class','icon-thumbs-down');
									//鄙视人数加1
									var bishirenshu=$("#bishirenshu"+i+"_"+j).html();
									bishirenshu++;
									$("#bishirenshu"+i+"_"+j).html(bishirenshu);
								}else if(data==6){
									$("#error_good"+i+"_"+j).css('display','block').html('鄙视失败').fadeOut(3000);
								}else if(data==7){
									// $("#error_good"+i+"_"+j).css('display','block').html('取消鄙视成功').fadeOut(3000);
									$("#icon-thumbs-o-down"+i+"_"+j).attr('class','icon-thumbs-o-down');
									//鄙视人数减1
									var bishirenshu=$("#bishirenshu"+i+"_"+j).html();
									bishirenshu--;
									$("#bishirenshu"+i+"_"+j).html(bishirenshu);
								}else if(data==8){
									$("#error_good"+i+"_"+j).css('display','block').html('取消鄙视失败').fadeOut(3000);
								}
							});
					}

					
	
					//离开输入框时
					// $("#input").blur(function(){
					// 	var value=$("#input").val();
					// 	if(value==""){
					// 		$("#input").css('border-color','red');
					// 		$("#error").css('color','red');
					// 		$("#error").html('请输入留言内容');
					// 	}else{
					// 		$("#input").css('border-color','#35DB6F');
					// 		$("#error").css('color','');
					// 		$("#error").html('');
					// 	}
					// });
				});
				</script>