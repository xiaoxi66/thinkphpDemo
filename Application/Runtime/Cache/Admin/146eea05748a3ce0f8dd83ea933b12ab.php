<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>编辑权限 - 权限管理 - <?php echo (session('back_name')); ?></title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-5 col-sm-4">
			<input type="text" class="input-text" value="<?php echo ($data["auth_name"]); ?>" placeholder="请输入权限名称" id="auth_name" name="auth_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属分类：</label>
		<div class="formControls col-xs-8 col-sm-9"> 
			<span class="select-box" style="width:150px;">
				<select class="select" id="pid" name="pid" size="1">
					<option value="0">作为顶级</option>
					
					<?php if(is_array($parents)): $i = 0; $__LIST__ = $parents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>" <?php if($data["pid"] == $vol["id"] ): ?>selected<?php endif; ?>><?php echo ($vol["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</span> 
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名：</label>
		<div class="formControls col-xs-8 col-sm-9"> 
			<span class="select-box" style="width:150px;">
				<select class="select" id="controller" name="controller" size="1">
					<option value="">控制器名</option>
					
					<?php if(is_array($controllers)): $i = 0; $__LIST__ = $controllers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" <?php if($data["controller"] == $vo ): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</span> 
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法名称：</label>
		<div class="formControls col-xs-8 col-sm-9"> 
			<span class="select-box" style="width:150px;">
				<select class="select" id="action" name="action" size="1">
					<option value="">方法名称</option>
				</select>
			</span> 
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
		<div class="formControls col-xs-8 col-sm-9"> 
			<span class="select-box" style="width:150px;">
				<select class="select" id="is_nav" name="is_nav" size="1">
					<option value="1" <?php if($data["is_nav"] == '1'): ?>selected<?php endif; ?>>是</option>
					<option value="0" <?php if($data["is_nav"] == '0'): ?>selected<?php endif; ?>>否</option>
				</select>
			</span> 
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" value="1" id="status-1" <?php if($data["status"] == '1'): ?>checked<?php endif; ?>>
				<label for="status-1">启用</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="status-2" value="0" name="status" <?php if($data["status"] == '0'): ?>checked<?php endif; ?>>
				<label for="status-2">禁用</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">菜单图标：</label>
		<div class="formControls col-xs-2 col-sm-3">
			<input type="text" class="input-text" value="<?php echo ($data["icon"]); ?>" placeholder="请输入菜单图标" id="icon" name="icon">
		</div>
		<span style="color: #ccc;">图标选取可以<a href='http://zet.so/wJtk' style="text-decoration: none;color: #ccc;font-weight: bolder;" target="_blank">查看此处</a></span>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
	if($('select[name=pid').val() == '0'){
		$("#controller,#action").attr("disabled","disabled");
	}

	//判断初始菜单图标文本框状态
	if($('select[name=is_nav]').val() == '0'){
		$("#icon").attr("disabled","disabled");
	}else{
		$("#icon").removeAttr("disabled");
	}

	//当菜单是否选项改变时改变菜单图标是否可写
	$('select[name=is_nav]').change(function(){
		//获取值
		var _val = $(this).val();
		if(_val > '0'){
			$("#icon").removeAttr("disabled");
		}else{
			$("#icon").attr("disabled","disabled");
		}
	});

	//当切换权限分类的时候需要判断是否重置2个文本域
	$('select[name=pid]').change(function(){
		//获取值
		var _val = $(this).val();
		if(_val > '0'){
			$("#controller,#action").removeAttr("disabled");
		}else{
			$("#controller,#action").val("");
			$("#controller,#action").attr("disabled","disabled");
		}
	});

	//控制器权限二级联动
	$('#controller').change(function(event,_auto = false){
		//获取控制器名
		var _val = $(this).val();
		var _action = "<?php echo ($data["action"]); ?>";
		if(_val){
			$.post("<?php echo U('getActionNames');?>",{controller_name:_val},function(data){
				if(data.code == '0'){
					var ops = '';
					$.each(data.message,function(index,el){
						//页面首次加载判断是否选中某一项
						if(_auto){
							if(_action == el){
								ops += "<option value='" + el + "' selected>" + el + "</option>"
							}else{
								ops += "<option value='" + el + "'>" + el + "</option>"
							}
						}else{
							//手动触发加载
							ops += "<option value='" + el + "'>" + el + "</option>";
						}
						
					});
					//清空原有option的选项
					$('#action option').not(':first').remove();
					//追加新的方法名称
					$('#action').append(ops);
				}
			},'json');
		}
	});
	//页面首次加载时触发二级联动事件，传递自动触发标志
	$('#controller').trigger('change',true);

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			auth_name:{
				required:true,
				minlength:2,
				maxlength:10
			},
			pid:{
				required:true,
			},
			is_nav:{
				required:true,
			},
			status:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				success: function(data){
					if(data.code == '0'){
						//提示成功，刷新父页面，并且关闭本弹窗
						parent.parent.layer.msg(data.message,{icon:1,time:1500},function(){
							parent.location.href = parent.location.href;
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
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1500});
				}
			});
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>