<?php

namespace Admin\Controller;
//use Admin\Controller\BaseController;
class RoleController extends BaseController{

	/* 角色列表 */
	public function roleList(){
		//查询角色信息
		$data = M('Role') -> select();
		$this -> assign('data',$data);
		$this -> display('role-list');
	}

	/* 角色添加操作（二合一） */
	public function add(){
		//判断当前的请求类型
		if(IS_POST){
			//新增时，自动完成规则
			$_auto = [
				['created_at','time',1,'function']
			];
			//创建数据对象
			$model = D('Role');
			$data = $model -> setProperty('_auto',$_auto) -> create();
			//判断对象创建结果
			if($data){
				//由自定义模型处理并写入数据
				$result = $model -> saveRole($data);
				if($result){
					$response = [
						'code'		=>	'0',
						'message'	=>	'角色添加成功！'
					];
				}else{
					$response = [
						'code'		=>	'1',
						'message'	=>	'角色添加失败！'
					];
				}
			}else{
				//数据对象创建失败，输出验证失败信息
				$response = [
					'code'		=>	'2',
					'message'	=>	$model -> getError()
				];
			}
			//输出ajax返回
			$this -> ajaxReturn($response);
		}else{
			//获取权限信息，分层获取
			$authModel = M('Auth');
			$top  = $authModel -> where(['pid' => '0']) -> select();
			$cate = $authModel -> where(['pid' => ['gt','0']]) -> select();
			//变量分配
			$this -> assign('top',$top);
			$this -> assign('cate',$cate);
			$this -> display('role-add');
		}
	}

	/* 角色编辑操作 */
	public function edit(){
		//判断当前的请求类型
		if(IS_POST){
			//创建数据对象
			$model = D('Role');
			$data = $model -> create();
			//判断对象创建结果
			if($data){
				//由自定义模型处理并写入数据
				$result = $model -> saveRole($data,'save');
				if($result){
					$response = [
						'code'		=>	'0',
						'message'	=>	'角色编辑成功！'
					];
				}else{
					$response = [
						'code'		=>	'1',
						'message'	=>	'角色编辑失败！'
					];
				}
			}else{
				//数据对象创建失败，输出验证失败信息
				$response = [
					'code'		=>	'2',
					'message'	=>	$model -> getError()
				];
			}
			//输出ajax返回
			$this -> ajaxReturn($response);
		}else{
			//获取权限信息，分层获取
			$authModel = M('Auth');
			$top  = $authModel -> where(['pid' => '0']) -> select();
			$cate = $authModel -> where(['pid' => ['gt','0']]) -> select();
			//获取角色原有信息
			$data = M('Role') -> find((int) I('get.id')); 
			//变量分配
			$this -> assign('top',$top);
			$this -> assign('cate',$cate);
			$this -> assign('data',$data);
			$this -> display('role-edit');
		}
	}

	/* 删除角色操作 */
	public function del(){
		//获取权限id
		$id = (int) I('post.id');
		if(IS_AJAX && IS_POST){
			$count = M('Manager') -> where(['role_id' => $id]) -> count();
			if(!$count){
				//可以删除角色
				$rst = M('Role') -> delete($id);
				if($rst){
					$response = [
						'code'		=>	'0',
						'message'	=>	'角色删除成功！'
					];
				}else{
					$response = [
						'code'		=>	'1',
						'message'	=>	'角色删除失败！'
					];
				}
			}else{
				$response = [
					'code'		=>	'3',
					'count'		=>	$count,
					'message'	=>	'当前角色正在被某些管理员帐号使用，因此不允许被删除！'
				];
			}
		}else{
			$response = [
				'code'		=>	'2',
				'message'	=>	'非法请求！'
			];
		}
		//输出json
		$this -> ajaxReturn($response);
	}

	/* 删除角色时判断是否允许删除 */
	public function checkRoleStatus(){
		//判断请求类型
		if(IS_AJAX && IS_POST){
			$id = (int) I('post.id');
			//判断当前管理员表中是否有用户使用当前角色
			$count = M('Manager') -> where(['role_id' => $id]) -> count();
			//组装响应
			$response = [
				'code'		=>	'0',
				'count'		=>	$count,
				'message'	=>	'当前角色正在被某些管理员帐号使用，因此不允许被删除！'
			];
		}else{
			$response = [
				'code'	=>	'1',
				'message'	=>	'非法的请求！'
			];
		}
		//ajax输出
		$this -> ajaxReturn($response);
	}

	/* 状态切换 */
	public function swStatus(){
		//判断请求类型
		if(IS_AJAX){
			$post = I('post.');
			//更新权限状态
			$result = M('Role') -> where(['id' => $post['id']]) -> save(['status' => $post['status']]);
			echo $result;
		}
	}
}