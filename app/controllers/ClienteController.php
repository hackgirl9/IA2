<?php
class ClienteController extends BaseController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view('Clientes/Clientes');
    }

    public function create() {
        Helpers::hasPermissions('4','1',true,'Cliente');
        $this->view('Clientes/Clientes.Registrar');
    }

    public function getAll() {
        Helpers::hasPermissions('4','2',true,'Cliente');
        $cliente= new Cliente();
        $clientes=$cliente->getAll();
        $this->view('Clientes/Clientes.Consultar',["clientes"=>$clientes]);
    }

    public function verifyCedula(){
        $cedulaCliente=$this->input('cedula_cliente');
        $cliente= new Cliente();
        $cliente->setCedulaCliente($cedulaCliente);
        $response=$cliente=$cliente->checkCedula();
        $this->sendAjax($response);
    }
    public function register() {
        $cedulaCliente=$this->input('cedula_cliente');
        $tipoDocumento=$this->input('tipo_documento_cliente');
        $nombreCliente=$this->input('nombre_cliente');
        $descripcionCliente=$this->input('descripcion_cliente');
        $direccionCliente=$this->input('direccion_cliente');
        $telefonoCliente=$this->input('telefono_cliente');
        $representanteCliente=$this->input('representante_cliente');



        $cliente= new Cliente();
        $cliente->setCedulaCliente($cedulaCliente);
        $cliente->setTipoDocumentoCliente($tipoDocumento);
        $cliente->setNombreCliente($nombreCliente);
        $cliente->setDescripcionCliente($descripcionCliente);
        $cliente->setDireccionCliente($direccionCliente);
        $cliente->setTelefonoCliente($telefonoCliente);
        $cliente->setRepresentanteCliente($representanteCliente);
        $data = $cliente->save();
        $this->sendAjax($data);
    }

    public function details() {
        Helpers::hasPermissions('5','2',true,'Cliente');
        $cedula=$_GET['id'];
        $cliente= new Cliente();
        $cliente->setCedulaCliente($cedula);
        $cliente=$cliente->getBy();
        $this->view('Clientes/Clientes.Detalles',["cliente"=>$cliente]);
    }

    public function update() {
        $cedulaCliente=$this->input('cedula_cliente');
        $tipoDocumento=$this->input('tipo_documento_cliente');
        $nombreCliente=$this->input('nombre_cliente');
        $descripcionCliente=$this->input('descripcion_cliente');
        $direccionCliente=$this->input('direccion_cliente');
        $telefonoCliente=$this->input('telefono_cliente');
        $representanteCliente=$this->input('representante_cliente');
        $cliente= new Cliente();

        $cliente->setCedulaCliente($cedulaCliente);
        $cliente->setTipoDocumentoCliente('R');
        $cliente->setNombreCliente($nombreCliente);
        $cliente->setDescripcionCliente($descripcionCliente);
        $cliente->setDireccionCliente($direccionCliente);
        $cliente->setTelefonoCliente($telefonoCliente);
        $cliente->setRepresentanteCliente($representanteCliente);
        $data = $cliente->update();
        $this->sendAjax($data);
    }

    public function delete() {
        $cedula=$_POST['cedula_cliente'];
        $cliente= new Cliente();
        $cliente->setCedulaCliente($cedula);
        $cliente=$cliente->delete();
        $this->sendAjax($cliente);
    }
}
