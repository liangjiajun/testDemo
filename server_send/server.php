<?php 
session_start();

if(isset($_POST['username'])){
	$_SESSION['username'] = $_POST['username'];
	header('location: chart.html');
}
if(isset($_POST['chart'])){
	$data = file_get_contents('chart.txt');
	//把整个文件读入一个字符串中;
	file_put_contents('chart.txt',$data.'<p class="'.$_SESSION['username'].'"><b>'.$_SESSION['username'].'</b><span>'.$_POST['chart'].'</span></p><br>');
	// 把一个字符串写入文件中
	header('location: chart.html');
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$data = array();
$data['chart'] = file_get_contents('chart.txt');
$data['name'] = $_SESSION['username'];
echo "data: ".json_encode($data)." \n\n";
flush();
?>