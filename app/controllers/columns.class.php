<?php

	class Columns extends Controller {

		private $columnModel;

		public function __construct() {
			$this->columnModel = $this->loadModel('Column');
		}

		public function create() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){	
				if(isset($_POST['id_workflow']) && isset($_POST['title']) && isset($_POST['priority'])){

					$data = [
						'id_workflow' => trim($_POST['id_workflow']),
						'title' => trim($_POST['title']),
						'priority' => trim($_POST['priority'])
					];
					
					$object = $this->columnModel->create($data);
					$result = [
						'success' => true,
						'data' => $object,
						'message' => "La columna ha sido creado correctamente!"
					];
					return $this->sendResponse($result,200);
				}
				else{
					$result = [
						'success' => false,
						'message' => "Faltan Valores"
					];
					return $this->sendResponse($result,404);
				}
			}
			$result = [
				'success' => false,
				'message' => "Necesita estar logueado"
			];
			return $this->sendResponse($result,401);
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

					if($this->columnModel->update($id,$title,$priority)){
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

		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isLoggedIn()){
				if(isset($id)){
					if($this->columnModel->delete(trim($id))){
						$result = [
							'success' => true,
							'message' => "Columna eliminada"
						];
						return $this->sendResponse($result,200);
					}else{
						$result = [
							'success' => false,
							'message' => "No se pudo eliminar la columna"
						];
						return $this->sendResponse($result,400);
					}
				}else{
					$result = [
						'success' => false,
						'message' => "Es necesario especificar el id del columna"
					];
					return $this->sendResponse($result,404);
				}
			}
			$result = [
				'success' => false,
				'message' => "Necesita estar logueado"
			];
			return $this->sendResponse($result,401);
		}

	}
