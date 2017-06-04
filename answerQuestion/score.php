<?php require_once 'inc/nav.php'; 
err([1,2]);
     $scores = $db->select('scores',' ORDER BY `total` DESC');
?>
          <div class="main">
          	<h3>查看成绩</h3>
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
                         <td><a href="list.php?id=<?=$v['id']?>"><?=$user?></a></td>
                         <td><?=$v['date_time']?></td>
                         <td><?=date('H:i:s',$v['times'])?></td>
          			<td><?=$v['total']?>分</td>
          		</tr>
               <?php } ?>      
          	</table>
          </div>
</body>
</html>