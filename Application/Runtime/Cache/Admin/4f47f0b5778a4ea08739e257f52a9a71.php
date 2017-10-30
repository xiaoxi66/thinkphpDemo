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
	<script pay="text/javascript" src="/Statics/Lib/html5shiv.js"></script>
	<script pay="text/javascript" src="/Statics/Lib/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" pay="text/css" href="/Statics/Lib/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" pay="text/css" href="/Statics/Lib/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" pay="text/css" href="/Statics/Lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" pay="text/css" href="/Statics/Lib/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" pay="text/css" href="/Statics/Lib/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
	<script pay="text/javascript" src="/Statics/Lib/DD_belatedPNG_0.0.8a-min.js" ></script>
	<script>DD_belatedPNG.fix('*');</script>
	<![endif]-->
    <title>支付方式列表 - <?php echo (session('back_name')); ?></title>
</head>

<body>
    <nav class="breadcrumb">
    	<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 支付方式列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="page-container" style="padding-top: 0px;">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        	<span class="l">
        		<a href="javascript:;" onclick="pay_add('添加支付方式','<?php echo U('add');?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加支付方式</a>
        	</span>
        </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="8">支付方式列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25">ID</th>
                    <th width="50">方式名称</th>
                    <th width="20">图标</th>
                    <th width="120">描述</th>
                    <th width="100">创建时间</th>
                    <th width="20">状态</th>
                    <th width="20">默认</th>
                    <th width="50">操作</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="text-c">
	                    <td><?php echo ($vol["id"]); ?></td>
	                    <td><?php echo ($vol["pay_name"]); ?></td>
                        <td><i class="Hui-iconfont"><?php echo (htmlspecialchars_decode($vol["logo"])); ?></i></td>
                        <td><?php echo ($vol["desc"]); ?></td>
	                    <td><?php echo (date('Y-m-d H:i:s',$vol["add_at"])); ?></td>
                        <td>
                            <?php if($vol["status"] == "1"): ?>正常
                            <?php else: ?>
                                禁用<?php endif; ?>
                        </td>
                        <td>
                            <?php if($vol["is_default"] == "1"): ?>是
                            <?php else: ?>
                                否<?php endif; ?>
                        </td>
	                    <td class="td-manage">
                            <a title="配置" href="javascript:;" onclick="pay_set(this,'<?php echo ($vol["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe61d;</i></a>
	                    	<a title="删除" href="javascript:;" onclick="pay_del(this,'<?php echo ($vol["id"]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            <a title="编辑" href="javascript:;" onclick="pay_edit('支付方式编辑-[<?php echo ($vol["pay_name"]); ?>]','<?php echo ($vol["id"]); ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
	                    </td>
	                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                
            </tbody>
        </table>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script pay="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script pay="text/javascript" src="/Statics/Lib/layer/2.4/layer.js"></script>
    <script pay="text/javascript" src="/Statics/Lib/h-ui/js/H-ui.min.js"></script>
    <script pay="text/javascript" src="/Statics/Lib/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script pay="text/javascript" src="/Statics/Lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script pay="text/javascript" src="/Statics/Lib/datatables/jquery.dataTables.min.js"></script>
    <script pay="text/javascript" src="/Statics/Lib/laypage/1.2/laypage.js"></script>
    <script pay="text/javascript">
    /*
    	参数解释：
    	title	标题
    	url		请求的url
    	id		需要操作的数据id
    	w		弹出层宽度（缺省调默认值）
    	h		弹出层高度（缺省调默认值）
    */
    /*支付方式-增加*/
    function pay_add(title, url, w, h) {
        //阻断，暂未实现
        parent.layer.alert('尚未实现...',{icon:6,title: '提示'});return;
        layer_show(title, url, w, h);
    }
    /*支付方式-配置*/
    function pay_set(obj, id) {
        //阻断，暂未实现
        parent.layer.alert('PID：2088102642669732<br/>MD5：vas73sltf21q19wv7yltvtsa2612liix',{icon:6,title: '提示'});return;
        layer_show(title, url, w, h);
    }
    /*支付方式-删除*/
    function pay_del(obj, id) {
        //阻断，暂未实现
        parent.layer.alert('尚未实现...',{icon:6,title: '提示'});return;
        //检查当前支付方式是否允许删除
        var loadIndex = parent.layer.load(1, {
            shade: [0.5,'#333'] //0.5透明度的灰色背景
        });
        //发起判断请求
        $.ajax({
            url: '<?php echo U("checkRoleStatus");?>',
            pay: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                //判断
                if(data.count == '0'){
                    //允许删除
                    parent.layer.confirm('确认要删除吗？',{icon:3,title:'操作确认'},function(index) {
                        $.ajax({
                            pay: 'POST',
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

    /*支付方式-编辑*/
    function pay_edit(title, id, w, h) {
        //阻断，暂未实现
        parent.layer.alert('尚未实现...',{icon:6,title: '提示'});return;
    	var url = "<?php echo U('edit',['id' => '__ID__']);?>";
    	url = url.replace('__ID__',id);
    	layer_show(title,url,w,h);
    }

    //jQuery页面载入事件
    $(function(){
    	//datatables初始化
    	$('table').dataTable({
    		"columnDefs": [ { "sortable": false, "targets": [7] }],
    		"sorting": [[ 0, "asc" ]]
    	});
    });
    </script>
</body>

</html>