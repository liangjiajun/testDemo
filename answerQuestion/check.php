<?php require_once 'inc/nav.php'; 
err([3]);
     $user = $db->select('users',' WHERE `role`<3' );
if(isset($_GET['p'])){
err([3]);
     $id = $_GET['p'];
     $db->update('users',['verify'=>1],['id'=>$id]);
     jump('check.php');
}
   
if(isset($_GET['n'])){
err([3]);
     $id = $_GET['n'];
     $db->update('users',['verify'=>-1],['id'=>$id]);
     jump('check.php');
}
   
if(isset($_GET['d'])){
err([3]);
     $id = $_GET['d'];
     $db->del('users',['id'=>$id]);
     jump('check.php');
}
   

?>
          <div class="main">
          	<h3>文件列表</h3>
          	<table>
          		<tr>
          			<th>邮箱</th>
          			<th>昵称</th>
          			<th>操作</th>
          		</tr>
                  <?php foreach ($user as $k => $v) { ?>  
          		<tr>
                         <td><?=$v['username']?></td>
          			<td><?=$v['nickname']?></td>
          			<td>
                  <?php if($v['verify']==1){echo "已通过";}else{ ?>  
                              <a href="check.php?p=<?=$v['id']?>">通过</a>
                  <?php } if($v['verify']==-1){echo "拒绝";}else{ ?>  
                              <a href="check.php?n=<?=$v['id']?>">拒绝</a>
                  <?php } ?>  
                              <a href="check.php?d=<?=$v['id']?>">删除</a>
                         </td>
                    </tr>
                  <?php } ?>  
          	</table>
          </div>
</body>
</html>