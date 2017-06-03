<?php  
require_once 'header.php';
$id = $_GET['id'];

?>
	<article class="wrap main_content">
		<div class="main">
			<div class="aside">
				<section class="label clear">
					<h3>标签</h3>
					<ul>
				<?php 
					$label = $db->fetch($db->query("SELECT * FROM `book_label`"));
					foreach ($label as $k => $v) {
				?>			
						<li><a href="page.php?id=<?=$v['id']?>"><?=$v['label']?></a></li>

				<?php } ?>		


					</ul>
				</section>

			</div>
			<section class="content">
				<h3>书籍<a href="bookMore.php" class="more">查看全部</a></h3>
				<ul>
			<?php  $bookList = $db->fetch($db->query("SELECT * FROM `book_list` WHERE FIND_IN_SET('$id',label)"));   
			if(empty($bookList)){
				echo '该类型的书籍尚未储存数据或已删除，请咨询管理员';
			}else{
					foreach ($bookList as $k => $v) {

			?>	
					<li>
						<span class="book_face" style="background-image: url(<?=$v['book_face']?>)"></span>
						<span class="book_message">
							<strong><?=$v['book']?></strong>
							<span class="book_user"><?=$v['author']?></span>
							<a href="#" class="borrow">借阅</a>
						</span>
					</li>
			<?php  }}	 ?>
				</ul>
			</section>
		</div>
	</article>