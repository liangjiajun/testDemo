<?php  
require_once 'header.php';
?>
	<article class="wrap main_content">
		<div class="main">
			<div class="tip">读书，或许不能让人一夜暴富，但是请相信：你在阅读上花的每一秒，都会沉淀成将来更好的你。</div>
			<div class="aside">
				<section class="manage clear">
					<h3>管理面板</h3>
					<ul>
				<?php if(check([1,2])){ ?>
						<li><a href="#" id="newBookBtn">新书入库</a></li>
						<li><a href="management.php">书籍管理</a></li>
				<?php } ?>
						<li><a href="#" id="pushBook">还书处理</a></li>
						<li><a href="#">借书处理</a></li>
					</ul>
				</section>
				<section class="label clear">
					<h3>标签</h3>
					<ul>
				<?php
				/*
					读取所有的标签
				*/
					$label = $db->fetch($db->query("SELECT * FROM `book_label`"));
					foreach ($label as $k => $v) {
				?>			
						<li><a href="page.php?id=<?=$v['id']?>"><?=$v['label']?></a></li>
				<?php } ?>		


					</ul>
				</section>
				<section class="chosen clear electron">
					<h3>电子书籍<a href="#" class="more">更多</a></h3>
					<ul>
						<li>
							<!-- <a href="#">
								<span></span>
								氨基酸
							</a> -->
						</li>
					</ul>
				</section>
			</div>
			<section class="content">
				<h3>书籍<a href="bookMore.php" class="more">更多</a></h3>
				<ul>
			<?php  
				/*
					获取12条书籍数据，排序默认

				*/
				$bookList = $db->fetch($db->query("SELECT * FROM `book_list` LIMIT 12"));   
					foreach ($bookList as $k => $v) {
			?>	
					<li>
						<a href="main.php?id=<?=$v['id']?>" class="book_face" style="background-image: url(<?=$v['book_face']?>)"></a>
						<span class="book_message">
							<strong><?=$v['book']?></strong>
							<span class="book_user"><?=$v['author']?></span>
					<?php if($v['level'] ==0 || $v['user_id'] !=0){ 
						$buid =  $v['user_id'];
						$uId = $db->fetch($db->query("SELECT * FROM `users` WHERE `id` = '$buid'"))[0];
					?>		
							<p class="oldBorrow"><?=$uId['username'];?>已借阅</p>

					<?php }else{ ?>			
							<a href="#" id="<?=$v['id']?>" class="borrow">借阅</a>
					<?php } ?>		
						</span>
					</li>
			<?php  }	 ?>
				</ul>
			</section>
		</div>
	</article>
	<div class="overhiden"></div>
	<div class="interface newBookFace">
				<h2>新书入库 <span class="del">X</span></h2>
				<form id="newBook" onsubmit="return false;" method="post">
					<label>
						<span class="required">书名</span>
						<input type="text" name="bookName" id="bookName" required placeholder="书名">
					</label>
					<label>
						<span class="required">作者</span>
						<input type="text" name="bookAuthor" id="bookAuthor" required placeholder="作者">
					</label>
					<label>
						<span class="required">ISBN</span>
						<input type="text" name="isbn" id="isbn" placeholder="ISBN" required>
					</label>
					<label class="file_data">
						<span class="required">封面</span>
						<input type="file" name="bookFace" id="bookFace" required onchange="document.getElementById('fileHide').value=this.value">
						<input type="text" placeholder="上传文件" id="fileHide">
						<input type="button" class="file_hide" value="浏览文件">
					</label>

					<span class="required">标签</span>
					<div class="label_wrap">
						<?php  
							$label = $db->fetch($db->query("SELECT * FROM `book_label`"));
							// print_r($label);
							foreach ($label as $k => $v) {											
						?>	
							<label class="checkbox">
								<input type="checkbox" name="label" class="check" value="<?=$v['id'];?>">
								<span><?=$v['label'];?></span>
							</label>

						<?php } ?>	
							<label class="checkbox">
								<input type="text" id="add_label">
								<button id="add_label_btn" type="button">新建</button>
								<span id="new_label">新建</span>
							</label>
					</div>
							
					<label>
						<span>说明</span>
						<textarea name="message" id="message"></textarea>
					</label>
					<label>
						<span>书籍类型</span>
						<select name="bookType" id="bookType">
							<option value="1">纸质书</option>
							<option value="2">电子书</option>
						</select>
					</label>
					<label class="newBookErr"></label>	
					<button type="submit" id="newBookBtn">上传新书</button>	
				</form>
		</div>
		<div class="interface borrowFace">
			<h2>借书处理 <span class="del">X</span></h2>
			<div class="book"></div>
			<button type="button" id="borrowBtn">提交</button>
		</div>
		<div class="interface pushFace">
			<h2>还书处理 <span class="del">X</span></h2>
		<?php  
			if(is_guest()){
				 echo "你尚未登陆，请在登陆后重新登入此页面进行操作"; 
		?>	
		<?php }else{
			$pushUid = $_SESSION['id'];
			$pushBook = $db->fetch($db->query("SELECT * FROM `book_list` WHERE `user_id`='$pushUid' "));
			if(empty($pushBook)){
				echo "你没有已借阅的书本";
			}else{	
		?>	

			<ul class="book">
		<?php foreach ($pushBook as $k => $v) { ?>		
				<li style="background-image:url(<?=$pushBook[$k]['book_face']?>)">
					<input type="checkbox" value="<?=$pushBook[$k]['id']?>" class="checkRadio">
				</li>
		<?php } ?>	
			</ul>
			<div>你已借阅 <?=count($pushBook);?> 本</div>
			<button type="button" id="pushBtn">还书</button>
		<?php  }} ?>	
		</div>
	</body>
</html>