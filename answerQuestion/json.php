<?php 
require_once 'inc/nav.php';
header('Content-type:json;charset:utf-8');
$s = $db->select('scores',' ORDER BY `total` DESC');
$data = [];
foreach ($s as $k => $v) {
	$u = $db->select('users',' WHERE `id` ='.$v['uid'].' ')[0]['nickname'];
	$data[$k]['user']=$u;
	$data[$k]['times']=date('Y-m-d H:i:s',$v['times']);
	$data[$k]['total']=$v['total'];
}

echo json_encode($data);