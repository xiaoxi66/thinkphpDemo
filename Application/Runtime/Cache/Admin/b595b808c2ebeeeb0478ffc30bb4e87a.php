<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>后台首页 - <?php echo (session('back_name')); ?></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Statics/Admin/css/font.css">
    <link rel="stylesheet" href="/Statics/Admin/css/xadmin.css">
    <link href="/Statics/Lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/Statics/Lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Statics/Admin/js/xadmin.js"></script>

</head>

<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="<?php echo U('index');?>">传智旅游网站管理系统</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;">+新增</a>
                <dl class="layui-nav-child">
                    <!-- 二级菜单 -->
                    <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
                    <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
                    <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;"><?php echo ($_SESSION['admin_userinfo']['username']); ?></a>
                <dl class="layui-nav-child">
                    <!-- 二级菜单 -->
                    <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
                    <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                    <dd><a href="<?php echo U('Public/logout');?>">退出</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item to-index"><a href="/" target="_blank">前台首页</a></li>
        </ul>
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    <!-- 左侧菜单开始 -->
    <div class="left-nav">
        <div id="side-nav">
            <ul id="nav">
                <?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li>
                    <a href="javascript:;">
                        <i class="Hui-iconfont"><?php echo (htmlspecialchars_decode($vol["icon"])); ?></i>
                        <cite><?php echo ($vol["auth_name"]); ?></cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["pid"] == $vol["id"] ): ?><li>
                            <a _href="<?php echo ($vo["url"]); ?>">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite><?php echo ($vo["auth_name"]); ?></cite>
                            </a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
            <ul class="layui-tab-title">
                <li>欢迎页</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src='<?php echo U("welcome");?>' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">©<?php echo date('Y'); ?> 黑马程序员 - PHP学院 All Rights Reserved</div>
    </div>
    <!-- 底部结束 -->
</body>

</html>