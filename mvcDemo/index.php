<?php 
require_once 'controller/home.php';
$s = $_SERVER['REQUEST_URL'];
$p = explode('index.php',$s);
$pp = explode('/',$p[1]);
$c = isset($pp[1])?$pp[1]:'home';
$f = isset($pp[2])?$pp[2]:'index';


function __autoload($classname){
	$dir = explode('_',$classname);
	require_once ($dir[0].'/'.$dir[1].'.php');
}

$controller_name = 'controller_'.$c;
$controller = new $controller_name;
$controller->$f();


 ?>