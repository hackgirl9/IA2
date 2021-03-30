<?php
    class ErrorController extends BaseController{
        public function index(){
            // echo "Error 404 pagina no encontrada.< INSERTAR PAGINA BONITA AQUI >:(";
            $this->view('Error/Error.404');

        }

        public function error404() {
            $this->view('Error/Error.404');
        }

        public function error500() {
            $this->view('Error/Error.500');
        }

        public function failedLogin() {
            $this->view('Error/Error.FailedLogin');
        }
}