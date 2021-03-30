<?php

class AuditoriaController extends BaseController{

    public function __construct() {
        parent::__construct(); // Heredamos el constructor de la clase BaseController
    }

    public function index(){
        $audit = new Auditoria();
        $query = $audit->getAll();

        return $this->view('Auditoria/Auditoria', ['query' => $query]);
    }

    public function getTable(){

        if(isset($_GET["id"])){ // Creamos Condicion
            $name = $_GET['id'];
            $audit = new Auditoria();
            $query = $audit->getByTable($name);

            return $this->view('Auditoria/Auditoria.Consulta', ['query' => $query, 'name' => $name]);
        }
    }

    public function system(){
        return $this->view('Ayuda/Manual.Sistema');
    }

    public function user(){
        return $this->view('Ayuda/Manual.Usuario');
    }

    public function installed(){
        return $this->view('Ayuda/Manual.Instalacion');
    }

    public function verifyPasswordEspecial (){
        $nick = $_SESSION['nick_usuario'];
        $password = $_POST['contrasenia_especial'];

        $user = new Usuario();
        $user->setNickUsuario($nick);

        $response = $user->verifyPasswordEspecial($password);

        $this->sendAjax($response);

    }
}