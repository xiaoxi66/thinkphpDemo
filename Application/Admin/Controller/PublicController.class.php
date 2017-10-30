<?php

namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{

	/* 判断是否登录，已登录免除再次登录 */
	public function _initialize(){
		if(strtolower(ACTION_NAME) == 'login' && session('admin_userinfo')['id']){
			header("Location: " . U('Index/index'));exit;
		}
	}

	/* 展示后台登录页面视图 */
	public function login(){
		$this -> display();
	}

	/* 后台用户登录验证逻辑 */
	public function checkLogin(){
		//获取用户输入
		$data = I('post.');
		//验证验证码
		$rst = $this -> captcha($data);
		if(!$rst){
			//校验失败
			$response = [
				'code'		=>	'2',
				'message'	=>	'验证码校验失败！'
			];
			goto end;
		}
		//密码加密
		$condition['username'] = $data['username'];
		$condition['password'] = getPwdWithSalt($data['password'],'admin');
		$condition['status']	= '1';//附加要求状态正常
		//开始校验
		$result = M('Manager') -> where($condition) -> find();
		if($result){
			//更新登录时间和ip
			$tmp = ['id' => $result['id'],'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'],'last_login' => time()];
			M('Manager') -> save($tmp);
			//会话控制
			session('admin_userinfo',$result);
			//后台页面标题获取
			$title = M('Site') -> getField('back_name');
			session('back_name',$title);
			//校验成功
			$response = [
				'code'		=>	'0',
				'message'	=>	'登录成功！'
			];
		}else{
			//校验失败
			$response = [
				'code'		=>	'1',
				'message'	=>	'用户名或密码错误！'
			];
		}
		//ajax输出
		end:
		$this -> ajaxReturn($response);
	}

	/* 用户退出操作 */
	public function logout(){
		session(null);
		$url = U('login');echo $url;
		header("Location: .$url");
	}

	/* 验证码验证 */
	public function captcha($geetest){
		require_once './Statics/Sdk/geetest/lib/class.geetestlib.php';
		require_once './Statics/Sdk/geetest/config/config.php';
		$GtSdk = new \GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
		$data = array(
		        "user_id" => session('user_id'), # 网站用户id
		        "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
		        "ip_address" => $_SERVER['HTTP_X_FORWARDED_FOR'] # 请在此处传输用户请求验证时所携带的IP
		    );
		if ($_SESSION['gtserver'] == 1){   //服务器正常
		    $result = $GtSdk->success_validate($geetest['geetest_challenge'], $geetest['geetest_validate'], $geetest['geetest_seccode'], $data);
		    if($result){
		        return true;
		    }else{
		        return false;
		    }
		}else{  //服务器宕机,走failback模式
		    if($GtSdk->fail_validate($geetest['geetest_challenge'],$geetest['geetest_validate'],$geetest['geetest_seccode'])){
		        return true;
		    }else{
		        return false;
		    }
		}
	}

	/* 非法访问跳转 */
	public function forbbiden(){
		header("Location: " . U('login'));
	}
}