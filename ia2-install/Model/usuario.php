<?php

require_once ("conexion.php");
class Usuario extends Conexion {
    private $db;
    private $conexion;


    public function __construct(){
        parent::__construct();
    }


    public function register($nickUsuario,$nombreUsuario,$apellidoUsuario,$emailUsuario,$contraseniaUsuario, $contraseniaEpecial ,$idRol){
        $band=true;

        $result=$this->dbConexion->query("SELECT * FROM usuarios WHERE nick_usuario='$nickUsuario'");

        if($result->rowCount()>=1){
            $band=false;
        }else{
            $resultRegister=$this->dbConexion->query("
                INSERT INTO usuarios VALUES ('$nickUsuario','$nombreUsuario','$apellidoUsuario','$emailUsuario', '0' ,'$contraseniaUsuario', '$contraseniaEpecial' ,'$idRol')");
            $band=true;
        }
        return $band;
    }
}