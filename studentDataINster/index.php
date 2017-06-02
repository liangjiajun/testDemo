<?php 
	require_once 'config.php';

	if(isset($_POST['sub'])){
		$err=[];
		$right='';
		$forecast =post('forecast');
		$card =post('card');
		$name =post('name');
		$sex =post('sex');
		$birth =post('birth');
		$profession =post('profession');
		$level =post('level');
		$identity =post('identity');
		$iphone =post('iphone');


		//正则
		$preg_iden = '/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/';
		$preg_ipon = '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
		if(!preg_match($preg_iden,$identity)){$err['identity']='身份证号码格式不正确';}
		if(!preg_match($preg_ipon,$iphone)){$err['iphone']='手机格式不正确';}
		//重复
		$more_iden = $db->select('undergraduate',['Identity'],['Identity'=>$identity]);
		$more_ipon = $db->select('undergraduate',['iphone'],['iphone'=>$iphone]);
		if(!empty($more_iden)){$err['identity']='身份证号码重复';}
		if(!empty($more_ipon)){$err['iphone']='电话号码重复';}	
		if(empty($err)){
			$db->insert('undergraduate',['forecast'=>$forecast,'card_number'=>$card,'name'=>$name,'sex'=>$sex,'birthData'=>$birth,'profession'=>$profession,'level'=>$level,'Identity'=>$identity,'iphone'=>$iphone,'create_time'=>time()]);
			$right.='导入成功';
		}





	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据录入</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post">
	<h1>数据录入</h1>
	<a href="show.php" class="btn">数据显示</a>
	<ul>
		<li>
			<label>
				<span>预报名号</span>
				<input type="number" required name="forecast" value="21015566">
			</label>
		</li>
		<li>
			<label>
				<span>准考证号</span>
				<input type="number" name="card">
			</label>
		</li>
		<li>
			<label>
				<span>姓名</span>
				<input type="text" required name="name" value="张娟">
			</label>
			<p class="err"><?=isset($err['name'])?$err['name']:''?></p>
		</li>
		<li>
			<label>
				<span>性别</span>
				<select name="sex">
					<option value="女">女</option>
					<option value="男">男</option>
				</select>
			</label>
		</li>
		<li>
			<label>
				<span>出生年月</span>
				<input type="date" required name="birth">
			</label>
		</li>
		<li>
			<label>
				<span>首报专业</span>
				<select name="profession">
					<option value="英语教育">英语教育</option>
					<option value="商务英语">商务英语</option>
				</select>
			</label>
		</li>
		<li>
			<label>
				<span>学历层次</span>
				<input type="text" required name="level" value="本科">
			</label>
		</li>
		<li>
			<label>
				<span>身份证号</span>
				<input type="number" required name="identity" value="441621199706033081">
			</label>
			<p class="err"><?=isset($err['identity'])?$err['identity']:''?></p>
		</li>
		<li>
			<label>
				<span>联系电话</span>
				<input type="number" required name="iphone" value="15707625253">
			</label>
			<p class="err"><?=isset($err['iphone'])?$err['iphone']:''?></p>
		</li>
		<li>
			<button type="submit" name="sub">提交数据</button>
			<p><?=isset($right)?$right:''?></p>
		</li>
	</ul>
</form>	
</body>
</html>