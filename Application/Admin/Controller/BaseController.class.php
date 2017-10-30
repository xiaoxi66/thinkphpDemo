<?php


//控制器三部曲
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{

	/* 控制器初始化 */
	public function _initialize(){
		//如果用户没有登录，则跳转到登录
		if(!session('admin_userinfo')['id']){
			header("Location: " . U('Public/login'));exit;
		}
		//开始RBAC权限判断
		if(session('admin_userinfo')['role_id'] > 1){
			//获得权限
			$auth = M('Role') -> where(['id' => session('admin_userinfo')['role_id']]) -> getField('auth');
			//获取当前访问路由
			$curr = strtolower(CONTROLLER_NAME . '@' . ACTION_NAME);
			//权限比较
			if(strpos(strtolower($auth),$curr) === false){
				//重定向到跳转页面
				header("Location: " . U('Public/forbbiden'));exit;
			}
		}
	}
}