<?php require_once 'config/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="sourcus/css/index.css">
</head>
<body>
          <header>
              <h1>在线学习系统</h1>
              <nav>
                  <ul>
                      <li><a href="index.php">学习模块</a></li>
                      <li><a href="json.php">json数据</a></li>
                      <li><a href="test.php">题库测试</a></li>
                      <?php if(check([2])){ ?>
                      <li><a href="exam.php">导入题库</a></li>
                      <li><a href="export.php">导出题库</a></li>
                      <li><a href="trun.php" onclick="return confirm('确定清空')">清空题库</a></li>
                      <?php }if(check([1,2])){ ?>
                      <li><a href="score.php">查看成绩</a></li>
                      <?php }if(check([3])){  ?>
                      <li><a href="check.php">审核用户</a></li>
                      <?php } ?>
                  </ul>
              </nav>
              <ul>
              <?php if(guest()){ ?>
                  <li><a href="login.php">登录</a></li>
                  <li><a href="reg.php">注册</a></li>
              <?php }else{ if($_SESSION['user']['role']==3){?>
                  <li>管理员：<a><?=$_SESSION['user']['nickname']?></a></li>
              <?php }if($_SESSION['user']['role']==2){ ?>
                  <li>教师：<a><?=$_SESSION['user']['nickname']?></a></li>
              <?php }if($_SESSION['user']['role']==1){ ?>
                  <li>学生：<a><?=$_SESSION['user']['nickname']?></a></li>
              <?php } ?>
                  <li><a href="face.php"><?=!empty($_SESSION['user']['face'])?'<img src="'.$_SESSION['user']['face'].'">':'上传头像';?></a></li>
                  <li><a href="logout.php">注销</a></li>
              <?php } ?>
              </ul>
          </header>