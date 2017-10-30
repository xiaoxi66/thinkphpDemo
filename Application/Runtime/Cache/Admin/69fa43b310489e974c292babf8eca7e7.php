<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面 - <?php echo (session('back_name')); ?></title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="/Statics/Admin/css/font.css">
        <link rel="stylesheet" href="/Statics/Admin/css/xadmin.css">
    </head>
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote"><b><?php echo ($_SESSION['admin_userinfo']['truename']); ?>(<?php echo ($_SESSION['admin_userinfo']['username']); ?>)</b> 您好，您上次于 <b><?php echo (date('Y-m-d H:i:s',$_SESSION['admin_userinfo']['last_login'])); ?></b> 在 <b><?php echo (getAddrByIpv4($_SESSION['admin_userinfo']['ip'])); ?>(<?php echo ($_SESSION['admin_userinfo']['ip']); ?>)</b> 进行登录。</blockquote>
            <fieldset class="layui-elem-field">
              <legend>信息统计</legend>
              <div class="layui-field-box">
                <table class="layui-table" lay-even>
                    <thead>
                        <tr>
                            <th>统计</th>
                            <th>资讯库</th>
                            <th>图片库</th>
                            <th>产品库</th>
                            <th>用户</th>
                            <th>管理员</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>总数</td>
                            <td>92</td>
                            <td>9</td>
                            <td>0</td>
                            <td>8</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>今日</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>昨日</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>本周</td>
                            <td>2</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>本月</td>
                            <td>2</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
                <table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>服务器上次启动到现在已运行 </td>
                        <td>7<?php echo explode(',',exec('uptime'))[0]; ?></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td><?php echo gethostbyname($_SERVER['SERVER_NAME']); ?></td>
                    </tr>
                    <tr>
                        <td>网站域名</td>
                        <td><?php echo ($_SERVER['SERVER_NAME']); ?></td>
                    </tr>
                    <tr>
                        <td>服务器端口 </td>
                        <td><?php echo ($_SERVER['SERVER_PORT']); ?></td>
                    </tr>
                    <tr>
                        <td>服务器软件版本 </td>
                        <td><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></td>
                    </tr>
                    <tr>
                        <td>本文件所在路径 </td>
                        <td><?php echo ($_SERVER['SCRIPT_FILENAME']); ?></td>
                    </tr>
                    <tr>
                        <td>服务器操作系统 </td>
                        <td><?php echo php_uname('s'); ?></td>
                    </tr>
                    <tr>
                        <td>操作系统版本 </td>
                        <td><?php echo php_uname('r'); ?></td>
                    </tr>
                    <tr>
                        <td>服务器脚本超时时间 </td>
                        <td><?php echo ini_get('max_execution_time'); ?> 秒</td>
                    </tr>
                    <tr>
                        <td>服务器的语言种类 </td>
                        <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></td>
                    </tr>
                    <tr>
                        <td>PHP版本 </td>
                        <td><?php echo PHP_VERSION; ?></td>
                    </tr>
                    <tr>
                        <td>PHP运行方式 </td>
                        <td><?php echo php_sapi_name(); ?></td>
                    </tr>
                    <tr>
                        <td>服务器当前时间 </td>
                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                    </tr>
                    <tr>
                        <td>服务器Zend版本 </td>
                        <td><?php echo Zend_Version(); ?></td>
                    </tr>
                    <tr>
                        <td>当前进程用户名 </td>
                        <td><?php echo get_current_user(); ?></td>
                    </tr>
                </tbody>
            </table>
              </div>
            </fieldset>
            <blockquote class="layui-elem-quote layui-quote-nm">
                Author:<a href="mailto:cherish@cherish?subject=咨询-传智播客旅游网站v2.0">cherish@cherish.pw</a>
            </blockquote>
            
        </div>
    </body>
</html>