<?php

	class Columns extends Controller {

		private $columnModel;

		public function __construct() {
			$this->workflowModel = $this->loadModel('Column');
		}


		public function update($id){
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){	
				if(isset($id)){
					$title = null;
					if(isset($_POST['title'])){
						$title = trim($_POST['title']);
					}

					$priority = null;
					if(isset($_POST['priority'])){
						$priority = trim($_POST['priority']);
					}

					if($this->workflowModel->update($id,$title,$priority)){
						$result = [
							'success' => true,
							'message' => "La columna ha sido actualizada"
						];
						return $this->sendResponse($result,200);
					}
					$result = [
						'success' => false,
						'message' => "Es necesario el id de la columna"
					];
					return $this->sendResponse($result,400);
				}
			}
			$result = [
				'success' => false,
				'message' => "Es necesario iniciar sesión"
			];
			return $this->sendResponse($result,401);

		}
	}
