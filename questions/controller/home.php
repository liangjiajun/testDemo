<?php

	class controller_home extends controller{
		public function index(){
			$model = new model_home();
			$data = $model->index();
			$this->render('view/index.php',['data'=>$data]);
		}

		public function type(){
			$model = new model_home();
			$data = $model->upload_type();
		}		
		/*add page*/		
		public function add(){
			$model = new model_home();
			$data = $model->add();
			$this->render('view/add.php',['type'=>$data]);
		}		
		public function add_question(){
			$model = new model_home();
			$data = $model->add_question();
		}		

		/*group page*/		
		public function group(){
			$model = new model_home();
			$data = $model->group();
			$this->render('view/group.php',['question'=>$data]);
		}	
		public function show_question(){
			$model = new model_home();
			$data = $model->show_question();
		}	

		public function del_check(){
			$model = new model_home();
			$data = $model->del_check();
		}	
		public function clearCache(){
			$model = new model_home();
			$data = $model->clearCache();
		}	

		public function add_group(){
			$model = new model_home();
			$data = $model->add_group();
		}	

		/*paper page*/		
		public function paper(){
			$model = new model_home();
			$data = $model->paper();
			$this->render('view/paper.php',['paper'=>$data]);
		}	
		

		/*score page*/		
		public function score(){
			$model = new model_home();
			$data = $model->score();
			$this->render('view/score.php',['type'=>$data]);
		}	


		/*listPage page*/		
		public function listPage(){
			$model = new model_home();
			$data = $model->listPage();
			$this->render('view/list.php',['list'=>$data]);
		}	

		

		/*test page*/		
		public function test(){
			$model = new model_home();
			$data = $model->test();
			$this->render('view/test.php',['type'=>$data]);
		}	

		public function rightQuestion(){
			$model = new model_home();
			$data = $model->rightQuestion();
		}	
		public function reditScore(){
			$model = new model_home();
			$data = $model->reditScore();
		}	

		/*groupTest page*/		
		public function groupTest(){
			$model = new model_home();
			$data = $model->groupTest();
			$this->render('view/groupTest.php',['group'=>$data]);
		}	





	}
	