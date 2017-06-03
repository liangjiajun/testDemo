<?php  
require_once 'header.php';
/*
显示更多的书籍，主要是首页限制12条，这里显示全部、
*/
?>
<div class="wrap">
	<div class="main">
		<section class="content moreTip">
			<h3>书籍</h3>
			<ul>
			<?php  $bookList = $db->fetch($db->query("SELECT * FROM `book_list`"));   
					foreach ($bookList as $k => $v) {
			?>		
				<li>
					<a href="main.php?id=<?=$v['id'];?>" class="showImg" style="background-image: url(<?=$v['book_face']?>) "></a> 
					<strong>书名：<?=$v['book']?></strong>
					<i>作者：<?=$v['author']?></i>
					<i>ISBN：<?=$v['isbn']?></i>
					<p>说明：<?=$v['message']?></p>
					<?php if($v['level'] ==0 || $v['user_id'] !=0){ 
						$buid =  $v['user_id'];
						$uId = $db->fetch($db->query("SELECT * FROM `users` WHERE `id` = '$buid'"))[0];
					?>		
							<a class="oldBorrow"><?=$uId['username'];?>已借阅</a>

					<?php }else{ ?>			
							<a href="#" id="<?=$v['id']?>" class="borrow">借阅</a>
					<?php } ?>		
				</li>
			<?php  } ?>	
			</ul>		
		</section>
	</div>
</div>