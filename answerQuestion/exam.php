<?php require_once 'inc/nav.php'; 
err([2]);
     if(isset($_POST['sub'])){
          $file = $_FILES['file'];
          $err='';
          $right='';
          $end = suffix($file['name']);
          $all=['csv'];
          $n = 1;
          if(in_array($end, $all)){
               $data = array_map('str_getcsv', file($file['tmp_name']));
               foreach ($data as $k => $v) {
                    $encode = mb_detect_encoding($v[3],array('ASCII','UTF-8','GB2312','GBK'));
                    $v0 = $encode=="EUC-CN"? iconv('GBK', 'UTF-8', $v[0]):$v[0];
                    $v1 = $encode=="EUC-CN"? iconv('GBK', 'UTF-8', $v[1]):$v[1];
                    $v2 = $encode=="EUC-CN"? iconv('GBK', 'UTF-8', $v[2]):$v[2];
                    $v3 = $encode=="EUC-CN"? iconv('GBK', 'UTF-8', $v[3]):$v[3];
                    if($v0!="题号" && $v1!="题目(*)"){
                         if($v0 && $v[4]){
                              $db->insert('questions',['num'=>$n++,'topic'=>$v1,'q_ans'=>$v2,'type'=>$v3,'score'=>$v[4]]);
                              $_SESSION['n'] = $db->in_id();
                         }else{
                              $db->insert('answers',['qid'=>$_SESSION['n'],'a_ans'=>$v2,'a_option'=>$v3]);
                         }
                    }
               }
                $right.='上传成功';
          }else{
               $err.='文件格式不正确';
          }
     }
?>
          <div class="main">
          	<h3>上传题库</h3>
          	<form method="post" enctype="multipart/form-data">
                    <input type="file" name="file" required>
                    <button type="submit" name="sub">上传题库</button>    
                    <p class="err tip"><?=isset($err)?$err:'';?></p> 
                    <p class="right tip"><?=isset($right)?$right:'';?></p> 
               </form>
          </div>
</body>
</html>