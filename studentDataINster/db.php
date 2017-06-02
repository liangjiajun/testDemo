<?php 
/**
* 
*/
class db
{
	private $db;
	function __construct()
	{
		$this->db=new mysqli('127.0.0.1',$GLOBALS['config']['user'],$GLOBALS['config']['pass'],$GLOBALS['config']['dbsn']);
		$this->db->set_charset('utf8');
	}

	public function query($sql)
	{
		return $this->db->query($sql);
	}
	public function fetch($r)
	{
		$data=array();
		while ($row = mysqli_fetch_assoc($r)) {
			$data[]=$row;
		}
		return $data;
	}

	public function where($data)
	{
		$w="WHERE";
		foreach ($data as $k => $v) {
			$w.="`".$k."` = '".$v."' AND";
		}
		return substr($w, 0,-4);
	}

	public function prefix($d)
	{
		$area='';	
		foreach ($d as $k => $v) {
			$area.='`'.$v.'` ,';
		}
		return substr($area, 0,-2);
	}

	public function select($t,$p=NULL,$w=NULL,$o=NULL)
	{
		$p = isset($p) ? $this->prefix($p) : '*' ;
		$sql='SELECT '.$p.' FROM `'.$t.'`';
		if($w){
			$sql.=$this->where($w);
		}
		$sql.=$o;
		// echo $sql;
		return $this->fetch($this->query($sql));
	}
	public function insert($t,$d)
	{
		$sql='INSERT INTO `'.$t.'`';
		$k1=$v1='';
		foreach ($d as $k => $v) {
			$k1.='`'.$k.'` ,';
			$v1.="'".$v."' ,";
		}
		$sql.='('.substr($k1,0,-2).') VALUES ('.substr($v1,0,-2).')';
		$this->query($sql);
	}

	public function update($t,$d,$w)
	{
		$sql='UPDATE `'.$t.'` SET';
		foreach ($d as $k => $v) {
			$sql.="`".$k."` = '".$v."' ,";
		}
		$sql=substr($sql, 0,-2);
		$sql.=$this->where($w);
		$this->query($sql);
	}

	public function del($t,$w)
	{
		$sql='DELETE FROM `'.$t.'`';
		$sql.=$this->where($w);
		$this->query($sql);
	}
	public function in_id()
	{
		return mysqli_insert_id($this->db);
	}


}

