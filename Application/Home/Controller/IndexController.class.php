<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

	/**
	 * @Author   Y
	 * @DateTime 2017-09-29
	 * @return   [type]     [description]
	 */
    public function index(){
        //展示首页视图
        $this -> display('travel-index');
    }

    /**
     * @Author   Y
     * @DateTime 2017-09-29
     * @return   [type]     [description]
     */
    public function travelIndex(){
    	//展示框架视图
    	$this -> display('travel-index');
    }
}