<?php 
	class controller{
		
		public function render($file,$arr){
			foreach($arr as $k => $v){
				$$k = $v;
			}
			require_once($file);
		}
	}