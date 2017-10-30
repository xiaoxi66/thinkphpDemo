<?php

namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{

	//自动验证 - 批量验证开启
	protected $patchValidate = true;
	//定义静态验证规则
	protected $_validate = [
		//角色名称，任何时候不能为空，2~10个字符
		['role_name','require','角色名称不能为空'],
		['role_name','2,10','角色名称必须是2~10个字符',1,'length']
	];

	//对于添/编辑加角色时候的信息处理
	public function saveRole($post,$opt = 'add'){
		if(count($post['auth_id'])){
			//权限id集合的处理
			$data['auth_id'] = implode(',', $post['auth_id']);
			//获取状态
			$data['status'] = (int) $post['status'];
			//拼凑控制器@方法集合
			$tmp = '';
			//查询全部范围在id集合中并且不为顶级权限的信息集合
			$auths = M('Auth') -> where(['id' => ['in',$data['auth_id']],'pid' => ['neq','0']]) -> select();
			foreach ($auths as $key => $value) {
				$tmp .= $value['controller'] . '@' . $value['action'] . ',';
			}
			$data['auth'] = rtrim($tmp,',');
		}
		//接收其他需要处理的数据
		$data['role_name'] = $post['role_name'];
		$data['desc'] = $post['desc'];
		//执行具体的操作
		if($opt == 'add'){
			$data['created_at'] = $post['created_at'];
			return $this -> add($data);
		}else{
			$id = (int) I('get.id');
			return $this -> where(['id' => $id]) -> save($data);
		}
	}
}