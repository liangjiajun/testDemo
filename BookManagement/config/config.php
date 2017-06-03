<?php 
require_once 'inc/db.php';
require_once 'inc/function.php';
session_start();
date_default_timezone_set("PRC");
$config=[
	'user'=>'root',
	'password'=>'',
	'database'=>'star',
];
$db=new db;