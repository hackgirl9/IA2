<?php

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        //var_dump($_SESSION['permissions'][1]);

        /**Blowfish**/

        $this->view('Sistema/Home');

        /*$this->sendAjax($ingreso);*/

    }

    public function account()
    {
        $this->view('Sistema/Profile');
    }

    public function settings()
    {

    }

    public function dashboard()
    {

        $get = new Estadistica();

        $producto = $get->producto();
        $pedido = $get->pedido();
        $servicio = $get->servicio();
        $cliente = $get->cliente();
        $factura = $get->factura();
        $get->registrarBitacora();

        if ($cliente == null) {
            $cliente = 0;
        }


        $this->view('Sistema/Estadistica', ['producto' => $producto,
            'pedido' => $pedido,
            'servicio' => $servicio,
            'cliente' => $cliente,
            'factura' => $factura,
        ]);

    }

    public function ingreso()
    {

        $estadistica = new Estadistica();
        $ingreso = $estadistica->ingreso();
        $this->sendAjax($ingreso);

    }

}
