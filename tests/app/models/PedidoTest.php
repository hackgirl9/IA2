<?php

use PHPUnit\Framework\TestCase;


require 'app/models/Pedido.php';


class PedidoTest extends TestCase{

    protected $pedido;


    public function SetUp():void
    {
        $this->pedido= new Pedido();
        $this->pedido->setCodigoPedido('PP-000001');
        $this->pedido->setCedulaCliente('27085898');
        $this->pedido->setStatusPedido('En Proceso');
        $this->pedido->setFechaPedido('2020-01-12');
        $this->pedido->setDescripcionPedido('Pedido test');
        $this->pedido->setFechaEntregaPedido('2020-01-12');


        //Servicio
        $this->pedido->setIdServicio('1');


        //Factura
        $this->pedido->setCodigoFactura('PP-000001');
        $this->pedido->setModoPagoFactura('Efectivo');
        $this->pedido->setPorcentajeVentaFactura('20');
        $this->pedido->setIdTallas('1');




        //codigo Producto
        $this->pedido->setCodigoProducto('1');
        $this->pedido->setCantidadPrenda(2);
        $this->pedido->setPrecioServiPedido(20);

    }


    public function testGetAllPedido()
    {
        $result = $this->pedido->getAll();
        $this->assertIsArray($result);
    }

    public function testSave(){
        $result=$this->pedido->save();
        $this->assertIsBool($result);
    }

    public function testGetBy(){
        $result = $this->pedido->getBy();
        $this->assertIsObject($result);
    }


    public function testUpdate(){
        $result = $this->pedido->update();
        $this->assertIsBool($result);
    }

    public function testCheckCedula(){
        $result=$this->pedido->checkCedula();
        $this->assertIsObject($result);
    }

    public function testGeneratedNumberPedido(){
        $result=$this->pedido->generatedNumberPedido();
        $this->assertIsString($result);
    }

    public function testGetServices(){
        $result=$this->pedido->getServices();
        $this->assertIsArray($result);
    }

    public function testGetPrecioServicio(){
        $result=$this->pedido->getPrecioServicio();
        $this->assertIsNumeric($result);
    }

    public function  testGetTelas(){
        $result=$this->pedido->getTelas();
        $this->assertIsArray($result);
    }


    public function testSaveFactura(){
        $this->pedido->setCodigoPedido('P-0000002');
        $result=$this->pedido->saveFactura();
        $this->assertIsBool($result);
    }


    public function testFindProductos(){
        $result=$this->pedido->findProductos();
        $this->assertIsArray($result);
    }


    public function testSaveProPedido(){
        $result = $this->pedido->saveProPredido();
        $this->assertIsBool($result);
    }


    public function testDelete(){
        $result = $this->pedido->delete();
        $this->assertIsBool($result);
    }
}