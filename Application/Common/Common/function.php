<?php
/**
 * @Author 黑马程序员-传智播客旗下高端教育品牌 [itcast.cn]
 * @Date    2017-09-29 14:49:25
 * @Version 1.0.0
 * @Description 应用函数库文件
 * ━━━━━━神兽出没━━━━━━
 * 　　   ┏┓　 ┏┓
 * 　┏━━━━┛┻━━━┛┻━━━┓
 * 　┃              ┃
 * 　┃       ━　    ┃
 * 　┃　  ┳┛ 　┗┳   ┃
 * 　┃              ┃
 * 　┃       ┻　    ┃
 * 　┃              ┃
 * 　┗━━━┓      ┏━━━┛ Code is far away from bugs with the animal protecting.
 *       ┃      ┃     神兽保佑,代码无bug。
 *       ┃      ┃
 *       ┃      ┗━━━┓
 *       ┃      　　┣┓
 *       ┃      　　┏┛
 *       ┗━┓┓┏━━┳┓┏━┛
 *     　  ┃┫┫　┃┫┫
 *     　  ┗┻┛　┗┻┛
 *
 * ━━━━━━感觉萌萌哒━━━━━━
 */

/**
 * @Author   Y
 * @DateTime 2017-09-29
 * @param    string     $password 原始明文密码
 * @param    string     $flag     前后台标记，admin/home
 * @return   string               加密后密码
 */
function getPwdWithSalt($password,$flag){
	$salt = $flag == 'admin' ? C('A_SALT') : C('H_SALT');
	$key = substr(sha1($salt),10,11);
	$pwd = substr(sha1($password),11,10);
	return sha1($key . $pwd);
}

/**
 * @Author   Y
 * @DateTime 2017-10-02
 * @param    string     $ip ipv4地址
 * @return   string         物理地址
 */
function getAddrByIpv4($ip){
	$ipLoc = new \Org\Net\IpLocation('qqwry.dat');
	$data = array_iconv($ipLoc -> getlocation($ip));
	return "{$data['country']} {$data['area']}";
}

/**
 * @Author   Y
 * @DateTime 2017-10-02
 * @param    array     $data        需要转码的数组
 * @param    string     $in_charset  输入字符集
 * @param    string     $out_charset 输出字符集
 * @return   array     $output       转码后的数组
 */
function array_iconv($data, $in_charset='GBK', $out_charset='UTF-8'){
	if (!is_array($data)){
		$output = iconv($in_charset, $out_charset, $data);
	}elseif(count($data) === count($data, 1)){//判断是否是二维数组
		foreach($data as $key => $value){
		  	$output[$key] = iconv($in_charset, $out_charset, $value);
		}
	}else{
		eval_r('$output = '.iconv($in_charset, $out_charset, var_export($data, TRUE)).';');
	}
	return $output;
}

/**
 * @Author   Y
 * @DateTime 2017-10-02
 * @param    int     $status 是或否对应的数字
 * @return   string             对应值
 */
function getStatus($status){
	return $status == '1' ? '是' : '否'; 
}

/**
 * @Author   Y
 * @DateTime 2017-10-03
 * @param    array     $list  进行无限级分类的数组
 * @param    integer    $pid   父级id
 * @param    integer    $level 层级
 * @return   array            分类之后的数组
 */
function getTree($list,$pid=0,$level=0) {
	static $tree = array();
	foreach($list as $row) {
		if($row['pid']==$pid) {
			$row['level'] = $level;
			$tree[] = $row;
			getTree($list, $row['id'], $level + 1);
		}
	}
	return $tree;
}

/**
 * @Author   Y
 * @DateTime 2017-10-03
 * @param    string     $dir 一个有效的控制器文件所在目录
 * @return   array          控制器名的数组组合
 */
function getControllerSet($dir){
	if(is_dir($dir)){
		$all = [];
		$files = scandir($dir);
		if(count($files) > 2){
			foreach ($files as $key => $value) {
				if($value == '.' || $value == '..'){
					continue;
				}
				$all[] = str_replace('Controller.class.php', '', $value);
			}
			return $all;
		}
	}else{
		throw new Exception("$dir不是一个有效的目录");
	}
}