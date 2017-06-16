<?php
	class helper_html{
		public function a($data,$url,$param=NULL,$attr=NULL){
			$attrs = '';
			if($attr){
				foreach($attr as $k => $v){
					 $attrs .= $k.'="'.$v.'" ';
				}
			}
			return '<a href="'.$this->url($url,$param).'" '.$attrs.'>'.$data.'</a>';
		}
		
		public function url($url,$param=NULL){
			if(is_array($url)){
				$params = '?c=' . $url[0] . (isset($url[1]) ? '&f='.$url[1]  : '');
				if($param){
					$params .= '&';
					foreach($param as $k =>$v){
						$params .= $k . '=' . $v.'&';
					}
					$params = substr($params,0,-1);
				}
				$link = base_url().$params;
			}else{
				$link = $url;
			}
			return $link;
		}
		
		//css链接文件的方法
		public function link($css){
			if(is_array($css)){
				$link = '';
				foreach($css as $v){
					$link .= '<link rel="stylesheet" type="text/css" href="'.path('css',true).$v.'.css">';
				}
			}else{
				$link = '<link rel="stylesheet" type="text/css" href="'.path('css',true).$css.'.css">';
			}
			return $link;
		}
		
		//js链接文件的方法
		public function script($js){
			if(is_array($js)){
				$link = '';
				foreach($js as $v){
					$link .= '<script type="text/javascript" src="'.path('script',true).$v.'.js" ></script>';
				}
			}else{
				$link = '<script type="text/javascript" src="'.path('script',true).$js.'.js" ></script>';
			}
			return $link;
		}
		
		//页面上载入图片的方法
		public function img($file_name,$other=NULL){
			$attr = '';
			if($other){
				if(is_array($other)){
					foreach($other as $k => $v){
						$attr .= ' '.$k.' = \''.$v.'\' ';
					}
				}
			}
			return '<img alt="" src="'.path('images',true).$file_name.'" '.$attr.' />';
		}
		
	}
?>