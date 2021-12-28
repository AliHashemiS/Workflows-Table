<?php

	class Index extends Controller {

		public function __construct() {
			$this->loadModel('user');
		}
		

		public function index() {
			$this->render('login');
		}

	}
