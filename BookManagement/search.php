<?php  
require_once 'header.php';
	if(isset($_GET['search'])){

		// select 字段1,字段2,字段3, MATCH(要匹配的字段名)  AGAINST('keyword') as score from table having score>0
		/*
			上面的mysql语句留作研究之用（模糊搜索）	
			搜索页面
			搜索内容：书名、作者、ISBN码
		*/
		$search = safeHash($_GET['search']);
		$con = $db->fetch($db->query("SELECT * FROM `book_list` WHERE `isbn` like '%$search%' OR `book` like '%$search%' OR  `author` like '%$search%' "));
	}	
?>
<div class="wrap">
	<div class="main">
		<section class="content moreTip">
			<h3>书籍</h3>
			<ul>
			<?php  
				foreach ($con as $k => $v) {
			?>		
				<li>
					<a href="main.php?id=<?=$con[$k]['id'];?>" class="showImg" style="background-image: url(<?=$con[$k]['book_face']?>) "></a> 
					<strong>书名：<?=$con[$k]['book']?></strong>
					<i>作者：<?=$con[$k]['author']?></i>
					<i>ISBN：<?=$con[$k]['isbn']?></i>
					<p>说明：<?=$con[$k]['message']?></p>
					<a href="#" class="borrow">借阅</a>
				</li>
			<?php  } ?>	 
			</ul>		
		</section>
	</div>
</div>