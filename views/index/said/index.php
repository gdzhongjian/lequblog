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
 <link rel="stylesheet" href="admin/said/Ueditor/third-party/SyntaxHighlighter/shCore.min.css" ></script>

		<div class="container">
			<div class="">
				<ul class="bread">
					<h4>
					<li><a href="<?=Url::toRoute(['index/index/index','uid'=>$uid]) ?>" class="icon-home"> 首页</a> </li>					
					<li><a href="#">说说</a></li>
					</h4>
				</ul>
			</div>
			<div class="line-big">
				<div class="xl12 xm8">
					<div class="line-small">
						<div class="xs12">
							<?php if(isset($saids)){
								if($saids){
								foreach ($saids as $said) {
							?>

								<div class="clearfix articlebox">
									<div class="detail_a">
										<div class="said_time">
											<span class="icon-paper-plane"></span>&nbsp;<?php echo \Yii::$app->formatter->asDate($said->post_time,'php:Y-m-d H:i:s') ?>&nbsp;&nbsp;</span>
											<span class="tag bg-dot"><?=$said->from ?></span>&nbsp;&nbsp;<span class="icon-map-marker"></span>&nbsp;
											<?=$said->edit_location ?>
										</div>
									</div>
									<div class="said_img">
										<img src="<?=$user->headimage ?>" data-toggle="hover" data-place="right" title="作者：[ <?=$user->username ?> ],发表自[ <?=$said->edit_location ?> ]" class="radius-circle tips" width="60px" height="60px" />
										<div class="said_c">
											<?=$said->content ?>
										</div>
									</div>
								</div>
								<br />
								
							<?php 
								} }else{echo "暂无说说";}
								} ?>
							
							<br />
							<br />
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
				