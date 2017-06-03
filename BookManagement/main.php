<?php 
	require_once 'header.php'; 
	$id = $_GET['id']; 

	if(isset($_POST['contentBtn'])){
		$content  = safeHash($_POST['content']);
		$time = time();
		$db->insert('book_message',['content'=>$content,'message_time'=>$time,'user_id'=>1,'book_user'=>$id]);
		jump('main.php?id='.$id.'');
		exit();
	}

?>
<div class="wrap">
	<div class="main">
		<section class="content moreTip">
			<h3>书籍</h3>
			<ul>
			<?php  $bookList = $db->fetch($db->query("SELECT * FROM `book_list` WHERE id = '$id' "));   
					foreach ($bookList as $k => $v) {
			?>		
				<li>
					<a href="#" class="showImg" style="background-image: url(<?=$v['book_face']?>) "></a> 
					<strong>书名：<?=$v['book']?></strong>
					<i>作者：<?=$v['author']?></i>
					<i>ISBN：<?=$v['isbn']?></i>
					<p>说明：<?=$v['message']?></p>
				</li>
			<?php  } ?>	

				<li class="message">
					<form method="post">
						<label>
							<strong>阅读感受</strong>
							<textarea name="content" required></textarea>
						</label>	
						<button type="submit" name="contentBtn">提交</button>
					</form>	
				</li>
				<li class="messageList">
			<?php 
				$con = $db->fetch($db->query("SELECT * FROM `book_message` WHERE `book_user`='$id'")); 
			if(empty($con)){
					echo "暂时没有评论";
			}else{
				$uid = $con[0]['user_id'];
				$user =$db->fetch($db->query("SELECT * FROM `users` WHERE `id` = '$uid' ")); 
				foreach ($con as $k => $v) {
			?>
					<strong><?= $user[0]['username'] ?> <span><?= date('Y-m-d H:i:s',$v['message_time']);?></span></strong> 
					<p><?= $v['content']?></p>
					<hr>
			<?php } } ?>		
				</li>
			</ul>
			
		</section>
	</div>
</div>