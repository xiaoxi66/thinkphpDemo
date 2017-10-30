<?php
namespace Admin\Controller;
//use Admin\Controller\BaseController;
use Think\Upload;
use Think\Image;
class UploaderController extends BaseController{

	/* webuploader上传处理操作 */
	public function webuploader(){
		//判断是否有文件需要上传
		if($_FILES['file']['error'] == '0'){
			//定义上传需要的配置，如果需要可以继续配置...
			$cfg = [
				'rootPath'	=>	'./Statics/Uploads/'
			];
			//实例化并开始上传
			$upload = new Upload($cfg);
			$info = $upload -> uploadOne($_FILES['file']);
			//判断是否处理成功
			if($info){
				//拼凑地址
				$path = $upload -> rootPath . $info['savepath'] . $info['savename'];
				//制作缩略图
				$image = new Image();
				$thumb = $upload -> rootPath . $info['savepath'] . 'thumb_' . $info['savename'];
				$image -> open($path) -> thumb(430,270) -> save($thumb);
				$response = [
					'code'		=>	'0',
					'message'	=>	'文件上传成功！',
					'path'		=>	$path,
					'thumb'		=>	$upload -> rootPath . $info['savepath'] . 'thumb_' . $info['savename']
				];
			}else{
				$response = [
					'code'		=>	'1',
					'message'	=>	$upload -> getError()
				];
			}
			//ajax输出
			$this -> ajaxReturn($response);
		}
	}
}