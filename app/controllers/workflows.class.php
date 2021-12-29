<?php

	class Workflows extends Controller {

		private $workflowModel;

		public function __construct() {
			$this->workflowModel = $this->loadModel('Workflow');
		}
		
		public function index() {
			if(isLoggedIn()){
				$result = [
					'workflows' => []
				];
	
				$data = [
					'id_user' => trim($_SESSION['id_user'])
				];
	
				$result['workflows'] = $this->workflowModel->getAll($data);
				
				
				$this->render('workflows',$result);
			}
			else{
				$this->renderError("error");
			}
			
		}

		public function delete() {
			$this->render('workflows');
		}

		public function create() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){
				$data = [
					'id_user' => trim($_SESSION['id_user']),
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description'])
                ];
				
				$result = [
					'success' =>'',
					'workflows' => [],
					'error' => ''
				];

				if($this->workflowModel->create($data)){
					$result['success'] = "El tablero ".$data['name']." ha sido creado correctament!";
				}else{
					$result['error'] = "El tablero ".$data['name']." no se puedo crear!";
				}
				
				$result['workflows'] = $this->workflowModel->getAll($data);

				$this->render('workflows',$result);
			}else{
				$this->renderError("error");
			}
			
		}

		public function show() {
			$this->render('workflows');
		}

	}
