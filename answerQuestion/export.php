<?php 
require_once 'config/config.php';
err([2]);
$q = $db->select('questions');
$str="题号,题目(*),答案(*),类型(*),分值(*)\n";
$str = iconv('UTF-8','GBK', $str);
$n=1;
foreach ($q as $k => $v) {
	$id =$v['id'];
	$topic = iconv('UTF-8','GBK', $v['topic']);
	$q_ans = iconv('UTF-8','GBK', $v['q_ans']);
	$type = iconv('UTF-8','GBK', $v['type']);
	$score=$v['score'];
	$str.=$n++.",".$topic.","."\"".$q_ans."\"".",".$type.",".$score."\n";
	if($type!="判断"){
		$ans = $db->select('answers',' WHERE `qid` ='.$id.' ');
		foreach ($ans as $k => $v1) {
			$a_ans = $v1['a_ans'];
			$a_option = iconv('UTF-8','GBK', $v1['a_option']);
			$str.="".","."".",".$a_ans.",".$a_option.",".""."\n";
		}
	}
}
$name = time().'.csv';
csv($name,$str);