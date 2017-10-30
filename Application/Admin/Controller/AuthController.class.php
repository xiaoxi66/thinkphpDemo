<?php


//控制器三部曲
namespace Admin\Controller;
//use Admin\Controller\BaseController;
class AuthController extends BaseController{

	/* 权限列表 */
	public function authList(){
		//查询现有分类
		$auth = M('Auth') -> where(['pid' => '0']) ->  select();
		//获取当前列表数据
		$data = M('Auth') -> alias('t1') -> field('t1.*,t2.auth_name as parent_name') -> join('left join __AUTH__ as t2 on t1.pid = t2.id') -> select();
		//获取全部控制器名
		$controller_path = MODULE_PATH . 'Controller/';
		$controllers = getControllerSet($controller_path);
		//变量分配
		$this -> assign('auth',$auth);
		$this -> assign('data',getTree($data));
		$this -> assign('controllers',$controllers);
		$this -> display('auth-list');
	}

	/* 添加权限 */
	public function add(){
		//判断是否是合法的ajax请求
		if(IS_AJAX){
			//实例化自定义模型，使批量验证生效
			$model = D('Auth');
			//新增记录时动态自动完成规则
			$_auto = [
				['created_at','time',1,'function']
			];
			//使用动态验证规则建立数据对象
			$data = $model -> setProperty('_auto',$_auto) -> create();
			//数据对象创建成功，执行数据写入操作
			if($data){
				//写入数据
				$result = $model -> add();
				if($result){
					$response = [
						'code'		=>	'0',
						'message'	=>	'权限添加成功！'
					];
				}else{
					$response = [
						'code'		=>	'1',
						'message'	=>	'权限添加失败！'
					];
				}
			}else{
				//数据对象创建失败，输出验证失败信息
				$response = [
					'code'		=>	'2',
					'message'	=>	$model -> getError()
				];
			}
		}else{
			//非AJAX请求类型，不予处理
			$response = [
				'code' 		=>	'3',
				'message'	=>	'非法的请求。'
			];
		}
		//输出ajax所需返回值
		$this -> ajaxReturn($response);
	}

	/* 编辑权限 */
	public function edit(){
		//初始化
		$id = (int) I('get.id');
		$model = M('Auth');
		//判断请求类型
		if(IS_AJAX && IS_POST){
			//实例化自定义模型，使批量验证生效
			$model = D('Auth');
			//使用动态验证规则建立数据对象
			$data = $model -> create(I('post.'),2);
			//数据对象创建成功，执行数据更新操作
			if($data){
				//写入数据
				$result = $model -> where(['id' => $id]) -> save();
				if($result){
					$response = [
						'code'		=>	'0',
						'message'	=>	'权限编辑成功！'
					];
				}else{
					$response = [
						'code'		=>	'1',
						'message'	=>	'权限更新失败！'
					];
				}
			}else{
				//数据对象创建失败，输出验证失败信息
				$response = [
					'code'		=>	'2',
					'message'	=>	$model -> getError()
				];
			}
			//输出ajax所需返回值
			$this -> ajaxReturn($response);
		}else{
			//根据权限id获取原始信息
			$data = $model -> find($id);
			//获取全部的顶级权限备选
			$parents = $model -> where(['pid' => '0']) -> select();
			//获取全部控制器名
			$controller_path = MODULE_PATH . 'Controller/';
			$controllers = getControllerSet($controller_path);
			//变量分配
			$this -> assign('data',$data);
			$this -> assign('parents',$parents);
			$this -> assign('controllers',$controllers);
			$this -> display('auth-edit');
		}
	}

	/* 删除权限（物理删除） */
	public function del(){
		//获取权限id
		$id = (int) I('post.id');
		$is_parent = $this -> getAuthType(true); //0则是顶级，否则不是
		if(IS_AJAX){
			if($is_parent == '0'){
				$condition = [
					'id'	=>	$id,
					'pid'	=>	$id,
					'_logic'=>	'OR'
				];
			}else{
				$condition = ['id' => $id];
			}
			$rst = M('Auth') -> where($condition) -> delete();
			if($rst){
				$response = [
					'code'	=>	'0',
					'count'=>	$rst
				];
			}else{
				$response = [
					'code'		=>	'1',
					'message'	=>	'删除权限失败！'
				];
			}
		}else{
			$response = [
				'code'		=>	'2',
				'message'	=>	'非法请求！'
			];
		}
		//输出json
		$this -> ajaxReturn($response);
	}

	/* 状态切换 */
	public function swStatus(){
		//判断请求类型
		if(IS_AJAX){
			$post = I('post.');
			//组合条件，或运算
			$condition = [
				'id'	=>	$post['id'],
				'pid'	=>	$post['id'],
				'_logic'=>	'OR'
			];
			//更新权限状态
			$result = M('Auth') -> where($condition) -> save(['status' => $post['status']]);
			echo $result;
		}
	}

	/* 根据状态获取提示文字 */
	public function getAuthType($private = false){
		//判断请求类型
		if(IS_AJAX || $private){
			//根据权限id获取其对应的父级id
			$id = (int) I('post.id');
			$pid = M('Auth') -> where(['id' => $id]) -> getField('pid');
			if($private){
				return $pid;
			}else{
				echo $pid;
			}
		}
	}

	/* 根据控制器名称返回控制器中对应的方法名称 */
	public function getActionNames(){
		//不予受理非ajax请求
		if(IS_AJAX){
			$controller_name = I('post.controller_name');
			//判断文件是否合法
			if(is_file(MODULE_PATH . 'Controller/' . $controller_name . 'Controller.class.php')){
				$controller = A($controller_name);
				$funs = get_class_methods($controller);
				//需要排除的部分父类或基类方法
				$inherents_functions = [
					'_initialize','__construct','getActionName','isAjax','display','show',
					'fetch','buildHtml','assign','__set','get','__get','__isset','__call',
					'error','success','ajaxReturn','redirect','__destruct','_empty','verify',
					'validateUser','createSn','getpage','json','xml','xmlTo','theme'
				];
				//开始剔除
				foreach ($funs as $func){
					if(!in_array($func, $inherents_functions)){
						$customer_functions[] = $func;
					}
				}
				$response = [
					'code'		=>	'0',
					'message'	=>	$customer_functions
				];
			}else{
				$response = [
					'code'		=>	'1',
					'message'	=>	'当前分组下不存在此控制器！'
				];
			}
		}else{
			$response = [
				'code'		=>	'2',
				'message'	=>	'非法的请求！'
			];
		}
		//ajax输出
		$this -> ajaxReturn($response);
	}
}