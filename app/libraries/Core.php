<?php

	require_once 'Dotenv.php';

	(new Dotenv('../.env'))->load();

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	/**
	 * App Core Class
	 * Creates URL & loads core controller
	 * URL FORMAT - /controller/method/params
	 */
	class Core {
		protected $currentController = 'Index';
		protected $currentMethod = 'index';
		protected $params = [];
		
		public function __construct(){
			$url = $this->getUrl();
			
			// Search the first controller whit the name
			if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]). '.class.php')){
				// if exist, define current controller
				$this->currentController = ucwords($url[0]);
				// delete the first value in url array
				unset($url[0]);
			} else if(isset($url[0])) {
                $data = ['headTitle' => 'Not found', 'cssFile' => 'errors', "errorCode" => 404 ];
                die(require_once("../app/views/errors.php"));
            }
			
			// import controller selected
			require_once '../app/controllers/'. $this->currentController . '.class.php';
			
			// instnace the controller
			$this->currentController = new $this->currentController;
			// verify the second value of array 
			if(isset($url[1])){
				// verify if the method exist in the selected controller 
				if(method_exists($this->currentController, $url[1])){
					$this->currentMethod = $url[1];
					// Unset l'index 1
					unset($url[1]);
				}
			}
			
			// get params from url
			$this->params = $url ? array_values($url) : [];
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}
		
		public function getUrl(){
			
			$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$requestString = parse_url($requestUrl);
			$url = $requestString['path'];
			$url = ltrim($url, '/');

			if(isset($url) && strlen($url) > 0){

				$url = rtrim($url, '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
			
			return false;
		}
	}