<?php require_once 'inc/nav.php'; 
$q = $db->select('questions');

if(isset($_POST['sub'])){
  err([1,2]);
     $right = 0;
     $str='';
     $uid =$_SESSION['user']['id'];
     foreach ($_POST['question'] as $k => $v) {
         $ans = $db->select('questions',' WHERE `id` ='.$k.' ');
         $id = $ans[0]['id'];
         $a = $ans[0]['q_ans'];
         $score = $ans[0]['score'];
         $type = $ans[0]['type'];
         switch ($type) {
              case '判断':
              case '单选':
                  if($a==$v){
                    $right+=$score;
                    $str.=$id.",";
                  }
                   break;
               case '多选':
                    $all  = explode(',', $v);
                    if(count($v)==count($all)){
                         if(empty(array_diff($v, $all))){
                             $right+=$score;
                             $str.=$id.","; 
                         }
                    }
                   break;
              
         }
     }
     $str = substr($str, 0,-1);
     $db->insert('scores',['uid'=>$uid,'date_time'=>date('Y-m-d',time()),'times'=>time(),'total'=>$right,'r_key'=>$str]);
     jump('test_one.php');
}

?>
          <div class="main">
          	<h3>题库测试</h3>
               <form method="post">
               <?php  $i=1;foreach ($q as $k => $v) { ?>
                    <br><div><?=$i++.'、'.$v['topic']?></div>
                    <div>
          	         <?php if(check([1,2])){ switch ($v['type']) {
                             case '单选':
                                  $ans =  $db->select('answers',' WHERE `qid` ='.$v['id'].' ');
                                  foreach ($ans as $k => $v2) {
                                       echo '<br><label><input type="radio" name="question['.$v['id'].']" value="'.$v2['a_ans'].'">'.$v2['a_ans'].":".$v2['a_option'].'</label><br>';
                                  }
                                  break;
                               case '多选':
                                  $ans =  $db->select('answers',' WHERE `qid` ='.$v['id'].' ');
                                  foreach ($ans as $k => $v2) {
                                       echo '<br><label><input type="checkbox" name="question['.$v['id'].'][]" value="'.$v2['a_ans'].'">'.$v2['a_ans'].":".$v2['a_option'].'</label><br>';
                                  }
                                  break;
                                case '判断':
                                   echo '<br><label><input type="radio" name="question['.$v['id'].'][]" value="对">正确</label><br><label><input type="radio" name="question['.$v['id'].'][]" value="错">错误</label><br>';
                                  break;

                             } }
                        } ?>
                    </div>
                    <?php if(check([1,2]) && !empty($q)){ ?>
                    <button type="submit" name="sub">提交</button>
                    <?php }  ?>
               </form>
          </div>
</body>
</html>