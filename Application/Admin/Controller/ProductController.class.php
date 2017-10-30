<?php
namespace Admin\Controller;
//use Admin\Controller\BaseController;
class ProductController extends BaseController{

	/* 产品列表 */
	public function productList(){
		
		$this -> display();
	}

	/* 添加产品 */
	public function addProduct(){
		//判断请求类型
		if(IS_POST){
			//接收数据
			$post = I('post.');
			$post['add_at']	= time();
			$post['start_at'] = strtotime($post['start_at']);
			$post['end_at'] = strtotime($post['end_at']);
			//写入
			$result = M('Product') -> add($post);
			echo $result; 
		}else{
			//获取产品类型
			$dataType = M('Type') -> select();
			$this -> assign('dataType',$dataType);
			$this -> display('product-add');
		}
	}
}