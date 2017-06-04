<?php require_once 'inc/nav.php'; 
err([2]);
     $id = $_GET['id'];
     $scores = $db->select('scores',' WHERE `id` ='.$id.' ');
     $r= explode(',', $scores[0]['r_key']);
     $q  =  $db->select('questions');
?>
          <div class="main">
          	<h3>查看详细成绩</h3>
          	<table>
                    <tr>
                         <th>用户</th>
                         <th>答题时间</th>
                         <th>提交时间</th>
                         <th>分数</th>
                    </tr>
               <?php foreach ($scores as $k => $v) {
                    $user =  $db->select('users',' WHERE `id` ='.$v['uid'].' ')[0]['nickname'];
               ?>      
                    <tr>
                         <td><?=$user?></td>
                         <td><?=$v['date_time']?></td>
                         <td><?=date('H:i:s',$v['times'])?></td>
                         <td><?=$v['total']?>分</td>
                    </tr>
               <?php } ?>      
               </table>
               <table>
          		<tr>
          			<th>编号</th>
          			<th>题目内容</th>
                         <th>题目分值</th>
          			<th>答题答案</th>
          		</tr>
               <?php $i=1; foreach ($q as $k => $v2) { ?>
          		<tr>
                         <td><?=$i++?></td>
                         <td><?=$v2['topic']?></td>
                         <td><?=$v2['score']?></td>
               <?php if(in_array($v2['id'], $r)){ ?>      
                         <td style="color:green">正确</td>
               <?php }else{ ?>      
                    <td style="color:red">错误</td>
               <?php } ?>      
                    </tr>
               <?php } ?>      
          	</table>
          </div>
</body>
</html>