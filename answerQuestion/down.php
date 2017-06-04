<?php 
require_once 'config/config.php';
err([1,2]);
$id = $_GET['id'];
$f= $db->select('files',' WHERE `id` ='.$id.' ')[0];
$end= suffix($f['file_name']);
$name =time().'.'.$end;
download($name,$f['file_dir']);