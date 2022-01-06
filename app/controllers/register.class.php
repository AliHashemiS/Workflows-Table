<?php

	class Register extends Controller {

		private $userModel;

		public function __construct() {
			$this->userModel = $this->loadModel('user');
		}
		
		public function index() {
			$this->render('register');
		}

		public function register() {

			$data = [
                'userEmail' => '',
                'userPass' => '',
            ];

			if($_SERVER['REQUEST_METHOD'] == 'POST'){	
				if(isset($_POST['userEmail']) && isset($_POST['userPass'])){

					$data = [
						'userEmail' => trim($_POST['userEmail']),
						'userPass' => trim($_POST['userPass']),
					];
					
					if($this->userModel->findUserbyEmail($data['userEmail'])){
						$result = [
							'success' => false,
							'message' => "El email ya existe"
						];
						return $this->sendResponse($result,404);
                    }else{
						$object = $this->userModel->register($data);
						$result = [
							'success' => true,
							'data' => $object,
							'message' => "El Usuario ".$data['userEmail']." ha sido creado correctamente!"
						];
						return $this->sendResponse($result,200);
					}
				}
			}
		}
	}
