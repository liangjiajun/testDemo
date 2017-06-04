<?php 

class db
{
	public $db;
	function __construct()
	{
			$this->db=new mysqli('127.0.0.1',$GLOBALS['config']['user'],$GLOBALS['config']['pass'],$GLOBALS['config']['dbsn']);
			$this->db->set_charset('utf8');
	}

	public function query($sql)
	{
		return $this->db->query($sql);
	}

	public function fetch($t)
	{
		$d=[];
		while ($row = mysqli_fetch_assoc($t)) {
			$d[] = $row;
		}
		return $d;
	}

	public function where($d)
	{
		$w="WHERE";
		foreach ($d as $k => $v) {
			$w.="`".$k."` = '".$v."' AND";
		}
		return substr($w, 0,-4);
	}

	public function select($t,$o=NULL)
	{
		$sql='SELECT * FROM `'.$t.'`' ;
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
		// echo $sql;
		$this->query($sql);
	}
	public function update($t,$d,$w)
	{
		$sql='UPDATE `'.$t.'` SET';
		foreach ($d as $k => $v) {
			$sql.="`".$k."` = '".$v."' ,";
		}
		$sql=substr($sql,0,-2);
		$sql.=$this->where($w);
		// echo $sql;
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

	public function trun($t)
	{
		$this->query('TRUNCATE TABLE `'.$t.'`');
	}
}
