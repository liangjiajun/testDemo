<?php 
class controller{

}

class controller_name{
	public function render($file,$arr)
	{
		foreach ($arr as $k => $v) {
			$$k=$v;
		}
		require_once ($file);
	}
	
	public function index()
	{
		$model = new model_home();
		$data = $model->get_news();
		$this->render('view/home_index.php',['tt'=>$data]);
	}

	
}

 ?>