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
                    <li><a href="#">相册</a></li>
                    </h4>
                </ul>
            </div>
            <div class="line-big">
                <div class="xl12 xm8">
                    <div class="line-small">
                        <div class="xs12">
                            <h4>相册列表</h4>
                            <hr>


                            <div class="col-sm-12">
    <link href="h+/css/animate.min.css" rel="stylesheet">
                    <?php if(isset($albums)){
                        if($albums){
                            foreach ($albums as $album) {
                    ?>

                        
                        <div class="file-box" style="float: left;width: 260px">
                            <div class="file">
                                <a href="<?=Url::toRoute(['index/album/picture-list','album_id'=>$album->id,'uid'=>$uid]) ?>">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="<?=$album->name ?>" class="img-responsive" src="<?=$album->url ?>" title="<?=$album->name ?>"  style="width: 200px;"  >
                                    </div>
                                    <div class="file-name">
                                        相册名称：<?=$album->name ?>
                                        <br/>
                                        <small>添加时间：<?php echo \Yii::$app->formatter->asDate($album->addtime,'php:Y-m-d') ?>
                                               &nbsp;浏览次数：<?=$album->hits ?>
                                        </small>
                                        <hr>
                                    </div>
                                </a>

                            </div>
                        </div>
                    <?php 
                            }
                        }else{
                            echo "暂无相册";
                        }
                        } ?>
                       
             
                    </div>
                    <hr>
                    <?php echo LinkPager::widget(['pagination'=>$pages]); ?>

    <script src="h+/js/jquery.min.js?v=2.1.4"></script>
    <script src="h+/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="h+/js/content.min.js?v=1.0.0"></script>
    <script>
        $(document).ready(function(){$(".file-box").each(function(){animationHover(this,"pulse")})});
    </script>
    




                        </div>                      
                        <hr />
                        <div class="pages" style=" text-align: right;">
                            
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                </div>              
        