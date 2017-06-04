<?php 
function jump($u)
{
	// echo "<script>location='$u';</script>";
	header('location:'.$u.'');
}
function guest()
{
	if(isset($_SESSION['user'])){
		return false;
	}else{
		return true;
	}
}
function check($d)
{
	if(isset($_SESSION['user']['role']) && in_array($_SESSION['user']['role'], $d)){
		return true;
	}else{
		return false;
	}
}
function err($d)
{
	if(!check($d)){
		jump('err.php');
		exit();
	}
}
function suffix($d)
{
	$f = explode('.', $d);
	return strtolower(end($f));
}
function csv($name,$data)
{
	header('Content-type:text/csv;charset:utf-8');
	header('Content-Disposition:attchment;filename='.$name);
	echo $data;
}

function download($name,$path)
{
	$file = fopen($path, "r");
	header('Content-type:application/octet-stream');
	header('Content-Disposition:attchment;filename='.$name);
	echo fread($file, filesize($path));
	exit();
}


