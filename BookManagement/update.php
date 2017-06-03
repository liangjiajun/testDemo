<?php  
require_once 'header.php';

$id = $_GET['id'];
if(isset($_POST['newBookBtn'])){
	$name = safeHash($_POST['bookName']);
	$author = safeHash($_POST['bookAuthor']);
	$isbn = safeHash($_POST['isbn']);
	$message = safeHash($_POST['message']);
	$db->update('book_list',['book'=>$name,'author'=>$author,'isbn'=>$isbn,'message'=>$message],['id'=>$id]);	
	jump('index.php');


}

?>
<div class="wrap">
	<div class="main">
		<section class="content moreTip update">
				<h2>修改书籍</h2>
				<form id="newBook" method="post">
			<?php 
				$content = $db->fetch($db->query("SELECT * FROM `book_list` WHERE id ='$id' "));
				foreach ($content as $k => $v) {	
			 ?>	
					<label>
						<span class="required">书名</span>
						<input type="text" name="bookName" id="bookName" required value="<?=$v['book']?>">
					</label>
					<label>
						<span class="required">作者</span>
						<input type="text" name="bookAuthor" id="bookAuthor" required value="<?=$v['author']?>">
					</label>
					<label>
						<span class="required">ISBN</span>
						<input type="text" name="isbn" id="isbn" placeholder="ISBN" required value="<?=$v['isbn']?>">
					</label>

					<label>
						<span>说明</span>
						<textarea name="message" id="message"><?=$v['message']?></textarea>
					</label>
			<?php } ?>			
					<button type="submit" name="newBookBtn">修改</button>	
				</form>
		</section>
	</div>
</div>