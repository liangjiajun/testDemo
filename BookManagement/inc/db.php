<?php 
class db{
	public $db;

	/*
		*$GLOBALS['config']['user']      用户名
		*$GLOBALS['config']['password']	 用户密码	
		*$GLOBALS['config']['database']	 数据库
	*/
	public function __construct(){
		$this->db = new mysqli('127.0.0.1',$GLOBALS['config']['user'],$GLOBALS['config']['password'],$GLOBALS['config']['database']);
		$this->db->set_charset('utf8');
		if($this->db->connect_error){
			die("Connect Error(".$this->db->connect_errno.")".$this->db->connect_error);
		}
	}

	/*
		*$sql 语句
	*/
	public function query($sql){
		// echo $sql;
		return $this->db->query($sql);
	}
	/*
		*$result 遍历数据
	*/
	public function fetch($result){
		$data =[];
		while($row = mysqli_fetch_assoc($result)){
			$data []= $row;
		}
		return $data;
	}
	/*
		*$data where的条件 
	*/
	public function format_where($data){
		$where =" WHERE ";
		foreach($data as $k => $v){
			$where.= "`".$k."`='".$v."' AND ";
		}
		return substr($where,0,-4);
	}

	/*
		*$table 表名 
		*$other 其它条件语句 
	*/
	public function select($table,$where=NULL,$other=NULL){
		$sql = 'SELECT * FROM `'.$table.'`';
		$sql .=$this->format_where($where);
		$sql .=$other;
		return $this->fetch($this->query($sql));
		// echo $sql;
	}

	public function insert($table,$data){
		$sql = 'INSERT INTO `'.$table.'`';
		$keys = $values = '';
		foreach($data as $k => $v){
			$keys .= ' `'.$k.'` , ';
			$values .="'".$v."' , ";
		}
		$sql .='('.substr($keys,0,-2).') VALUES ('.substr($values,0,-2).') ';
		$this->query($sql);
		// echo $sql;
	}

	public function update($table,$data,$where){
		$sql = 'UPDATE `'.$table.'` SET';
		foreach ($data as $k => $v) {
			$sql .="`".$k."` = '".$v."' , ";
		}
		$sql = substr($sql,0,-2);
		$sql .= $this->format_where($where);
		// echo $sql;
		$this->query($sql);
	}

	public function del($table,$where){
		$sql = 'DELETE FROM `'.$table.'` ';
		$sql .= $this->format_where($where);
		$this->query($sql);
	}

	public function insert_id(){
		return mysqli_insert_id($this->db);
	}

}
