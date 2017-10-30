<?php
return array(
	//'配置项'=>'配置值'
	
	/* 模版替换字符串 */
	'TMPL_PARSE_STRING'		=>	[
			'__HOME__'	=>	'/Statics/Home',
			'__ADMIN__'	=>	'/Statics/Admin',
			'__LIB__'	=>	'/Statics/Lib',
			'__SDK__'	=>	'/Statics/Sdk',
	],

	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'travel',          // 数据库名
    'DB_USER'               =>  'test01',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

    /* 设置默认URL模式 */
    'URL_MODEL'	=>	'0',

    /* 前后台密码的盐 */
    'H_SALT'	=>	'6F262E6C32C7739CA1B9D68C8745944B',
    'A_SALT'	=>	'efa0d827771f5f9849b39002b2bde54d',

    /* 修改模版引擎左右标记 */
    'TMPL_L_DELIM'	=>	'{{',
    'TMPL_R_DELIM'	=>	'}}',
);