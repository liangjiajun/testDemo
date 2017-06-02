<?php 
	require_once 'config.php';
	$data = $db->select('undergraduate',['id','forecast','card_number','name','sex','birthData','profession','level','Identity','iphone','create_time','del_id'],['del_id'=>0]);
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$db->update('undergraduate',['del_id'=>1],['id'=>$id]);
		jump('show.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<a class="btn" href="index.php">导入数据</a>
<a class="btn" href="#">导出数据</a>
	<h1>成绩录入显示表</h1>
	<table>
		<tr>
			<th>序号</th>
			<th>预报名号</th>
			<th>准考证号</th>
			<th>姓名</th>
			<th>性别</th>
			<th>出生年月</th>
			<th>首报专业</th>
			<th>学历层次</th>
			<th>身份证号码</th>
			<th>联系电话</th>
			<th>操作</th>
		</tr>

<?php $i=1; foreach ($data as $k => $v) { ?>		
		<tr>
			<td><?=$i++?></td>
			<td><?=$v['forecast']?></td>
			<td><?=$v['card_number']?></td>
			<td><?=$v['name']?></td>
			<td><?=$v['sex']?></td>
			<td><?=$v['birthData']?></td>
			<td><?=$v['profession']?></td>
			<td><?=$v['level']?></td>
			<td><?=$v['Identity']?></td>
			<td><?=$v['iphone']?></td>
			<td>
				<a href="update.php?id=<?=$v['id']?>">修改</a>
				<a href="show.php?id=<?=$v['id']?>">删除</a>
			</td>
		</tr>
<?php } ?>		
	</table>
</body>
</html>