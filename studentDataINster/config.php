<?php 
session_start();
date_default_timezone_set('PRC');

$db = mysql_connect('localhost','root','');
mysql_select_db('database_name');
mysql_query('set names utf8',$db);

function post($param=NULL){
	return trim($_POST[$param]); 
}
function jump($u)
{
	header('location:'.$u);
}
