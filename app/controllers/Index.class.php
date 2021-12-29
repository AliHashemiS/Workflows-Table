<?php

	class Index extends Controller {

		public function __construct() {
			$this->loadModel('user');
		}
		

		public function index() {
			$this->render('login');
		}


		public function logout() {
			
			//aqui se elimina la sesión del usuario

			$this->render('login');
		}
	}
