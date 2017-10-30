<?php

namespace Admin\Model;
use Think\Model;
class AuthModel extends Model{

	//自动验证 - 批量验证开启
	protected $patchValidate = true;
	//定义静态验证规则
	protected $_validate = [
				//上级分类，必须验证，不能为空，必须是数字
				['pid','require','上级分类不能为空！',1],
				['pid','number','非法的上级分类形式！',1],
				//权限名称，必须验证，不能为空，全局唯一，2~10字符
				['auth_name','require','权限名称不能为空！',1],
				['auth_name','','权限名称必须全局唯一！',1,'unique',1],
				['auth_name','2,10','权限名称长度必须是2~10个字符！',1,'length'],
				//控制器名，存在即验证，不能为空，2~30个字符
				['controller','require','控制器名称不能为空！'],
				['controller','2,30','控制器名称必须是2~30个字符！',0,'length'],
				//方法名称，存在即验证，不能为空，2~30个字符
				['action','require','方法名称不能为空！'],
				['action','2,30','方法名称必须是2~30个字符！',0,'length'],
				//作为导航，必须验证，必须存在，必须是数字
				['is_nav','require','是否作为导航选项必选一项！',1],
				['is_nav','number','非法的导航标记选项形式！',1],
			];
}