<?php

	class Index extends Controller {

		public function __construct() {
		
		}
		
		// ruta index
		public function index() {
			$this->render('login');
		}

		// ruta undex/test
		public function test() {
			$this->render('test');
		}


	}
