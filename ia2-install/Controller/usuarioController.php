<?php


require_once ("Model/usuario.php");
$usuario= new Usuario();

$passwordEncriptada=password_hash(1234,PASSWORD_DEFAULT,array("cost"=>12));
$especialEncriptada=password_hash(1234,PASSWORD_DEFAULT,array("cost"=>12));
$band=$usuario->register('root','admin','admin','admin@admin.com',$passwordEncriptada,$especialEncriptada,'1');

if($band){
    echo "Usuario Registro con  Exitoso.)";
}else{
    echo "el Usuario ya esta registrado.";
}


