<?php 
session_start();
date_default_timezone_set('PRC');
error_reporting(0);
require_once 'inc/db.php';
require_once 'inc/fun.php';
$config =[
	'user'=>'root',
	'pass'=>'',
	'dbsn'=>'ws01',
];

$db=new db;