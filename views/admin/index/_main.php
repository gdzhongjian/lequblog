<section id="main-content">
                <!--tiles start-->
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-red">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="1" data-speed="2500"></h1>
                                <p>相册总数</p>
                            </div>
                            <div class="icon"><i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-turquoise">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="1" data-speed="2500"></h1>
                                <p>文章总数</p>
                            </div>
                            <div class="icon"><i class="fa fa-comments"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-blue">
                            <div class="content">
                                <h1 class="text-left timer" data-from="0" data-to="1" data-speed="2500"></h1>
                                <p>说说总数</p>
                            </div>
                            <div class="icon"><i class="fa fa fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dashboard-tile detail tile-purple">
                            <div class="content">
                                <h1 class="text-left timer" data-to="1" data-speed="2500"></h1>
                                <p>留言总数</p>
                            </div>
                            <div class="icon"><i class="fa fa-bar-chart-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--tiles end-->
                <!--dashboard charts and map start-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">程序信息</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5>服务器环境：<a>&nbsp;&nbsp;<?php echo $_SERVER['SERVER_SOFTWARE'] ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PHP版本：<a>&nbsp;&nbsp;<?php echo PHP_VERSION ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>服务器IP：<a>&nbsp;&nbsp;<?php echo $_SERVER['SERVER_ADDR'] ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>数据库信息：<a>&nbsp;&nbsp;<?php echo mysql_get_client_info() ?></a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>程序官网：<a href="http://www.tianjianlong.com.cn" target="_blank">&nbsp;&nbsp;http://www.baidu.com</a></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>作者：<a>&nbsp;&nbsp;钟健</a></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">最新更新</h3>
                                <div class="actions pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                        <volist name="said" id="vo">
                                            <tr>
                                                <td>                                                    
                                                    <h5><a href=""></a></h5>
                                                    <span class="user-info"> 作者:   IP: </span>
                                                </td>
                                            </tr>
                                        </volist>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <!--ToDo end-->
            </section>