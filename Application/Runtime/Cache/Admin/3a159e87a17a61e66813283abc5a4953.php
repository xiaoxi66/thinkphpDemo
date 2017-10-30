<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico">
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
    <title>管理员列表 - <?php echo (session('back_name')); ?></title>
</head>

<body>
    <nav class="breadcrumb">
    	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="page-container" style="padding-top: 0px;">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        	<span class="l">
        		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
        		<a href="javascript:;" onclick="admin_add('添加管理员','admin-add.html','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
        	</span>
        </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="10">管理员列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25">
                        <input type="checkbox" name="" value="">
                    </th>
                    <th width="40">ID</th>
                    <th width="150">登录名</th>
                    <th width="50">姓名</th>
                    <th width="90">手机</th>
                    <th width="180">邮箱</th>
                    <th width="50">角色</th>
                    <th width="130">加入时间</th>
                    <th width="50">状态</th>
                    <th width="80">操作</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="text-c">
	                    <td>
                            <?php if(($vol["role_id"]) != "1"): ?><input type="checkbox" value="<?php echo ($vol["id"]); ?>" name="id">
                            <?php else: ?>
                            ×<?php endif; ?>
	                    </td>
	                    <td><?php echo ($vol["id"]); ?></td>
	                    <td><?php echo ($vol["username"]); ?></td>
	                    <td><?php echo ($vol["truename"]); ?></td>
	                    <td><?php echo ($vol["mobile"]); ?></td>
	                    <td><?php echo ($vol["email"]); ?></td>
	                    <td><?php echo ($vol["role_name"]); ?></td>
	                    <td><?php echo ($vol["created_at"]); ?></td>
	                    <td class="td-status">
	                    	<?php if($vol["status"] == '1'): ?><span class="label label-success radius">已启用</span>
	                    	<?php else: ?>
	                    		<span class="label radius">已停用</span><?php endif; ?>
	                    </td>
	                    <td class="td-manage">
	                    	<?php if($vol["id"] != $_SESSION['admin_userinfo']['id']): if($vol["status"] == '1'): ?><a style="text-decoration:none" onClick="admin_stop(this,'<?php echo ($vol["id"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
	                    	<?php else: ?>
	                    		<a style="text-decoration:none" onClick="admin_start(this,'<?php echo ($vol["id"]); ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a><?php endif; ?> 
	                    	<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo ($vol["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a><?php endif; ?>
	                    	<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑-[<?php echo ($vol["truename"]); ?>/<?php echo ($vol["username"]); ?>]','<?php echo ($vol["id"]); ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
	                    </td>
	                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                
            </tbody>
        </table>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Statics/Lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/Statics/Lib/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/Statics/Lib/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/Statics/Lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/Statics/Lib/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Statics/Lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
    /*
    	参数解释：
    	title	标题
    	url		请求的url
    	id		需要操作的数据id
    	w		弹出层宽度（缺省调默认值）
    	h		弹出层高度（缺省调默认值）
    */
    /*管理员-增加*/
    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*管理员-删除*/
    function admin_del(obj, id) {
        parent.layer.confirm('确认要删除吗？',{icon:3,title:'操作确认'},function(index) {
            $.ajax({
                type: 'POST',
                url: "<?php echo U('del');?>",
                data: {id: id},
                dataType: 'json',
                success: function(data) {
                    if(data.code == '0'){
                    	$(obj).parents("tr").remove();
                    	parent.layer.msg('已删除!', { icon: 1, time: 1500 });
                    }else{
                    	parent.layer.msg(data.message, { icon: 2, time: 2000 });
                    }
                },
                error: function(data) {
                    console.log(data.message);
                },
            });
        });
    }

    /*管理员-编辑*/
    function admin_edit(title, id, w, h) {
    	var url = "<?php echo U('edit',['id' => '__ID__']);?>";
    	url = url.replace('__ID__',id);
    	layer_show(title,url,w,h);
    }

    /*管理员-停用*/
    function admin_stop(obj, id) {
        parent.layer.confirm('确认要停用吗？',{icon:3,title:'操作确认'},function(index) {
        	//判断是否是操作自身
        	if(id == '<?php echo ($_SESSION['admin_userinfo']['id']); ?>'){
        		parent.layer.msg('无法操作自身帐号!', { icon: 2, time: 2000 });return;
        	}
            $.post("<?php echo U('swStatus');?>", {id: id,status: '2'}, function(data, textStatus, xhr) {
            	if(data == '1'){
            		//此处请求后台程序，下方是成功后的前台处理……
		            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		            $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
		            $(obj).remove();
		            parent.layer.msg('已停用!', { icon: 1, time: 1000 });
            	}else{
            		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
            	}
            },'json');
        });
    }

    /*管理员-启用*/
    function admin_start(obj, id) {
        parent.layer.confirm('确认要启用吗？',{icon:3,title:'操作确认'},function(index) {
        	//判断是否是操作自身
        	if(id == '<?php echo ($_SESSION['admin_userinfo']['id']); ?>'){
        		parent.layer.msg('无法操作自身帐号!', { icon: 2, time: 2000 });return;
        	}
            $.post("<?php echo U('swStatus');?>", {id: id,status: '1'}, function(data, textStatus, xhr) {
            	if(data == '1'){
            		//此处请求后台程序，下方是成功后的前台处理……
		            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,' + id +')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		            $(obj).remove();
		            parent.layer.msg('已启用!', { icon: 1, time: 1000 });
		        }else{
		        	parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
		        }
            },'json');
        });
    }

    //jQuery页面载入事件
    $(function(){
    	//datatables初始化
    	$('table').dataTable({
    		"columnDefs": [ { "sortable": false, "targets": [0,9] }],
    		"sorting": [[ 1, "asc" ]]
    	});
    });
    </script>
</body>

</html>