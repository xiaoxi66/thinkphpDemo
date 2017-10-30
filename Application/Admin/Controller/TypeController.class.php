<?php

namespace Admin\Controller;
//use Admin\Controller\BaseController;
class TypeController extends BaseController{

	/* 产品分类列表 */
	public function typeList(){
		//获取分类列表
		$data = M('Type') -> select();
		$this -> assign('data',$data);
		$this -> display('type-list');
	}

	/* 后续的增删改功能可以参考其他模块继续自行完成 */
	//...
}