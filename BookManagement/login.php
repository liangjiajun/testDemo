<?php require_once 'header.php'; 
	if(isset($_POST['user'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$user = $db->fetch($db->query("SELECT * FROM `users` WHERE `username` = '$user'"))[0];
		$_SESSION['user'] =$user['username']; 
		$_SESSION['id'] = $user['id'];
		$_SESSION['role'] = $user['role'];
		jump('index.php');
	}


?>
<form method="post">
	<input type="text" name="user">
	<input type="text" name="pass">
	<button type="submit">login</button>
</form>