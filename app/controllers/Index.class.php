<?php

	class Index extends Controller {

		public function __construct() {
		
		}
		
		// ruta index
		public function index() {
			$this->render('login');
		}

		// ruta index/test
		public function register() {
			$this->render('register');
		}


	}
