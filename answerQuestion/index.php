<?php require_once 'inc/nav.php'; 
if(isset($_POST['sub'])){
err([2]);
     $file = $_FILES['file'];
     $err='';
     $end = suffix($file['name']);
     $all=['jpg','jpeg','doc','docx','pdf','ppt','pptx','mp4'];
     $id = $_SESSION['user']['id'];
     $path = 'uploads/'.md5($file['name']).'.'.$end;
     if(in_array($end, $all)){
         if($file['size']<5120000 && $file['tmp_name']!=""){
         	move_uploaded_file($file['tmp_name'], $path);
         	$db->insert('files',['uid'=>$id,'file_name'=>$file['name'],'file_dir'=>$path,'content'=>$_POST['content']]);
         	jump('index.php');
         }else{
          	$err.='文件大于5M';
      	}
     }else{
          $err.='文件格式不正确';
     }
}

$file = $db->select('files');
if(isset($_GET['id'])){
err([2]);
	$id = $_GET['id'];
	$f = $db->select('files',' WHERE `id` ='.$id.' ')[0]['file_dir'];
	unlink($f);
	$db->del('files',['id'=>$id]);
	jump('index.php');
}

?>
          <div class="main">
          <?php if(check([2])){ ?>
            <h3>上传文件</h3>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <textarea name="content"></textarea>
                <button type="submit" name="sub">上传文件</button>    
                <p class="err tip"><?=isset($err)?$err:'';?></p> 
            </form>
            <?php } ?>
          	<h3>文件列表</h3>
          	<table>
          		<tr>
          			<th>文件名</th>
          			<th>说明</th>
          			<th>操作</th>
          		</tr>
          <?php foreach ($file as $k => $v) { ?>		
          		<tr>
          			<td><?=$v['file_name']?></td>
          			<td><?=$v['content']?></td>
          			<td>
          <?php if(check([1,2])){ ?>		
          				<a href="down.php?id=<?=$v['id']?>">下载</a>
          <?php } if(check([2])){ ?>		
          				<a href="index.php?id=<?=$v['id']?>">删除</a>
          <?php } ?>		
          			</td>
          		</tr>
          <?php } ?>		
          	</table>
          </div>
</body>
</html>