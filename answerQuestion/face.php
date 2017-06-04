<?php require_once 'inc/nav.php'; 
err([1,2,3]);
     if(isset($_POST['sub'])){
          $file = $_FILES['file'];
          $err='';
          $end = suffix($file['name']);
          $all=['jpg','jpeg'];
          $id = $_SESSION['user']['id'];
          $path = 'uploads/user/'.$id.'.'.$end;
          if(in_array($end, $all)){
               $create = imagecreatetruecolor(200, 200);
               $img = imagecreatefromstring(file_get_contents($file['tmp_name']));
               $font = 'sourcus/font/msyh.ttf';
               $black=imagecolorallocate($create, 255, 0, 0);
               list($w,$h) = getimagesize($file['tmp_name']);
               imagecopyresized($create, $img, 0, 0, 0, 0, 200, 200, $w, $h);
               imagefttext($create, 20, 0, 0, 20, $black, $font, 'Online learning');
               imagejpeg($create,$path,100);
               $db->update('users',['face'=>$path],['id'=>$id]);
               $_SESSION['user'] = $db->select('users',' WHERE `id` ='.$id.' ')[0];
               jump('index.php');
          }else{
               $err.='文件格式不正确';
          }
     }
?>
          <div class="main">
          	<h3>上传头像</h3>
          	<form method="post" enctype="multipart/form-data">
                    <input type="file" name="file" required>
                    <button type="submit" name="sub">上传头像</button>    
                    <p class="err tip"><?=isset($err)?$err:'';?></p> 
               </form>
          </div>
</body>
</html>