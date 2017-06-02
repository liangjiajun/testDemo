<?php 
	require_once 'config.php';

	$id = $_GET['id'];
	$data = $db->select('undergraduate',['id','forecast','card_number','name','sex','birthData','profession','level','Identity','iphone','create_time','del_id'],['id'=>$id]);

	if(isset($_POST['sub'])){
		$forecast =post('forecast');
		$card =post('card');
		$name =post('name');
		$sex =post('sex');
		$birth =post('birth');
		$profession =post('profession');
		$level =post('level');
		$identity =post('identity');
		$iphone =post('iphone');

		$db->update('undergraduate',['forecast'=>$forecast,'card_number'=>$card,'name'=>$name,'sex'=>$sex,'birthData'=>$birth,'profession'=>$profession,'level'=>$level,'Identity'=>$identity,'iphone'=>$iphone],['id'=>$id]);
		jump('show.php');

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据修改</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post">
	<h1>数据修改</h1>
	<?php foreach ($data as $k => $v) { ?>
	<ul>
		<li>
			<label>
				<span>预报名号</span>
				<input type="number" required name="forecast" value="<?=$v['forecast']?>">
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
				<input type="text" required name="name" value="<?=$v['name']?>">
			</label>
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
				<input type="date" required name="birth" value="<?=$v['birthData']?>">
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
				<input type="text" required name="level" value="<?=$v['level']?>">
			</label>
		</li>
		<li>
			<label>
				<span>身份证号</span>
				<input type="number" required name="identity" value="<?=$v['Identity']?>">
			</label>
		</li>
		<li>
			<label>
				<span>联系电话</span>
				<input type="number" required name="iphone" value="<?=$v['iphone']?>">
			</label>
		</li>
		<li>
			<button type="submit" name="sub">修改数据</button>
		</li>
	</ul>
	<?php } ?>
</form>	
</body>
</html>