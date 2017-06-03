<?php 
require_once 'config/config.php';


/*添加新的标签*/
if(isset($_POST['labelAdd'])){
	$db->insert('book_label',['label'=>$_POST['labelAdd']]);
	$db_id = $db->insert_id();
	$db_label=$db->fetch($db->query("SELECT * FROM `book_label` WHERE `id`='$db_id'"))[0];
	print_r($db_label['label']);
}


/*添加新书*/


if(isset($_POST['valAdd'])){
	$data=[];
	$POST = json_decode($_POST['valAdd'],true);
	$name = safeHash($POST['name']);
	$author = safeHash($POST['author']);
	$ISBN = safeHash($POST['isbn']);
	$message = safeHash($POST['message']);
	$type=$POST['type'];
	$label_ex =  rtrim($POST['allLabel'],',');
	$data=['book'=>$name,'author'=>$author,'isbn'=>$ISBN,'label'=>$label_ex,'message'=>$message,'level'=>$type];
	$db->insert('book_list',$data);
	$_SESSION['face'] = $db->insert_id();
	if($db){
		print_r(1);
	}

}


/*上传书的封面（因前端数据的表单内容和图片数据拆分进行传输，所以要分步插入）*/
if(isset($_FILES['bookFace'])){
	$all = ['image/jpeg','image/pjpeg','image/gif','image/png'];
	$end = substr(strrchr($_FILES['bookFace']['name'], '.'), 1);
	$fileName ='source/img/'.md5(time().$_FILES['bookFace']['name']).'.'.$end;

	if(in_array($_FILES['bookFace']['type'],$all)){
		move_uploaded_file($_FILES['bookFace']['tmp_name'],$fileName);
	}
	$db->update('book_list',['book_face'=>$fileName],['id'=>$_SESSION['face']]);

}

/*获取图片*/
if(isset($_POST['bid'])){
	$id = safeHash($_POST['bid']);
	$userImg = $db->fetch($db->query("SELECT * FROM `book_list` WHERE `id` = '$id'"))[0];
	echo $userImg['book_face'];
}


/* 确认借阅 */
if(isset($_POST['bookBorrow'])){
	$borrowId = $_POST['bookBorrow'];
	$uid = $_SESSION['id'];
	$db->update('book_list',['level'=>0,'user_id'=>$uid],['id'=>$borrowId]);
	echo 1;
}


/*还书处理*/
if(isset($_POST['push'])){
	$pushId = $_POST['push'];
	$rsting = rtrim($pushId,',');
	$ex = explode(',',$rsting);
	foreach ($ex as $k => $v) {
		$db->update('book_list',['level'=>1,'user_id'=>0],['id'=>$v]);	
	}
	if($db){
		echo 1;
	}
}