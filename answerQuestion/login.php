<?php require_once 'inc/nav.php'; 

if(isset($_POST['sub'])){
     $pass = $_POST['password'];
     $user = $_POST['nickname'];
     $err = '';
     $right='';
     $u = $db->select('users',' WHERE `username` = "'.$user.'" AND `password`="'.md5($pass).'"');
    if(!empty($u)){
          if($u[0]['verify']==1){
               $_SESSION['user'] = $u[0];
               jump('index.php');
          }else{
               $err.='用户名未通过审核';
          }
    }else{
          $err.='用户名或密码错误';
    }
}

?>
          <div class="main">
          	<h3>用户登录</h3>
          	<form method="post" class="data">
                    <label><span>用户</span><input type="text" required name="nickname"></label>   
                    <label><span>密码</span><input type="password" required name="password"></label>     
                    <button type="submit" name="sub">登录</button>
                    <p class="err tip"><?=isset($err)?$err:'';?></p> 
                    <p class="right tip"><?=isset($right)?$right:'';?></p> 
               </form>
          </div>
</body>
</html>