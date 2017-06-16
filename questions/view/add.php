<?php  
  require_once 'nav/header.php';
?> 
<div class="container wrap">
    <h4 class="text-left smallTitle bb">添加题库</h4>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" 
					   href="#collapseOne" class="db">
						单条题目导入<span class="glyphicon glyphicon-chevron-down">
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse">
				<ul class="add-form">
					<form method="post" action="?c=home&f=add_question&active=manual">
						<li>
							<span>题目类型：<sup>*</sup></span>
							<select name="type" class="input form-control">
							<?php foreach ($type as $k => $v) {?>
								<option><?=$v['type']?></option>
							<?php } ?>
							</select>
						</li>
						<li>
							<span>问题: <sup>*</sup></span>
							<textarea name="topic" class="input form-control" required></textarea>
						</li>
						<li>
							<span>答案：（正确答案请勾选）<sup>*</sup></span>
							<div class="input-group input">
						      <span class="input-group-addon">
						        <input type="radio" name="right" value="A">
						      </span>
						      <input type="text" class="form-control" name="issue1" required>
						    </div>
						    <div class="input-group input">
						      <span class="input-group-addon">
						        <input type="radio" name="right" value="B">
						      </span>

						      <input type="text" class="form-control" name="issue2" required>
						    </div>
						    <div class="input-group input">
						      <span class="input-group-addon">
						        <input type="radio" name="right" value="C">
						      </span>
						      <input type="text" class="form-control" name="issue3" required >
						    </div>
						    <div class="input-group input">
						      <span class="input-group-addon">
						        <input type="radio" name="right" value="D">
						      </span>
						      <input type="text" class="form-control"  name="issue4" required>
						    </div>
						</li>
						<li>
							<p class="err"><?=isset($_SESSION['err'])?$_SESSION['err']:'';?></p>
							<p class="right"><?=isset($_GET['r'])?'导入成功':'';?></p>
							 <button type="submit" class="btn btn-primary btnAdd odd_sub" aria-expanded="true">  提交</button>
						</li>
					</form>
				</ul>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" 
					   href="#collapseTwo" class="db">
						文件导入<span class="glyphicon glyphicon-chevron-down">
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse  in">
				<ul class="add_even panel-body">
					<form method="post">
						<li><a href="uploads/questions/题库.csv" class="smaple">下载样板</a></li>
						<li>
							<div id="droparea">
								<div id="dropAreaFile"></div>
								<span class="glyphicon glyphicon-plus"></span>
								<span class="dropText">可以拖拽上传，也可以点击此区域进行上传</span>
							</div>
						</li>
					</form>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php  
  require_once 'nav/footer.php';
?> 