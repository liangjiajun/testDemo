<?php
include('config/config.php');

$c = isset($_GET['c']) ? $_GET['c'] : 'home';
$f = isset($_GET['f']) ? $_GET['f'] : 'index';
function __autoload($classname){
	$dir = explode('_',$classname);
	if($dir[0] == 'model' || $dir[0] == 'controller'){
		require_once($dir[0].'/'.$dir[1].'.php');
	}
}

$controller_name = 'controller_'.$c;
$controller = new $controller_name;
$controller->$f();

