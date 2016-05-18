<?php 
use yii\helpers\Url;
use yii\i18n\Formatter;
use yii\widgets\LinkPager;
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
					<li><a href="#">访客</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							<h4>最近访客</h4>
							<span style="color:red">(已有<?=$pages->totalCount ?>人访问本博客)</span><hr>
				            <div class="friends">
				                <div class="QQfriends">			                    
			                        <volist name="QQ" id="v">
										<?php if(isset($fangkes)){
												foreach ($fangkes as $fangke) {
										?>

			                                <a style="cursor:pointer" href="<?php echo \Yii::$app->request->getHostInfo().Url::toRoute(['index/index/index','uid'=>$fangke->fangke_uid]); ?>"><img src="<?=$fangke->fangke_headimage ?>" title="<?=$fangke->fangke_username ?> 最近访问 <?php echo \Yii::$app->formatter->asDate($fangke->fangke_time,'php:Y-m-d H:i:s'); ?>" class="radius-circle" width="60px" height="60px"></a>				                           
			                        
										<?php 
												}
											} ?>
			                        </volist>				                    
				                </div>
				            </div>							
							<br />							
						</div>						
						<hr />
						<div class="pages" style=" text-align: right;">
							<?php echo LinkPager::widget([
								'pagination'=>$pages
							]); ?>
						</div>
					</div>
					<br />
					<br />
					<br />
				</div>				
		