<?php

	class Workflows extends Controller {

		private $workflowModel;

		public function __construct() {
			$this->workflowModel = $this->loadModel('Workflow');
		}
		
		public function index() {
			if(isLoggedIn()){
				$result = [
					'workflows' => []
				];
	
				$data = [
					'id_user' => trim($_SESSION['id_user'])
				];
	
				$result['workflows'] = $this->workflowModel->getAll($data);
				
				
				$this->render('workflows',$result);
			}
			else{
				$this->renderError("error");
			}
			
		}

		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isLoggedIn()){
				if(isset($id)){
					if($this->workflowModel->delete(trim($id))){
						$result = [
							'success' => true,
							'message' => "El tablero ha sido eliminado!"
						];
						return $this->sendResponse($result,200);
					}else{
						$result = [
							'success' => false,
							'message' => "El tablero no se pudo eliminar"
						];
						return $this->sendResponse($result,400);
					}
				}else{
					$result = [
						'success' => false,
						'message' => "Es necesario especificar el id del tablero"
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

		public function create() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){	
				if(isset($_POST['description']) && isset($_POST['name'])){

					$data = [
						'id_user' => trim($_SESSION['id_user']),
						'name' => trim($_POST['name']),
						'description' => trim($_POST['description'])
					];
					
					$object = $this->workflowModel->create($data);
					$result = [
						'success' => true,
						'data' => $object,
						'message' => "El tablero ".$data['name']." ha sido creado correctamente!"
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

		public function show($id) {
			$workflow = $this->workflowModel->find($id);

			$data = [
				'id' => $id,
				'name' => $workflow->name,
				'description' => $workflow->description,
				'columns' => $workflow->columns
			];
			
			$this->render('workflows.show',$data);
		}

		public function update($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){	
				if(isset($_POST['description']) || isset($_POST['name'])){

					if($this->workflowModel->update($id, $_POST['name'], $_POST['description'])){
						$result = [
							'success' => true,
							'message' => "El tablero ha sido actualizado"
						];
					}else{
						$result = [
							'success' => false,
							'message' => "Ha ocurrido un error al actualizar el tablero."
						];
					}
					return $this->sendResponse($result,200);
				}
				$result = [
					'success' => false,
					'message' => "Paramatros vacios"
				];
				return $this->sendResponse($result,404);
			}
			$result = [
				'success' => false,
				'message' => "Es necesario estar logueado"
			];
			return $this->sendResponse($result,404);
		}

	}
