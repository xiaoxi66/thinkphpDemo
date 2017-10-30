<?php
namespace Admin\Controller;
//use Think\Controller;【可选】
class IndexController extends BaseController{

	/* 后台首页 */
	public function index(){
		if(session('admin_userinfo')['role_id'] > '1'){
			//获取权限集合
			$role = M('role') -> find(session('admin_userinfo')['role_id']);
			//动态读取菜单
			$top  = M('Auth') -> where(['pid' => '0','is_nav' => '1','id' => ['in',$role['auth_id']]]) -> select();
			$cate = M('Auth') -> where(['pid' => ['neq','0'],'is_nav' => '1','id' => ['in',$role['auth_id']]]) -> select();
		}else{
			$top  = M('Auth') -> where(['pid' => '0','is_nav' => '1']) -> select();
			$cate = M('Auth') -> where(['pid' => ['neq','0'],'is_nav' => '1']) -> select();
		}
		//组合子菜单url地址
		foreach ($cate as $key => $value) {
			$cate[$key]['url'] = U("{$value['controller']}/{$value['action']}");
		}
		//变量分配
		$this -> assign('top',$top);
		$this -> assign('cate',$cate);
		$this -> display();
	}

	/* 后台框架页面【可选】 */
	public function welcome(){
		$this -> display();
	}
}
