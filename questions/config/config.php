<?php 
/*默认配置*/

session_start();
date_default_timezone_set('PRC');
// error_reporting(0);



/*默认载入文件*/
function inc($dir='./inc/'){
    $name = array_slice(scandir($dir), 2);
    foreach ($name as $v) {
        include_once $dir.$v;
    }
}
inc();


/*数据库配置*/
$config=[
	'user'=>'root',
	'pass'=>'',
	'dbsn'=>'star',
];
