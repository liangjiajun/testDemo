<?php require_once 'inc/nav.php'; 

if(isset($_POST['sub'])){
     $pass = $_POST['password'];
     $nick = $_POST['nickname'];
     $user = $_POST['username'];
     $phone = $_POST['phone'];
     $role = $_POST['role'];
     $err = [];
     $right='';
     $u = $db->select('users',' WHERE `username` = "'.$user.'"');
     if(!empty($u)){$err['email'] = '用户已注册';}
     $e ='/^[0-9a-z]+@(([0-9a-z]+)[.])+[a-z]{2,3}/';
     $i ='/^\d{11}/';
     $n = '/[a-z]+$/i';
     $p = '/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/';
     if(!preg_match($e, $user)){$err['email']='请输入正确的邮箱格式';}
     if(!preg_match($i, $phone)){$err['phone']='电话应为11位数字';}
     if(!preg_match($n, $nick)){$err['nick']='昵称应由英文字母组成';}
     if(!preg_match($p, $pass)){$err['pass']='用户密码必须大于等于8个字符，由大小写字母和数字组成';}
     $tmp= array_count_values(str_split($pass));
     if(max($tmp)>1){$err['pass']='用户密码不能出现重复字符';}
     if(empty($err)){
          $db->insert('users',['username'=>$user,'nickname'=>$nick,'password'=>md5($pass),'phone'=>$phone,'role'=>$role,'verify'=>0,'face'=>'']);
          $right.='注册成功';
     }
}

?>
          <div class="main">
          	<h3>用户注册</h3>
          	<form method="post" class="data">
                    <label><span>邮箱</span><input type="email" required name="username"></label>   
                    <p class="err tip"><?=isset($err['email'])?$err['email']:'';?></p> 
                    <label><span>昵称</span><input type="text" required name="nickname"></label>   
                    <p class="err tip"><?=isset($err['nick'])?$err['nick']:'';?></p> 
                    <label><span>密码</span><input type="password" required name="password"></label>   
                    <p class="err tip"><?=isset($err['pass'])?$err['pass']:'';?></p> 
                    <label><span>电话</span><input type="number" required name="phone"></label>   
                    <p class="err tip"><?=isset($err['phone'])?$err['phone']:'';?></p> 
                    <label><span>身份</span>
                        <select name="role">
                             <option value="2">教师</option>
                             <option value="1">学生</option>
                        </select> 
                    </label>   
                    <button type="submit" name="sub">注册</button>
                    <p class="right tip"><?=isset($right)?$right:'';?></p> 
               </form>
          </div>
</body>
</html>