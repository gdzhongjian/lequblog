<?php 
    use yii\helpers\Url;
 ?>
<div id="leftside-navigation" class="nano">
                <ul class="nano-content">
                    <li class="sub-menu active">
                        <a href="<?=Url::toRoute('admin/index/index') ?>"><i class="fa fa-dashboard"></i><span>主面板</span></a>
                    </li>
                    <li class="sub-menu">
                        <a  id="said" href="javascript:void(0);"><i class="fa fa-user"></i><span>说说管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li  class="active"><a href="<?=Url::toRoute('admin/said/add-said') ?>">发表说说</a></li>
                            <li  class=""><a href="<?=Url::toRoute('admin/said/said-list') ?>">说说列表</a></li>
                            <!-- <li  class=""><a href="">说说评论</a></li> -->
                        </ul>
                    </li>
                    <li class="sub-menu">
                    <a  id="article" href="javascript:void(0);"><i class="fa fa-table"></i><span>文章管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li class=""><a href="<?=Url::toRoute('admin/article/add-article') ?>">发表文章</a></li>
                        <li  class=""><a href="<?=Url::toRoute('admin/article/article-list') ?>">文章列表</a></li>
                        <!-- <li  class=""><a href="">文章评论</a></li> -->
                    </ul>
                    </li>

                  <!--   <li class="sub-menu">
                    <a id="user" href="javascript:void(0); "><i class="fa fa-users"></i><span>用户管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  class=""><a href="">新增用户</a></li>
                        <li  class=""><a href="">用户列表</a></li>
                    </ul>
                </li> -->
                <li class="sub-menu">
                    <a id="tag" href="javascript:void(0);"><i class="fa fa-list-ul"></i><span>栏目管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  class=""><a href="<?=Url::toRoute('admin/category/add-category') ?>">新增栏目</a></li>
                        <li  class=""><a href="<?=Url::toRoute('admin/category/category-list') ?>">栏目列表</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a  id="album" href="javascript:void(0);"><i class="fa fa-credit-card"></i><span>相册管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  class=""><a href="<?=Url::toRoute('admin/album/add-album') ?>">新增相册</a></li>
                        <li  class=""><a href="<?=Url::toRoute('admin/album/album-list') ?>">相册列表</a></li>
                        <!-- <li  class=""><a href="">相册评论</a></li> -->
                    </ul>
                </li>
                <li class="sub-menu">
                    <a  id="picture" href="javascript:void(0);"><i class="fa fa-picture-o"></i><span>图片管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  class=""><a href="<?=Url::toRoute('admin/picture/add-picture') ?>">新增图片</a></li>
                        <li  class=""><a href="<?=Url::toRoute('admin/picture/album-list') ?>">图片列表</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a   id="content" href="javascript:void(0);"><i class="fa fa-tasks"></i><span>留言管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>        
                        <li  class=""><a href="<?=Url::toRoute('admin/liuyan/liuyan-list') ?>">留言管理</a></li>
                        <li  class=""><a href="<?=Url::toRoute('admin/liuyan/liuyan-reply-list') ?>">回复管理</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a  id="link"  href="javascript:void(0);"><i class="fa fa-retweet"></i><span>友链管理</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  class=""><a href="<?=Url::toRoute('admin/link/link-list') ?>">友链申请</a></li>
                    </ul>
                </li>
                <!-- <li class="sub-menu">
                    <a   id="system" href="javascript:void(0);"><i class="fa fa-cogs"></i><span>系统设置</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul>
                        <li  ><a href="">基本设置</a></li>
                        <li  ><a href="">查看高级设置</a></li>
                        <li><a href="">版本设置</a></li>
                    </ul>
                </li> -->
                <li><a href="<?=Url::toRoute('admin/index/exit') ?>"><i class="fa fa-power-off"></i> <span>退出系统</span></a></li>        
                </ul>
            </div>
    <script src="admin/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="admin/assets/js/left.js"></script>
