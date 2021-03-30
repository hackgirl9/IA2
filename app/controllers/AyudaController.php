<?php

class AyudaController extends BaseController{

    public function index(){
        return $this->view('Ayuda/Ayuda');
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
}