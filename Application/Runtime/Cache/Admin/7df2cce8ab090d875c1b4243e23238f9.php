<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>管理员编辑 - <?php echo (session('back_name')); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Statics/Admin/css/font.css">
    <link rel="stylesheet" href="/Statics/Admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Statics/Lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Statics/Admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>用户名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="username" name="username" required="" lay-verify="required" autocomplete="off" value="<?php echo ($data["username"]); ?>" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>姓名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="truename" name="truename" required="" lay-verify="required" autocomplete="off" value="<?php echo ($data["truename"]); ?>" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>您的真实姓名
                </div>
            </div>
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">
                    <span class="x-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="<?php echo ($data["mobile"]); ?>" id="phone" name="mobile" required="" lay-verify="phone" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会用于安全验证和通知接收
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>邮箱
                </label>
                <div class="layui-input-inline">
                    <input type="text" value="<?php echo ($data["email"]); ?>" id="L_email" name="email" required="" lay-verify="email" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">
                <span class="x-red">*</span>状态
              </label>
              <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" checked="">
                <div class="layui-unselect layui-form-radio layui-form-radioed">
                  <i class="layui-anim layui-icon layui-anim-scaleSpring"></i><span>启用</span>
                </div>
                <input type="radio" name="status" value="2" title="禁用">
                <div class="layui-unselect layui-form-radio">
                  <i class="layui-anim layui-icon"></i>
                  <span>禁用</span>
                </div>
              </div>
          </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red"></span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="password" lay-verify="password" autocomplete="off" class="layui-input" placeholder="如无需修改则留空">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    6到16个字符
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="add" lay-submit="">
                    确定
                </button>
            </div>
        </form>
    </div>
    <script>
    layui.use(['form', 'layer'], function() {
        $ = layui.jquery;
        var form = layui.form(),
            layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function(value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            },
            password: [/(.+){6,12}$/, '密码必须6到12位']
        });

        //监听提交
        form.on('submit(add)', function(data) {
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", { icon: 6 }, function() {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
        });
    });
    </script>
</body>

</html>