<?php 
	class model{
		public $db; 
		public function __construct(){
			$con = require_once 'config/config.php';
			$this->db =new db($con);
		}
	}