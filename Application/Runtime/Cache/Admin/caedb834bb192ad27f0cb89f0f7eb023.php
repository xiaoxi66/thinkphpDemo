<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
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
<title>权限管理 - <?php echo (session('back_name')); ?></title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" id="form-auth-add" method="post" action="<?php echo U('add');?>" target="_self">
			<div style="width: 100px;display: inline-block;">
				<span class="select-box">
					<select class="select" size="1" id="pid" name="pid">
						<option value="0" selected>作为顶级</option>
						{//循环输出顶级分类，本系统只有2层分类}
						<?php if(is_array($auth)): $i = 0; $__LIST__ = $auth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</span>
			</div>
			<input type="text" class="input-text" style="width:100px" placeholder="权限名称" id="auth_name" name="auth_name"/>
			<!-- <input type="text" class="input-text" style="width:100px" placeholder="控制器名称" id="controller" name="controller"/> -->
			<div style="width: 100px;display: inline-block;">
				<span class="select-box">
					<select class="select" size="1" id="controller" name="controller">
						<option value="" selected>控制器名</option>
						{//循环输出控制器名}
						<?php if(is_array($controllers)): $i = 0; $__LIST__ = $controllers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c); ?>"><?php echo ($c); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</span>
			</div>
			<!-- <input type="text" class="input-text" style="width:100px" placeholder="方法名称" id="action" name="action"/> -->
			<div style="width: 100px;display: inline-block">
				<span class="select-box">
					<select class="select" size="1" id="action" name="action">
						<option value="" selected>方法名称</option>
						<!-- 通过JavaScript新增选项 -->
					</select>
				</span>
			</div>
			<div style="width: 100px;display: inline-block;">
				<span class="select-box">
					<select class="select" size="1" id="is_nav" name="is_nav" required="">
						<option value="" selected>作为导航</option>
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</span>
			</div>
			<input type="text" class="input-text" style="width:100px" placeholder="导航图标" id="icon" name="icon"/>
			<button type="submit" class="btn btn-success" id="subBtn" name=""><i class="Hui-iconfont">&#xe600;</i>添加权限</button>
		</form>
	</div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="8">权限列表</th>
			</tr>
			<tr class="text-c">
				<th width="30">ID</th>
				<th width="80">权限名称</th>
				<th width="80">所属分类</th>
				<th width="180">权限规则</th>
				<th width="50">作为导航</th>
				<th width="50">状态</th>
				<th width="50">图标</th>
				<th width="130">创建时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo (str_repeat('&emsp;',$vo["level"]*3)); echo ($vo["auth_name"]); ?></td>
				<td><?php echo ($vo["parent_name"]); ?></td>
				<td>
					<?php if($vo["pid"] > "0"): echo ($vo["controller"]); ?>/<?php echo ($vo["action"]); endif; ?>
				</td>
				<td><?php echo (getStatus($vo["is_nav"])); ?></td>
				<td class="td-status">
					<?php if($vo["status"] == '1'): ?><span class="label label-success radius">已启用</span>
                	<?php else: ?>
                		<span class="label radius">已停用</span><?php endif; ?>
				</td>
				<td>
					<?php if(!empty($vo["icon"])): ?><i class="Hui-iconfont"><?php echo (htmlspecialchars_decode($vo["icon"])); ?></i><?php endif; ?>
				</td>
				<td><?php echo (date('Y-m-d H:i:s',$vo["created_at"])); ?></td>
				<td class="td-manage">
					<?php if($vo["status"] == '1'): ?><a style="text-decoration:none" onClick="auth_stop(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
                	<?php else: ?>
                		<a style="text-decoration:none" onClick="auth_start(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a><?php endif; ?>
					<a title="编辑" href="javascript:;" onclick="auth_edit('角色编辑','<?php echo ($vo["id"]); ?>','','480')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="auth_del(this,'<?php echo ($vo["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/Statics/Lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Statics/Lib/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Statics/Lib/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<!-- jQuery.validate -->
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Statics/Lib/jquery.validation/1.14.0/messages_zh.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Statics/Lib/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-编辑*/
function auth_edit(title,id,w,h){
	var url = "<?php echo U('edit',['id' => '__ID__']);?>";
    url = url.replace('__ID__',id);
	layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function auth_del(obj,id){
	parent.layer.confirm('若当前权限下存在其他子权限，则会一并删除，确认要删除吗？',{icon:3,title:'操作确认'},function(index){
		$.ajax({
			type: 'POST',
			url: '<?php echo U("del");?>',
			dataType: 'json',
			data: {id: id},
			success: function(data){
				if(data.code == '0'){
                	parent.layer.msg('已删除!', { icon: 1, time: 1500 },function(){
                		if(data.count == '1'){
                			$(obj).parents("tr").remove();
                		}else{
                			location.href = location.href;
                		}
                	});
                }else{
                	parent.layer.msg(data.message, { icon: 2, time: 2000 });
                }
			},
			error:function(data) {
				console.log(data.message);
			},
		});		
	});
}

/*管理员-权限-停用*/
function auth_stop(obj, id) {
	//获取当前权限停用提示
	var loadIndex = parent.layer.load(1, {
  		shade: [0.5,'#333'] //0.5透明度的灰色背景
	});
	//获取类型
	$.ajax({
		url: '<?php echo U("getAuthType");?>',
		type: 'POST',
		dataType: 'html',
		data: {id: id},
		success: function(data){
			if(data == '0'){
				//顶级
				parent.layer.confirm('您正在停用顶级权限，停用顶级权限后其下所有的权限均将被停用，是否继续？',{icon:3,title:'操作确认'},function(index) {
			        $.post("<?php echo U('swStatus');?>", {id: id,status: '0'}, function(data, textStatus, xhr) {
			        	if(data != '0'){
				            parent.layer.msg('操作已成功!', { icon: 1, time: 1500 },function(){
				            	location.href = location.href;
				            });
			        	}else{
			        		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
			        	}
			        });
			    });
			}else{
				//非顶级
				parent.layer.confirm('确认要停用吗？',{icon:3,title:'操作确认'},function(index) {
			        $.post("<?php echo U('swStatus');?>", {id: id,status: '0'}, function(data, textStatus, xhr) {
			        	if(data == '1'){
			        		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="auth_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
				            $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
				            $(obj).remove();
				            parent.layer.msg('已停用!', { icon: 1, time: 1500 });
			        	}else{
			        		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
			        	}
			        });
			    });
			}
		}
	})
	.fail(function() {
		parent.layer.msg('请求超时!', { icon: 2, time: 2000 });
	})
	.always(function() {
		parent.layer.close(loadIndex);
	}); 
}

/*管理员-权限-启用*/
function auth_start(obj, id) {
	//获取当前权限停用提示
	var loadIndex = parent.layer.load(1, {
  		shade: [0.5,'#333'] //0.5透明度的灰色背景
	});
	//获取类型
	$.ajax({
		url: '<?php echo U("getAuthType");?>',
		type: 'POST',
		dataType: 'html',
		data: {id: id},
		success: function(data){
			if(data == '0'){
				//顶级
				parent.layer.confirm('您正在启用顶级权限，启用顶级权限后其下所有的权限均将被启用，是否继续？',{icon:3,title:'操作确认'},function(index) {
			        $.post("<?php echo U('swStatus');?>", {id: id,status: '1'}, function(data, textStatus, xhr) {
			        	if(data != '0'){
				            parent.layer.msg('操作已成功!', { icon: 1, time: 1500 },function(){
				            	location.href = location.href;
				            });
			        	}else{
			        		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
			        	}
			        });
			    });
			}else{
				//非顶级
				parent.layer.confirm('确认要启用吗？',{icon:3,title:'操作确认'},function(index) {
			        $.post("<?php echo U('swStatus');?>", {id: id,status: '1'}, function(data, textStatus, xhr) {
			        	if(data == '1'){
			        		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="auth_stop(this,' + id +')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
				            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				            $(obj).remove();
				            parent.layer.msg('已启用!', { icon: 1, time: 1500 });
			        	}else{
			        		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
			        	}
			        });
			    });
			}
		}
	})
	.fail(function() {
		parent.layer.msg('请求超时!', { icon: 2, time: 2000 });
	})
	.always(function() {
		parent.layer.close(loadIndex);
	}); 
}

//jQuery载入事件
$(function(){
	//初始化添加权限3个元素
	$("#controller,#action,#icon").attr("disabled","disabled");

	//当切换权限分类的时候需要判断是否重置2个选项
	$('select[name=pid]').change(function(){
		//获取值
		var _val = $(this).val();
		if(_val > 0){
			$("#controller,#action").removeAttr("disabled");
		}else{
			$("#controller,#action").val("");
			$("#controller,#action").attr("disabled","disabled");
		}
	});

	//当类型为菜单时开放icon的填写
	$('select[name=is_nav]').change(function(){
		//获取值
		var _val = $(this).val();
		if(_val > 0){
			$("#icon").removeAttr("disabled");
		}else{
			$("#icon").val("");
			$("#icon").attr("disabled","disabled");
		}
	});

	//控制器权限二级联动
	$('#controller').change(function(){
		//获取控制器名
		var _val = $(this).val();
		if(_val){
			$.post("<?php echo U('getActionNames');?>",{controller_name:_val},function(data){
				if(data.code == '0'){
					var ops = '';
					$.each(data.message,function(index,el){
						ops += "<option value='" + el + "'>" + el + "</option>"
					});
					//清空原有option的选项
					$('#action option').not(':first').remove();
					//追加新的方法名称
					$('#action').append(ops);
				}
			},'json');
		}
	});

	//添加权限处理
	$('#subBtn').click(function(){
		$("#form-auth-add").validate({
			rules:{
				auth_name:{
					required:true,
				},
				is_nav:{
					required:true,
				}
			},
			onkeyup:false,
			focusCleanup:true,
			success:"valid",
			submitHandler:function(form){
				//获取数据
				$(form).ajaxSubmit({
					type: 'post',
					url:  $(form).attr('action'),
					success: function(data){
						if(data.code == '0'){
							//提示成功，并且重新加载页面
							parent.layer.msg(data.message,{icon:1,time:1500});
							location.href = location.href;
						}else if(data.code == '2'){
							//服务器端验证失败，输出错误信息
							var err = '';
							$.each(data.message,function(index,el){
								err += el + '<br/>';
							})
							parent.layer.alert(err,{icon:2,title:'自动验证提示'});
						}else{
							//错误代码1和3
							parent.layer.msg(data.message,{icon:2,time:2000});
						}
					},
	                error: function(XmlHttpRequest, textStatus, errorThrown){
						parent.layer.msg('error!',{icon:1,time:1500});
					}
				});
			}
		});		
	});

	//datatables初始化
	var dt = $('table').dataTable({
		ordering: false,	//禁用排序
		paging: false,	//禁用分页
    });
});
</script>
</body>
</html>