<?php

    class Index extends Controller {

		private $userModel;

		public function __construct() {
			$this->userModel = $this->loadModel('user');
		}
		
		public function index() {
			$this->render('login');
		}

		public function login() {
			$data = [
                'inputEmail' => '',
                'inputPassword' => '',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'inputEmail' => trim($_POST['inputEmail']),
                    'inputPassword' => trim($_POST['inputPassword']),
                ];

                $loggedInUser = $this->userModel->login($data['inputEmail'], $data['inputPassword']);

                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                } else {  
                    $result = [
						'success' => false,
						'message' => "Usuario o password incorrectos"
					];
					return $this->sendResponse($result,404);
                }
                $result = [
                    'success' => false,
                    'message' => "Se logeo correctamente"
                ];
                return $this->sendResponse($result,200);
            }
		}

		public function createUserSession($loggedInUser) {
            $_SESSION['id_user'] = $loggedInUser->id;
        }

		public function logout() {
			unset($_SESSION['id_user']);
            unset($_SESSION['email']);
            header('Location: /index');
		}
	}
