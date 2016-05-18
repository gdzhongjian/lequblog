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
					<li><a href="#">最新文章</li></a>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
						<?php if(isset($articles)){
							if($articles){
							foreach ($articles as $article) {
						?>


							<div class="clearfix articlebox">
								<div class="detail_a">
								<?php if($article['original']==0) {?>
									<span class="tag bg-dot">原 创</span>&nbsp;&nbsp;
								<?php }else {?>
									<span class="tag bg-green">转 载</span>&nbsp;&nbsp;
								<?php } ?>
									<a href="<?=Url::toRoute(['index/article/index','uid'=>$uid,'article_id'=>$article->id]) ?>" style="font-size: 16px;"><?=$article['title'] ?></a>
									<?php if($article['istop']!=0) {?>
									<div class="a_tuijian">
										<img src="index/images/tuijian.gif" style="width:70px" />
									</div>
									<?php  }?>
								</div>
								<div class="article">
									<a href="<?=Url::toRoute(['index/article/index','uid'=>$uid,'article_id'=>$article->id]) ?>">
										<img src="<?=$article['picture'] ?>" class="img" title="<?=$article['title'] ?>" width="250px" height="200px" />
									</a>
									<div class="remark">
										<?=$article['remark'] ?>
									</div>
								</div>
								<div class="write">
									<span class="icon-paper-plane"></span>&nbsp;
									<?php echo \Yii::$app->formatter->asDate($article['post_time'],'php:Y-m-d H:i:s'); ?>
									&nbsp;&nbsp;作者：<?=$article['author'] ?>&nbsp;&nbsp;分类：[&nbsp;
									<?php foreach ($categories as $category) {
										if($category['id']==$article['tag_id']){
											echo $category['name'];
										}
									} ?>
									&nbsp;]<span class="hidden-xs">&nbsp;&nbsp;点击：[&nbsp;<?=$article['hits'] ?>&nbsp;]</span>
								</div>
								<div class="look-all">
									<a href="<?=Url::toRoute(['index/article/index','uid'=>$uid,'article_id'=>$article->id]) ?>" class="button border-blue" role="button">查看全部</a>
								</div>
							</div>
							<br />
							<br />

						<?php
							}}else{echo "暂无文章";}
							} ?>

						</div>
						<hr />

						<?php echo LinkPager::widget([
							'pagination'=>$pages,
						]); ?>
					</div>
					<br />
					<br />
					<br />
				</div>
