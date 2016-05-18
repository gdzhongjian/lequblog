<?php 
use yii\helpers\Url;
use yii\i18n\Formatter;
 ?>
<!--logo start-->
            <div class="brand">
                <a href="<?=Url::toRoute('admin/index/index') ?>" class="logo">
                    <span>乐趣</span>博客</a>
            </div>
            <!--logo end-->
            <div class="toggle-navigation toggle-left">
                <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="收起列表">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="user-nav">
                <ul>
                    <li class="dropdown messages">
                        <?php if(isset($this->params['weidu_liuyan_count'])){
                            if($this->params['weidu_liuyan_count']>0){
                        ?>
                        <span class="badge badge-danager animated bounceIn" id="new-messages">

                        <?php echo $this->params['weidu_liuyan_count'];
                            }
                            } ?>
                        </span>
                        <button type="button" class="btn btn-default dropdown-toggle options" id="toggle-mail" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                        </button>
                        <ul class="dropdown-menu alert animated fadeInDown">
                            <li>
                                <h1>你有
                                <strong>
                                    <?php if(isset($this->params['weidu_liuyan_count'])){
                                        if($this->params['weidu_liuyan_count']>0){
                                            echo $this->params['weidu_liuyan_count'];
                                            }else{
                                                echo "0";
                                            }
                                    } ?>
                                </strong>
                                条新留言</h1>
                            </li>
                            <?php if(isset($this->params['weidu_liuyans'])){
                                foreach ($this->params['weidu_liuyans'] as $liuyan) {
                            ?>


                            <li>
                                <a href="<?=Url::toRoute(['admin/liuyan/liuyan-reply','liuyan_id'=>$liuyan->id,'weidu'=>1]) ?>">
                                    <div class="profile-photo">
                                        <img src="<?=$liuyan->guest_picture ?>" alt="" class="img-circle" width="50px" height="50px">
                                    </div>
                                    <div class="message-info">
                                        <span class="sender"><?=$liuyan->guest_author ?></span>
                                        <span class="time"><?php echo \Yii::$app->formatter->asDate($liuyan->guest_time,'php:Y-m-d H:i:s'); ?></span>
                                        <div class="message-content"><?=$liuyan->guest_content ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php 
                                }
                                } ?>
        
                            <li>
                                <?php if(isset($this->params['weidu_liuyan_count'])){
                                    if($this->params['weidu_liuyan_count']>0){
                                ?>
                                    <a href="<?=Url::toRoute(['admin/liuyan/liuyan-list','weidu'=>1]) ?>">查看所有留言 <i class="fa fa-angle-right"></i></a>
                                <?php
                                    }else{
                                ?>
                                    <a href="<?=Url::toRoute(['admin/liuyan/liuyan-list']) ?>">查看所有留言 <i class="fa fa-angle-right"></i></a>
                                <?php
                                    }
                                    } ?>
                            </li>
                        </ul>

                    </li>
                    <li class="profile-photo">
                    <?php if(isset($this->params['user_headimage'])){
                    ?>
                        <img src="<?=$this->params['user_headimage'] ?>" alt="" class="img-circle" width="50px" height="50px">
                    <?php 
                        } ?>
                    </li>
                    <li class="dropdown settings">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i>
                        欢迎【<?php if(isset($this->params['username']))  {echo $this->params['username'];}?>】 <i class="fa fa-angle-down"></i>
                    </a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li>
                                <a href="<?=Url::toRoute('admin/user/change-password') ?>"><i class="fa fa-user"></i> 修改密码</a>
                            </li>
                            <li>
                                <a href="<?=Url::toRoute('admin/user/edit-user') ?>"><i class="fa fa-calendar"></i> 修改资料</a>
                            </li>
                            <li>
                                <a href=""><i class="fa  fa-trash-o"></i> 清除缓存 </a>
                            </li>
                            <li>
                                <a href="<?=Url::toRoute('admin/index/exit') ?>"><i class="fa fa-power-off"></i> 退出系统</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="toggle-navigation toggle-right">
                           
                        </div>
                    </li>

                </ul>
            </div>