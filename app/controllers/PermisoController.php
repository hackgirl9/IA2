<?php
	class PermisoController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Permisos/Permisos');
		}

		public function create() {

		}

		public function manage() {
			// $idRol = $_GET['id'];
			// $permiso = new Permiso();
			// $allPermisosXRol = $permiso->getAllPermisosXRol($idRol);
			// $this->view('Permisos/Permisos', [
			// 	'allPermisosXRol' => $allPermisosXRol
			// ]);
		}

		public function getAll() {
			$permiso = new Permiso();
			$allPermisos = $permiso->getAll();
			$this->view('Seguridad/Permisos', [
				'allPermisos' => $allPermisos
			]);
		}

		public function register() {
			// if($_POST) {
			// 	// var_dump(json_encode($_POST)); die();
			// 	$idRol = $_POST['id_rol'];/* $this->input('id_rol', true, 'int');*/
			// 	$idModulo = $_POST['id_modulo'];/*$this->input('id_modulo', true, 'int');*/
			// 	$idPermiso = $_POST['id_permiso'];/*$this->input('id_permiso', true, 'int');*/
			// 	if($this->validateFails()) { // Si la validacion falla
			// 		// var_dump($_POST);
			// 		$this->redirect('Permiso','create', ['id' => $idRol]); // Redirecciona al inicio.
			// 	}
			// 	else {
			// 		$rol = new Rol();
			// 		for($i = 0; $i < count($idPermiso); $i++) {
			// 			$rol->setIdRol($idRol);
			// 			$rol->setIdPermiso($idPermiso[$i]);
			// 			$rol->setIdModulo($idModulo);
			// 			var_dump($idRol); var_dump($idPermiso[$i]); var_dump($idModulo[$i]);
			// 			echo "<br>";
			// 			$dataRolXPermiso = $rol->saveRolXPermisos();
			// 			if(is_object($dataRolXPermiso)){
			//             	break;
			// 				$this->sendAjax($dataRolXPermiso);
			//             }
			// 		}
			// 		// for ($i = 0; $i < count($idModulo); $i++) {
			// 		// 	$rol->setIdRol($idRol);
			// 		// 	$dataRolXModulo = $rol->saveRolXModulos();
			// 		// 	if(is_object($dataRolXPermiso)){
			//   //           	break;
			// 		// 		$this->sendAjax($dataRolXModulo);
			//   //           }
			// 		// }

			// 	}
			// 		var_dump($dataRolXPermiso);
			// 		var_dump($dataRolXModulo);

		}

		public function update() {

		}

		public function delete() {

		}
	}
