<?php

	class StikyNotes extends Controller {

		private $stikyNoteModel;

		public function __construct() {
			$this->stikyNoteModel = $this->loadModel('Stikynote');
		}

		public function create() {
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()){	
				if(isset($_POST['id_column']) && isset($_POST['content']) && isset($_POST['priority'])){

					$data = [
						'id_column' => trim($_POST['id_column']),
						'content' => trim($_POST['content']),
						'priority' => trim($_POST['priority'])
					];
					
					$object = $this->stikyNoteModel->create($data);
					$result = [
						'success' => true,
						'data' => $object,
						'message' => "La stiky note ha sido creado correctamente!"
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
					$content = null;
					if(isset($_POST['content'])){
						$content = trim($_POST['content']);
					}

					$color = null;
					if(isset($_POST['color'])){
						$color = trim($_POST['color']);
					}

					$priority = null;
					if(isset($_POST['priority'])){
						$priority = trim($_POST['priority']);
					}

					$id_column = null;
					if(isset($_POST['id_column'])){
						$id_column = trim($_POST['id_column']);
					}

					if($this->stikyNoteModel->update($id,$content,$color,$priority,$id_column)){
						$result = [
							'success' => true,
							'message' => "El stiky note ha sido actualizada"
						];
						return $this->sendResponse($result,200);
					}
					$result = [
						'success' => false,
						'message' => "Es necesario el id de El stiky note"
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
					if($this->stikyNoteModel->delete(trim($id))){
						$result = [
							'success' => true,
							'message' => "Stiky note eliminada"
						];
						return $this->sendResponse($result,200);
					}else{
						$result = [
							'success' => false,
							'message' => "No se pudo eliminar la Stiky Note"
						];
						return $this->sendResponse($result,400);
					}
				}else{
					$result = [
						'success' => false,
						'message' => "Es necesario especificar el id del Stiky Note"
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
