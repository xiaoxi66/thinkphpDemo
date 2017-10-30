<?php

namespace Admin\Controller;
//use Admin\Controller;
class SystemController extends BaseController{

	/* 站点基本信息设置 */
	public function siteInfo(){
		//判断请求类型
		if(IS_POST && IS_AJAX){
			//接收数据
			$data = I('post.');
			$rst = M('Site') -> where(['id' => '1']) -> save($data);
			if($rst){
				//返回组装
				$response = [
					'code'		=>	'0',
					'message'	=>	'站点信息更新成功！'
				];
			}else{
				//返回组装
				$response = [
					'code'		=>	'1',
					'message'	=>	'站点信息更新失败！'
				];
			}
			//ajax输出
			$this -> ajaxReturn($response);
		}else{
			//获取原始内容
			$data = M('Site') -> find();
			$this -> assign('data',$data);
			$this -> display();
		}
	}
}