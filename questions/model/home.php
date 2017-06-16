<?php
	class model_home extends model {
		public function index(){
			return $this->db->select('answer_type');
		}

		/*upload questions type the icon*/
		public function upload_type(){
			$file = $_FILES['file'];
			$name = 'uploads/type_icon/'.$file['name'];
			move_uploaded_file($file['tmp_name'],$name);
			$type = $_POST['typeName'];
			$this->db->insert('answer_type',['type'=>$type,'type_icon'=>$file['name']]);
			redirect();
		}

		/*add page*/

		public function add(){
			return $this->db->select('answer_type');
		}
		/*upload the question */
		public function add_question(){
			/*odd question upload*/	
			if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['type'])){
				if(!$_POST['right']){
					$_SESSION['err'] = '上传失败，正确答案不能为空请勾选';
					redirect('?f=add');
				}else{
					unset($_SESSION['err']);
					$type = $_POST['type'];
					$topic = htmlspecialchars($_POST['topic']);
					$right = $_POST['right'][0];
					$arr=['A','B','C','D'];
					$question = $this->db->insert('answer_question',['topic'=>$topic,'answer'=>$right,'type'=>$type]);
					$qid =$this->db->in_id();
					for ($i=0; $i <count($arr); $i++) { 
						$all = $i+1;
						$this->db->insert('answer_answer',['qid'=>$qid,'a_ans'=>$arr[$i],'a_option'=>htmlspecialchars($_POST['issue'.$all.''])]);
					}
					redirect('?f=add&r=true');
				}
			}
			/*even questions file upload（csv-file）*/
			if(isset($_FILES)){
				$file=$_FILES['file'];
				$data = array_map('str_getcsv', file($file['tmp_name']));
				foreach ($data as $k => $v){
					$v0 = iconv('GBK', 'UTF-8', $v[0]);
					$v1 =htmlspecialchars(trim(iconv('GBK', 'UTF-8', $v[1])));
					$v2 = iconv('GBK', 'UTF-8', $v[2]);
					$v3 =htmlspecialchars(trim(iconv('GBK', 'UTF-8', $v[3])));
					if($v0!="题号" && $v0!="题目(*)"){
						if($v0){
							$this->db->insert('answer_question',['topic'=>$v1,'answer'=>$v2,'type'=>strtoupper($v3)]);
							$_SESSION['num']=$this->db->in_id();
						}else{
							$this->db->insert('answer_answer',['qid'=>$_SESSION['num'],'a_ans'=>$v2,'a_option'=>$v3]);
						}
					}
				}			
			}

		}

		/*group page*/

		public function group(){
			return $this->db->select('answer_question');
		}
		public function clearCache(){
			unset($_SESSION['qid']);
			redirect('?f=group');
		}

		/* Anti-election  the checkbox delete this question*/
		public function del_check(){
			if(isset($_SESSION['qid']) && $_GET['id']){
				echo $_GET['id'];
				$_SESSION['qid'] = array_merge(array_diff($_SESSION['qid'], array($_GET['id'])));
			}
		}

		/*Show all questions to check select */
		public function show_question(){			
			if(isset($_SESSION['qid'])){
				array_push($_SESSION['qid'],$_POST['qid']);
			}else{
				$_SESSION['qid'] = [];
				array_push($_SESSION['qid'],$_POST['qid']);
			}
			unset($_SESSION['err']);
			$checkData=[];
			foreach (array_unique($_SESSION['qid']) as $k => $v) {
				$data=$this->db->select('answer_question',['id'=>$v]);
				$checkData[]['topic']=urlencode($data[0]['topic']).'--'.$data[0]['id'];
			}
			echo urldecode(json_encode($checkData));
			
		}
		/* Add questions to new test pager*/
		public function add_group(){
			if(isset($_SESSION['qid']) && $_POST['newTitle']){
				unset($_SESSION['err']);
				$title=$_POST['newTitle'];
				$newStr = implode(',',$_SESSION['qid']);
				$this->db->insert('answer_paper',['uid'=>1,'title'=>$title]);
				$newTestid = $this->db->in_id();
				foreach ($_SESSION['qid'] as $k => $v) {
					$this->db->insert('answer_paper_id',['paper_id'=>$newTestid,'questions_id'=>$v]);
				}
				unset($_SESSION['qid']);
				redirect('?f=group');
			}else{
				$_SESSION['err'] = '题目内容为空，暂不能提交。请勾选相关题目';
				redirect('?f=group');
			}

		}



		/*score page*/
		public function score(){
			$data=[];
			$userData=[];
			$users = $this->db->fetch($this->db->query(
				'SELECT * FROM `users`
				 INNER JOIN `user_group_users` ON `users`.id = `user_group_users`.user_id 
				 INNER JOIN `user_group` ON `user_group_users`.group_id = `user_group`.id WHERE `user_group`.`new_group` = 1  '
			));
			$type = $this->db->select('answer_type');
			foreach ($type as $t => $c) {
				foreach ($users as $k => $v) {
					$data[$t]['name'] =trim($c['type']);
					$data[$t]['type'] = 'line';
					$data[$t]['data'] = "";
					$userData[$k]['uid']= $v['user_id'];
				}
				foreach ($userData as $k1 => $v1) {
					$score = $this->db->select('answer_scores',['user_id'=>$v1['uid'],'type'=>$c['type']],' ORDER BY `answer_scores`.`id` DESC LIMIT 1');	
				}
			}
		}


		/*paper page*/
		public function paper(){
			$data=[];
			$paper = $this->db->select('answer_paper');	
			foreach ($paper as $k => $v) {
				$paperData = $this->db->select('answer_paper_id',['paper_id'=>$v['id']]);
				if(!empty($paperData)){
					foreach ($paperData as $k1 => $v1) {
						$questionData = $this->db->select('answer_question',['id'=>$v1['questions_id']])[0]['topic'];
						$data[$v['title'].'----'.$v['id']][] =$questionData;
					}
				}
			}
			return $data;
		}

		/*list page*/

		public function listPage(){
			$all =[];
			$data=[];
			$total=[];
			$scores = $this->db->fetch($this->db->query(
				'SELECT * FROM `users`
				 INNER JOIN `user_group_users` ON `users`.id = `user_group_users`.user_id '
			));
			foreach ($scores as $k => $v) {
				$group = $this->db->select('user_group',['id'=>$v['group_id'],'new_group'=>1]);
				foreach ($group as $k => $v1) {
					$score = $this->db->select('answer_scores',['user_id'=>$v['user_id']]);
/*					$type_nm = $this->db->fetch($this->db->query(
						'SELECT count(id) as nm FROM `answer_scores` WHERE `user_id` ="'.$v['user_id'].'" GROUP BY `type` limit 0,1'
					));
					$score = $this->db->fetch($this->db->query(
						'SELECT * FROM `answer_scores` WHERE `user_id` ="'.$v['user_id'].'" GROUP BY `type` HAVING count(type) > 1 ORDER BY `submit_time` DESC'
					));*/
						if(!empty($score)){
							
							$data[$group[0]['name'].'----'.$group[0]['id']][$v['username'].'----'.$v['face_url']] = $score;
						}
				}
			}
			return $data;

		}

		/*test page*/
		public function test(){
			$id = $_GET['tid'];
			$data=[];
			$topic = $this->db->select('answer_question',['type'=>"".$id.""],' ORDER BY rand() LIMIT 10');
			foreach ($topic as $k => $v){
				$an_s = $this->db->select('answer_answer',['qid'=>$v['id']]);
				$data[$v['topic'].'----'.$v['id']] = $an_s;
			}
			return $data;
		}
		public function reditScore(){
			$score = $_POST['score'];
			$type = $_POST['type']; 
			$this->db->insert('answer_scores',['user_id'=>1,'type'=>$type,'total'=>$score,'submit_time'=>time()]);
			redirect('?f=listPage');
		}

		public function rightQuestion(){
			$id = $_POST['dataId'];
			$ans = $_POST['answer'];
			$data='';
			$topic = $this->db->select('answer_question',['id'=>"".$id.""]);
			if($topic[0]['answer']==$ans){
				echo 1;
			}else{
				$data.=$topic[0]['answer'];
				echo $data;
			}
		}

		/*groupTest page*/
		public function groupTest(){
			$id = $_GET['pid'];
			$data=[];
			$types=[];
			$type = $this->db->select('answer_paper',['id'=>$id])[0]['title'];
			$group = $this->db->select('answer_paper_id',['paper_id'=>$id]);
			foreach ($group as $k => $v) {
				$qid = $v['questions_id'];
				$questions = $this->db->select('answer_question',['id'=>$qid]);
				foreach ($questions as $k1 => $v1) {
					$answer = $this->db->select('answer_answer',['qid'=>$v1['id']]);
					$data[$v1['topic'].'----'.$v1['id'].'++'.$v1['answer']][] = $answer;
					$types[$type]= $data;
				}
			}
			return $types;
		}


	}
