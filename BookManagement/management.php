<?php  
require_once 'header.php';
if(isset($_GET['del'])){
	$db->del('book_list',['id'=>$_GET['del']]);
	jump('management.php');
}

?>
<div class="wrap">
	<div class="main">
		<section class="content moreTip management">
			<h3>书籍</h3>
			<ul>
			<?php  $bookList = $db->fetch($db->query("SELECT * FROM `book_list`"));   
					foreach ($bookList as $k => $v) {
			?>		
				<li>
					<a href="#" class="showImg" style="background-image: url(<?=$v['book_face']?>) "></a> 
					<strong>书名：<?=$v['book']?></strong>
					<i>作者：<?=$v['author']?></i>
					<i>ISBN：<?=$v['isbn']?></i>
					<p>说明：<?=$v['message']?></p>
					<a href="management.php?del=<?=$v['id']?>" class="borrow">删除</a>
					<a href="update.php?id=<?=$v['id']?>" class="borrow">修改</a>
				</li>
			<?php  } ?>	
			</ul>		
		</section>
	</div>
</div>