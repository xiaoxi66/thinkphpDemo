<?php

namespace Admin\Controller;
//use Admin\Controller\BaseController;
class PayController extends BaseController{

	/* 支付方式列表 */
	public function payList(){
		//获取列表
		$data = M('Pay') -> select();
		$this -> assign('data',$data);
		$this -> display('pay-list');
	}

	/* 后续的增删改功能可以参考其他模块继续自行完成 */
	//...
}