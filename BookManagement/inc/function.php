<?php 

	/*敏感字符处理*/
	function safeHash($data){
		return addslashes(strip_tags($data));
	}


	/*页面跳转*/
	function jump($url){
		echo "<script>location='$url';</script>";
	}

	/*检查用户是否登陆*/
	function is_guest(){
		if(isset($_SESSION['user'])){
			return false;
		}else{
			return true;
		}
	}
	/*检查权限问题*/
	function check($id){
		if(isset($_SESSION['role']) && in_array($_SESSION['role'],$id)){
			return true;
		}else{
			return false;
		} 
	}


