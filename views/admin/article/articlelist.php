<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\i18n\Formatter;
$this->params['user_headimage']=$user_headimage;

 ?>
 <?php $this->params['username']=$username; ?>
        <!--sidebar left end-->
        <!--main content start-->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="breadcrumb">
                            <li><a href="">主面板</a>
                            </li>
                            <li><a href="">内容管理</a></li>
                            <li class="active">文章列表</li>
                        </ul>
                    </div>
                    <div class="col-md-2" align="right">
                        <a href="<?=Url::toRoute('admin/article/add-article') ?>">
                            <button class="btn btn-primary btn-trans"><i class="fa fa-archive"></i>&nbsp发布新文章</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">文章详情</h3>
                                <div class="actions pull-right">
                                    <span class="badge badge-danager animated bounceIn">已有<?=$pagescount->totalCount ?>篇文章</span>    
                                </div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="tab-wrapper tab-primary">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#home1" data-toggle="tab">全部</a>
                                        </li>
                                        <?php if(isset($categories)){
                                                foreach ($categories as $category) {
                                        ?>
                                        <li><a href="#<?=$category['name'] ?>" data-toggle="tab"><?=$category['name'] ?></a>
                                        </li>
                                        <?php 
                                                }
                                        } ?>
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home1">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="30%">标题</th>
                                            <th style="text-align: center;" width="8%">关键字</th>
                                            <th style="text-align: center;" width="10%">发表时间</th>
                                            <th style="text-align: center;" width="5%">浏览量</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="articleList" id="vo">
                                        <?php if(isset($summodels)){
                                                foreach ($summodels as $article) {
                                        ?>


    

                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <span class="badge badge-primary animated bounceIn">
                                                        <?=$article['id'] ?>
                                                    </span>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['title'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['keyword'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php echo \Yii::$app->formatter->asDate($article['post_time'],'php:Y-m-d H:i:s'); ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['hits'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <a href="<?=Url::toRoute(['admin/article/edit-article','article_id'=>$article['id']]) ?>">
                                                        <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil"></i> 编辑
                                                        </button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/article/delete-article','article_id'=>$article['id']]) ?>">
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php 
                                                }
                                            } ?>
                                        </volist>
                                    </tbody>

                                </table>
                                <div class="pages">
                                    <?php echo LinkPager::widget([
                                    'pagination'=>$pagescount,
                                    ]); ?>
                                </div>


                                </div>

                                <?php if(isset($categories)){
                                        foreach ($categories as $category) {
                                        $tag_name=$category['name'];
                                ?>

                                <div class="tab-pane" id="<?=$category['name'] ?>">
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%">编号</th>
                                            <th style="text-align: center;" width="30%">标题</th>
                                            <th style="text-align: center;" width="8%">关键字</th>
                                            <th style="text-align: center;" width="10%">发表时间</th>
                                            <th style="text-align: center;" width="5%">浏览量</th>
                                            <th style="text-align: center;" width="20%">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <volist name="articleList" id="vo">

                                            
                                            <?php 
                                                if(isset($tagmodels)){
                                                    foreach ($tagmodels[$tag_name] as $article) {
                                            ?>


                                            <tr>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <span class="badge badge-primary animated bounceIn">
                                                        <?=$article['id'] ?>
                                                    </span>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['title'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['keyword'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?php echo \Yii::$app->formatter->asDate($article['post_time'],'php:Y-m-d H:i:s'); ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <?=$article['hits'] ?>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">
                                                    <a href="<?=Url::toRoute(['admin/article/edit-article','article_id'=>$article['id']]) ?>">
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> 编辑</button>
                                                    </a>
                                                    <a onClick="return confirm('是否删除此条记录')" href="<?=Url::toRoute(['admin/article/delete-article','article_id'=>$article['id']]) ?>">
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除</button>
                                                    </a>
                                                    <a href="" target="_blank">
                                                        <button class="btn btn-info btn-sm"><i class="fa fa-search"></i> 查看</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php 
                                                    }
                                                }
                                             ?>



                                        </volist>
                                    </tbody>

                                </table>
                                <div class="pages">
                                    <?php echo LinkPager::widget([
                                        'pagination'=>$pages[$tag_name],
                                    ]); ?>
                                </div>


                                </div>

                                <?php 
                                        }
                                    } ?>


                                </div>
                                </div>


                            </div>
                        </div>
            </section>
        </section>
        <!--main content end-->
        <!--sidebar right start-->
        
        <!--sidebar right end-->
    </section>
    <!--Global JS-->
    <script src="admin/assets/js/jquery-1.10.2.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="admin/assets/js/application.js"></script>
    <!--Page Level JS-->
    <script src="admin/assets/plugins/countTo/jquery.countTo.js"></script>
    <script src="admin/assets/plugins/weather/js/skycons.js"></script>
    <!-- FlotCharts  -->
    <script src="admin/assets/plugins/flot/js/jquery.flot.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.resize.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.canvas.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.image.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.categories.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.crosshair.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.errorbars.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.fillbetween.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.navigate.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.pie.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.selection.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.stack.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.symbol.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.threshold.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.colorhelpers.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.time.min.js"></script>
    <script src="admin/assets/plugins/flot/js/jquery.flot.example.js"></script>
    <!-- Morris  -->
    <script src="admin/assets/plugins/morris/js/morris.min.js"></script>
    <script src="admin/assets/plugins/morris/js/raphael.2.1.0.min.js"></script>
    <!-- Vector Map  -->
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="admin/assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
    <!-- ToDo List  -->
    <script src="admin/assets/plugins/todo/js/todos.js"></script>
    <!--Load these page level functions-->
    <script>
    $(document).ready(function() {
        // var href=window.location.search;
        // val=href.substr(-5,5);
        // if(val=="val-1"){
        //     $(".nav-tabs li").eq(0).attr('class','active');
        // }else if(val=='val=2'){
        //     $(".nav-tabs li").eq(1).attr('class','active');
        // }else if(val=='val=3'){
        //     $(".nav-tabs li").eq(2).siblings().removeClass('active');
        //     $(".nav-tabs li").eq(2).attr('class','active');

        // }
        app.timer();
        app.map();
        app.weather();
        app.morrisPie();
    });
    </script> 
    <script type="text/javascript">
    // $(".pagination li a").click(function(){
    //    var href=$(this).attr('href');
    //    var val;
    //    var val1=$(".nav-tabs li").attr("class");
    //    var val2=$(".nav-tabs li").next().attr("class");
    //    var val3=$(".nav-tabs li").next().next().attr("class");
    //    if(val1=="active"){
    //         val=1;
    //    }if(val2=="active"){
    //         val=2;
    //    }if(val3=="active"){
    //         val=3;
    //    }
    //    href=href+'val='+val;
    //    $(this).attr('href',href);
    // });

    // $(document).ready(function(){
    //     var href=window.location.search;
    //     alert(href);
    // }); 
    </script>  

</body>

</html>
