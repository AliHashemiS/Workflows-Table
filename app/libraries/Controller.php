<?php
	/**
	 * Class Controller
	 * Main class used for all controllers in the project
	 */
	class Controller
	{
		/**
		 * Dynamic model loader
		 * @param $model
		 * @return mixed
		 */
		public function loadModel($model)
		{
			require_once '../app/models/' . $model . '.php';
			return new $model();
		}
		
		/**
		 * Dynamic view loader
		 * @param $view
		 * @param array $data
		 */
		public function render($view, $data = [])
		{
			if (file_exists('../app/views/' . $view . '.php'))
			{
				echo "<link rel='stylesheet' href='./assets/css/style.css'>"; // add global styles
				require_once '../app/views/' . $view . '.php';
			} else {
				$this->renderError(424);
			}
		}

        /**
         * Dynamic error view loader
         * @param number $codeError
         * @param string $titleError
         */
        public function renderError($codeError = 520, $titleError = "Something has gone wrong")
        {
            $data = [
                'headTitle' => $titleError,
                'cssFile' => 'errors',
                "errorCode" => $codeError
            ];
            die($this->render('errors', $data));
        }
	}