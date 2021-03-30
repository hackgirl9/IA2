<?php
	class ModuloController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {

		}

		public function create() {

		}

		public function getAll() {
	        $modulo = new Modulo();
	        $allModulos = $modulo->getAll();
	        $this->view('Seguridad/Modulos', [
	        	'allModulos' => $allModulos
	        ]);
    	}

		public function register() {

		}

		public function update() {

		}

		public function delete() {

		}
	}
