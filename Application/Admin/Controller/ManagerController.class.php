<?php

namespace Admin\Controller;
//use Think\Controller;
class ManagerController extends BaseController{

	/* 管理员列表 */
	public function userList(){
		//数据分页
		$data = M('Manager') -> alias('t1') -> field('t1.*,t2.role_name') -> where(['t1.status' => ['neq','3']]) -> join('left join __ROLE__ as t2 on t1.role_id = t2.id') -> select();
		$this -> assign('data',$data);
		$this -> display('admin-list');
	}

	/* 管理员状态开关 */
	public function swStatus(){
		//接收数据
		$data = I('post.');
		if(IS_AJAX && (int) $data['id'] != session('admin_userinfo')['id']){		
			$rst = M('Manager') -> save($data);
			echo $rst;
		}else{
			echo '0';
		}
	}

	/* 管理员删除操作（逻辑删除）*/
	public function del(){
		//获取用户id
		$id = (int) I('post.id');
		if(IS_AJAX && $id != session('admin_userinfo')['id']){
			$rst = M('Manager') -> save(['id' => $id,'status' => '3']);
			if($rst){
				$response = [
					'code'	=>	'0'
				];
			}else{
				$response = [
					'code'		=>	'1',
					'message'	=>	'删除管理员失败！'
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

	/* 管理员信息编辑（二合一操作方法） */
	public function edit(){
		//判断当前的请求类型
		if(IS_POST){

		}else{
			//获取原始数据，展示视图
			$id = (int) I('get.id');
			$data = M('Manager') -> find($id);
			$this -> assign('data',$data);
			$this -> display('admin-edit');
		}
	}
}