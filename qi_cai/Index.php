<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>网站后台</title>
    <!-- zui css -->
    <link rel="stylesheet" href="static/zui/dist/css/zui.css">
    <link rel="stylesheet" href="static/zui/dist/theme/blue.css">
    <!-- app css -->
    <link rel="stylesheet" href="static/zui/css/app.css">
    <!-- jquery js -->
    <script src="static/zui/dist/lib/jquery/jquery.js"></script>
    <!--[if lt IE 9]>
    <script src="static/zui/dist/lib/ieonly/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="static/zui/dist/lib/ieonly/respond.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="static/zui/dist/lib/ieonly/excanvas.js"></script>
    <![endif]-->
    <link href="static/zui/dist/lib/datagrid/zui.datagrid.min.css" rel="stylesheet">
    <script src="static/zui/dist/lib/datagrid/zui.datagrid.min.js"></script>
    <!--tabs引用-->
    <link href="static/zui/css/style.css" rel="stylesheet" />
    <link href="static/zui/css/tabstyle.css" rel="stylesheet" />
</head>
<style>
    .tabs-container .tab-pane{display: none;}
    .tabs-container .active{display: block;}
    .tab-pane{height:100%}
    ul li:hover{background:#03a2b6; }
</style>
<?php
if( !$_SESSION["userName"] || $_SESSION["userName"]=="" ){ //如果（没有session变量 或 session变量=空）
    echo "<script> alert('请先登录！'); window.location.href='login.php'; </script>"; //提示，并跳转到登录页
}
?>
<body>
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-fixed-top bg-primary">
            <div class="navbar-header">
                <a class="navbar-toggle" href="javascript:;" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon icon-th-large"></i></a>
                <a class="sidebar-toggle" href="javascript:;" data-toggle="push-menu"><i class="icon icon-bars"></i></a>
                <a class="navbar-brand" href="#">
                    <span class="logo">欢迎<?php echo $_SESSION["userName"] ?></span> <!-- session可以跨网页存取，login.php控制器那里存。这里取（显示）  -->
                    <span class="logo-mini"><?php echo $_SESSION["userName"] ?></span>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <!--        http://www.uimaker.com/uimakerhtml/uidesign/uibs/2020/1209/142867.html  从这里截了个长条图，当背景-->
                <div class="container-fluid" style="background-image: url('images/title_bg.JPG');">
                    <ul class="nav navbar-nav">
                        <li><a href="javascript:;" data-toggle="push-menu"><i class="icon icon-bars"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-brand" style="width:76%;text-align: center"><span style="font-family: 幼圆;font-weight: bold;font-size:28px">体育器材信息管理系统</span></ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>
                            <a href="javascript:;">
                                    <span>
                                        <i class="icon icon-bell-alt"></i>
                                        <span class="label label-danger label-pill up">5</span>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                    <span>
                                        <i class="icon icon-envelope-alt"></i>
                                        <span class="label label-success label-pill up">2</span>
                                    </span>
                            </a>
                        </li>-->
                        <li class="dropdown">
                            <a href="javascript:;" data-toggle="dropdown"><i class="icon icon-user"></i> <?php echo $_SESSION["userName"] ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:showMsg('提示','程序猿正在努力开发中......',2,'frown',3);;">个人信息</a></li>
                                <li class="divider"></li>
                                <li><a id="btn-logout" href="logout.php" >注销</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">主要菜单</li> <!-- https://www.openzui.com/#control/icon    这里有图标样式-->
                <?php
                include "inc/power.php";
                $menuModule=$quanXian->getMenuModule();
//                if(!$menuModule){  //什么模块规则都没读到
//                    echo "<script> alert('您没有任何模块权限，请联系管理员！'); window.location.href='login.html'; </script>";
//                    return;
//                }
                foreach ($menuModule as $key=>$item){ //根据读到的模块，动态生成主页菜单
                    ?>
                    <li class="treeview">
                        <a href="javascript:;">
                            <i class="<?php echo $item["iconClass"] ?>"></i>
                            <span>&nbsp;&nbsp;<?php echo $item["ruleName"] ?></span>
                            <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $item["menuLink"] ?>"><i class="<?php echo $item["iconClass"] ?>"></i> <?php echo $item["ruleName"] ?></a></li>
                        </ul>
                    </li>
                    <?php
                }   //下面注释的原先静态的菜单。
                ?>
                <!--                <li class="treeview active">-->
                <!--                    <a href="javascript:;">-->
                <!--                        <i class="icon icon-1x icon-cogs"></i>-->
                <!--                        <span>&nbsp;&nbsp;系统管理</span>-->
                <!--                        <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>-->
                <!--                    </a>-->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li><a href="_list.php"><i class="icon icon-newspaper-o"></i> 新闻列表</a></li>-->
                <!--                        <li><a href="classlist.php"><i class="icon icon-th-large"></i> 班级列表</a></li>-->
                <!--                        <li><a href="userList.php"><i class="icon icon-group"></i> 用户列表</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li class="treeview">-->
                <!--                    <a href="javascript:;">-->
                <!--                        <i class="icon icon-window"></i>-->
                <!--                        <span>&nbsp;&nbsp;内容管理</span>-->
                <!--                        <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>-->
                <!--                    </a>-->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li><a href="categoryList.php"><i class="icon icon-list-ol"></i> 类别列表</a></li>-->
                <!--                        <li><a href="newsList.php"><i class="icon icon-list-alt"></i> 新闻列表</a></li>-->
                <!--                        <li><a href="shopList.php"><i class="icon icon-shopping-cart"></i> 商品列表</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                                <li class="treeview">
                                    <a href="javascript:;">
                                        <i class="icon icon-flag"></i>
                                        <span>&nbsp;&nbsp;后台登录</span>
                                        <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="login.php" target="_top"><i class="icon icon-checked"></i> 登录</a></li>
                                        <li><a href="reg.php" target="_blank"><i class="icon icon-signin"></i> 注册</a></li>
                                        <li><a href="upResourceList.php" target="_blank"><i class="icon icon-signin"></i>上传文件</a></li>
                                    </ul>
                <!--                </li>-->
                <!--                <li class="treeview">-->
                <!--                    <a href="javascript:;">-->
                <!--                        <i class="icon icon-smile"></i>-->
                <!--                        <span>&nbsp;&nbsp;用户管理</span>-->
                <!--                        <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>-->
                <!--                    </a>-->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li><a href="{:url('userlist/index')}"><i class="icon icon-qq"></i>用户列表</a></li>-->
                <!--                        <li><a href="{:url('authmanage/admin_list')}"><i class="icon icon-group"></i>用户及所属组列表</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li class="treeview">-->
                <!--                    <a href="javascript:;">-->
                <!--                        <i class="icon icon-cubes"></i>-->
                <!--                        <span>&nbsp;&nbsp;权限管理</span>-->
                <!--                        <span class="pull-right-container"><i class="icon icon-angle-left"></i></span>-->
                <!--                    </a>-->
                <!--                    <ul class="treeview-menu">-->
                <!--                        <li><a href="{:url('authmanage/group_list')}"><i class="icon icon-spinner-snake"></i>组权限列表</a></li>-->
                <!--                        <li><a href="{:url('authmanage/auth_rule')}"><i class="icon icon-spinner-indicator"></i>模块及路径列表</a></li>-->
                <!--                        <li><a href="{:url('authmanage/admin_list')}"><i class="icon icon-check-board"></i>用户及所属组列表</a></li>-->
                <!--                        <li><a href="{:url('authmanage/group_user')}"><i class="icon icon-resize"></i>组成员管理</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <!--<div class="tabs" id="tabsExample"></div>-->
        <div class="wapper">
            <!--菜单HTML Start-->
            <div id="page-tab">
                <button class="tab-btn" id="page-prev"></button>
                <nav id="page-tab-content">
                    <div id="menu-list"></div>
                </nav>
                <button class="tab-btn" id="page-next"></button>
                <div id="page-operation">
                    <div id="menu-all">
                        <ul id="menu-all-ul"></ul>
                    </div>
                </div>
            </div>
            <!--菜单HTML End-->
            <!--iframe Start (根据页面顶部占用高度，自行调整高度数值)-->
            <div id="page-content" style=""></div>
            <!--iframe End-->
        </div>
    </div>
</div>


<!-- zui js -->
<script src="static/zui/dist/js/zui.js"></script>
<script src="static/zui/dist/lib/tabs/zui.tabs.min.js"></script>
<!-- app js -->
<script src="static/zui/js/app.js"></script>
<script src="static/zui/js/tab.js"></script>
<script src="static/zui/js/common.js"></script>
<script>
    //初始化a标签链接到tab
    $(".treeview-menu a").tab({
        defaultTab:"桌面",
        defaultUrl:"userlist.php"
    });
    $("#page-content").height($("body").height()-80);

    $('#btn-logout').on('click',function () {
        $.ajax({
            type: "POST",
            url: "loginSave.php?action=logout",
            // dataType: "json", //用这句，下面JSON解析有问题
            success: function(res){
                res=JSON.parse(res);
                if (res.code !== 1) {
                    showMsg('提示',res.msg,5,'frown',3);
                } else {
                    showMsg('提示',res.msg,2,'smile',2, function () {
                        window.location.href = res.url;
                    });
                }
            }
        });
    });
</script>
</body>
</html>