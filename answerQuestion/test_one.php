<?php require_once 'inc/nav.php'; 
     err([1,2]);
     $id = $_SESSION['user']['id'];
     $scores = $db->select('scores',' WHERE `uid` ='.$id.' ');
?>
          <div class="main">
          	<h3>查看当前成绩</h3>
          	<table>
          		<tr>
          			<th>用户</th>
          			<th>答题时间</th>
                         <th>提交时间</th>
          			<th>分数</th>
          		</tr>
               <?php foreach ($scores as $k => $v) {
                    $user = $db->select('users',' WHERE `id` ='.$v['uid'].' ')[0]['nickname'];
                ?>      
          		<tr>
                         <td><?=$user?></td>
                         <td><?=$v['date_time']?></td>
                         <td><?=date('H:i:s',$v['times'])?></td>
          			<td><?=$v['total']?>分</td>
          		</tr>
               <?php } ?>      
          	</table>
          </div>
</body>
</html>