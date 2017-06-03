<?php require_once 'config/config.php'; ?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>星阅</title>
	<link rel="stylesheet" href="source/css/index.css">
	<script src="source/js/jquery-2.1.3.min.js"></script>
	<script src="source/js/function.js"></script>
</head>
<body>
	<div class="top"><a href="login.php">登录</a><a href="logout.php"><?= isset($_SESSION['user'])?$_SESSION['user']:""; ?></a></div>
	<header class="wrap">
		<section class="main">
			<h1><a href="index.php">星阅</a></h1>
			<form method="get" action="search.php">
				<input type="text" name="search" required class="search" placeholder="书名、作者、ISBN">	
				<button type="submit" class="search_btn">Search</button>
			</form>
		</section>

	</header>
	