<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Statics/Lib/html5shiv.js"></script>
<script type="text/javascript" src="/Statics/Lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Statics/Lib/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Statics/Lib/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Statics/Lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Statics/Lib/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Statics/Lib/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Statics/Lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>角色添加 - 管理员管理 - <?php echo (session('back_name')); ?></title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请填写角色名称..." id="role_name" name="role_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">角色描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="请简单的描述角色权限" id="desc" name="desc">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">权限设置：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<dl class="permission-list">
					<dd>
						<?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="<?php echo ($vol["id"]); ?>" name="auth_id[]">
									<b><?php echo ($vol["auth_name"]); ?></b>
								</label>
							</dt>
							<dd>
								<?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 4 );++$i; if($vo["pid"] == $vol["id"] ): ?><label class="">
									<input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="auth_id[]"/>
									<?php echo ($vo["auth_name"]); ?>
								</label>
								<?php if(($mod) == "3"): ?><br/><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
							</dd>
						</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</dd>
				</dl>
			</div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" value="1" id="status-1" checked>
				<label for="status-1">启用</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="status-2" value="0" name="status">
				<label for="status-2">禁用</label>
			</div>
		</div>
	</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/Statics/Lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Statics/Lib/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Statics/Lib/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			role_name:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
                type: 'post',
                url: "",
                success: function(data) {
                	if(data.code == '0'){
                        parent.parent.layer.msg(data.message, {
                            icon: 1,
                            time: 1500
                        },function(){
                        	//关闭弹窗
			                parent.location.href=parent.location.href;//刷新页面
			                var index = parent.layer.getFrameIndex(window.name);
			                parent.$('.btn-refresh').click();
			                parent.layer.close(index);
                        });
					}else if(data.code == '2'){
						//服务器端验证失败，输出错误信息
						var err = '';
						$.each(data.message,function(index,el){
							err += el + '<br/>';
						})
						parent.layer.alert(err,{icon:2,title:'自动验证提示'});
					}else{
						//错误代码1
						parent.layer.msg(data.message,{icon:2,time:2000});
					}
                },
                error: function(XmlHttpRequest, textStatus, errorThrown) {
                    parent.parent.layer.msg('error!', {
                        icon: 1,
                        time: 1000
                    });
                }
            });
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>