<?php


use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Cliente.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='YohnnD';

class ClienteTest extends TestCase{

    protected $cliente;

    public function SetUp():void
    {
        $this->cliente= new Cliente();

        $this->cliente->setCedulaCliente('12027858');
        $this->cliente->setTipoDocumentoCliente('V');
        $this->cliente->setNombreCliente('UPTAEB');
        $this->cliente->setDescripcionCliente('Este es un cliente');
        $this->cliente->setDireccionCliente('Barrio el jebe, sector propatria');
        $this->cliente->setTelefonoCliente('04165539754');
        $this->cliente->setRepresentanteCliente('Yohnneiber Diaz');
    }


    public function testGetAllCliente()
    {
        $result = $this->cliente->getAll();
        $row = array_values($result);
        $row = $row[0];
        $this->assertIsString($row->cedula_cliente);
        $this->assertIsString($row->tipo_documento_cliente);
        $this->assertIsString($row->descripcion_cliente);
        $this->assertIsString($row->telefono_cliente);
        $this->assertIsString($row->representante_cliente);
    }

    public function testSave(){
        $result=$this->cliente->save();
        $this->assertIsBool($result);
    }

    public function testGetBy(){
        $result = $this->cliente->getBy();
        $this->assertIsObject($result);
    }

    public function testCheckCedula(){
        $result = $this->cliente->checkCedula();
        $this->assertIsBool($result);
    }

    public function testUpdate(){
        $result = $this->cliente->update();
        $this->assertIsBool($result);
    }


    public function testDelete(){
        $result = $this->cliente->delete();
        $this->assertIsBool($result);
    }

















}

