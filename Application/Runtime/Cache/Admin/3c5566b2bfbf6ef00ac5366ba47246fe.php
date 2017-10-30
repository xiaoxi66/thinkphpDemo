<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>后台登录 - 欢迎使用传智播客旅游网站管理系统 v2.0</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Statics/Admin/css/font.css">
    <link rel="stylesheet" href="/Statics/Admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/Statics/Lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Statics/Admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/Statics/Sdk/geetest/static/gt.js"></script>
    <style type="text/css">
      #embed-captcha {
          width: 100%;
          margin: 0 auto;
      }
      .show {
          display: block;
      }
      .hide {
          display: none;
      }
      #notice {
          color: red;
      }
    </style>
</head>

<body class="login-bg">
    <div class="login">
        <div class="message"><?php echo (session('back_name')); ?>-管理登录</div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form">
            <input name="username" placeholder="用户名" type="text" lay-verify="required" class="layui-input">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
            <hr class="hr15">
            <div id="embed-captcha"></div>
            <p id="wait" class="show">正在加载验证码......</p>
            <p id="notice" class="hide">请先完成人机识别验证</p>
            <input value="登录" id="embed-submit" lay-submit lay-filter="login" style="width:100%;margin-top: 16px;" type="submit">
            <hr class="hr20">
        </form>
    </div>
    <script>
    $(function() {
        var handlerEmbed = function (captchaObj) {
          $("#embed-submit").click(function (e) {
            var validate = captchaObj.getValidate();
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
            }else{
              layui.use('form', function() {
                var form = layui.form;
                //监听提交
                form.on('submit(login)', function(data) {
                    //ajax验证
                    $.post("<?php echo U('checkLogin');?>",{username: data.field.username,password: data.field.password,geetest_challenge: data.field.geetest_challenge,geetest_validate: data.field.geetest_validate,geetest_seccode: data.field.geetest_seccode},function(res) {
                      //判断结果
                      if(res.code == '0'){
                        layer.msg(res.message,{icon: 1},function(){
                          location.href = "<?php echo U('Index/index');?>";
                        });
                      }else if(res.code == '1'){
                        //失败
                        layer.msg(res.message,{icon: 2});
                      }else{
                        layer.msg(res.message,{icon: 2});
                        captchaObj.reset();
                      }
                    },'json');
                    return false;
                });
              });
            }
          });
          captchaObj.appendTo("#embed-captcha");
          captchaObj.onReady(function () {
              $("#wait")[0].className = "hide";
          });
        };
        $.ajax({
            url: "/Statics/Sdk/geetest/web/StartCaptchaServlet.php?t=" + (new Date()).getTime(),
            type: "get",
            dataType: "json",
            success: function (data) {
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    new_captcha: data.new_captcha,
                    product: "embed",
                    offline: !data.success,
                    width:'100%'
                }, handlerEmbed);
            }
        });
    })
    </script>
    <!-- 底部结束 -->
</body>

</html>