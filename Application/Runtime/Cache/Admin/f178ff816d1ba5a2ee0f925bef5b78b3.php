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
    <title>角色列表 - <?php echo (session('back_name')); ?></title>
</head>

<body>
    <nav class="breadcrumb">
    	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 角色管理 <span class="c-gray en">&gt;</span> 角色列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="page-container" style="padding-top: 0px;">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        	<span class="l">
        		<a href="javascript:;" onclick="role_add('添加角色','<?php echo U('add');?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a>
        	</span>
        </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="7">角色列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25">ID</th>
                    <th width="80">角色名</th>
                    <th width="80">权限规则</th>
                    <th width="200">权限说明</th>
                    <th width="100">创建时间</th>
                    <th width="50">状态</th>
                    <th width="80">操作</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="text-c">
	                    <td><?php echo ($vol["id"]); ?></td>
	                    <td><?php echo ($vol["role_name"]); ?></td>
	                    <td>
                            <?php if($vol["id"] == '1'): echo ($vol["auth"]); ?>
                            <?php else: ?>
                                <a href="javascript:void(0);" onclick="showThisRoleAuth(this)" data-con="<?php echo ($vol["auth"]); ?>">点此查看</a><?php endif; ?>   
                        </td>
	                    <td><?php echo ($vol["desc"]); ?></td>
	                    <td><?php echo (date('Y-m-d H:i:s',$vol["created_at"])); ?></td>
                        <td class="td-status">
                            <?php if($vol["status"] == '1'): ?><span class="label label-success radius">已启用</span>
                            <?php else: ?>
                                <span class="label radius">已停用</span><?php endif; ?>
                        </td>
	                    <td class="td-manage">
	                    	<?php if($vol["id"] != '1' ): if($vol["status"] == '1'): ?><a style="text-decoration:none" onClick="role_stop(this,'<?php echo ($vol["id"]); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
	                    	<?php else: ?>
	                    		<a style="text-decoration:none" onClick="role_start(this,'<?php echo ($vol["id"]); ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a><?php endif; ?> 
	                    	<a title="删除" href="javascript:;" onclick="role_del(this,'<?php echo ($vol["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            <a title="编辑" href="javascript:;" onclick="role_edit('角色编辑-[<?php echo ($vol["role_name"]); ?>]','<?php echo ($vol["id"]); ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                            <?php else: ?>
                            不可操作<?php endif; ?>
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
    /*角色-增加*/
    function role_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*角色-删除*/
    function role_del(obj, id) {
        //检查当前角色是否允许删除
        var loadIndex = parent.layer.load(1, {
            shade: [0.5,'#333'] //0.5透明度的灰色背景
        });
        //发起判断请求
        $.ajax({
            url: '<?php echo U("checkRoleStatus");?>',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                //判断
                if(data.count == '0'){
                    //允许删除
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
                                parent.console.log(data.message);
                            },
                        });
                    });
                }else{
                    //不允许删除
                    parent.layer.alert(data.message,{icon: 5,title: '操作提示'});
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

    /*角色-编辑*/
    function role_edit(title, id, w, h) {
    	var url = "<?php echo U('edit',['id' => '__ID__']);?>";
    	url = url.replace('__ID__',id);
    	layer_show(title,url,w,h);
    }

    /*角色-停用*/
    function role_stop(obj, id) {
        parent.layer.confirm('确认要停用吗？',{icon:3,title:'操作确认'},function(index) {
        	//判断是否是操作自身
            $.post("<?php echo U('swStatus');?>", {id: id,status: '0'}, function(data, textStatus, xhr) {
            	if(data == '1'){
            		//此处请求后台程序，下方是成功后的前台处理……
		            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="role_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		            $(obj).parents("tr").find(".td-status").html('<span class="label radius">已停用</span>');
		            $(obj).remove();
		            parent.layer.msg('已停用!', { icon: 1, time: 1000 });
            	}else{
            		parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
            	}
            },'json');
        });
    }

    /*角色-启用*/
    function role_start(obj, id) {
        parent.layer.confirm('确认要启用吗？',{icon:3,title:'操作确认'},function(index) {
            $.post("<?php echo U('swStatus');?>", {id: id,status: '1'}, function(data, textStatus, xhr) {
            	if(data == '1'){
            		//此处请求后台程序，下方是成功后的前台处理……
		            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="role_stop(this,' + id +')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		            $(obj).remove();
		            parent.layer.msg('已启用!', { icon: 1, time: 1000 });
		        }else{
		        	parent.layer.msg('操作失败!', { icon: 2, time: 2000 });
		        }
            },'json');
        });
    }

    //点击权限规则查看链接弹出内容
    function showThisRoleAuth(obj){
        var data = $(obj).attr('data-con');
        var arr = data.split(',');
        var con = '';
        for (var i = 0; i < arr.length; i++) {
            con += arr[i] + '<br/>';
        }
        parent.layer.alert(con,{title: '权限规则',icon: 6});
    }

    //jQuery页面载入事件
    $(function(){
    	//datatables初始化
    	$('table').dataTable({
    		"columnDefs": [ { "sortable": false, "targets": [6] }],
    		"sorting": [[ 0, "asc" ]]
    	});
    });
    </script>
</body>

</html>