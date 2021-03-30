<?php

class PedidoController extends BaseController
{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->view('Pedidos/Pedidos');
    }

    public function create()
    {
        Helpers::hasPermissions('3','1',true,'Pedido');
        $pedido = new Pedido();
        $services = $pedido->getServices();


        $producto = new Producto(); // Instancia el objeto
        $productos = $pedido->productoAll();



        $this->view('Pedidos/Pedidos.Registrar', ['services' => $services, "productos"=>$productos]);
    }

    public function getAll()
    {
        Helpers::hasPermissions('3','2',true,'Pedido');
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        $this->view('Pedidos/Pedidos.Consultar', ['pedidos' => $pedidos]);
    }

    public function register()
    {
        $pedido = new Pedido();
        $cedulaCliente = $this->input('cedula_cliente');
        $codigoPedido = $pedido->generatedNumberPedido();
        $fechaPedido = date('d-m-Y');
        $fechaEntregaPedido = $this->input('fecha_entrega_pedido');
        $descripcionPedido = $this->input('descripcion_pedido');
        $productos = $this->input('productos');
        $servicios=$this->input('servicio');


        $pedido->setCedulaCliente($cedulaCliente);
        $pedido->setFechaEntregaPedido($fechaEntregaPedido);
        $pedido->setFechaPedido($fechaPedido);
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setStatusPedido("En Proceso");
        $pedido->setDescripcionPedido($descripcionPedido);
        $band=$pedido->save();


        if(!is_null($productos)&&count($productos)>=1) {
            foreach ($productos as $producto) {
                $pedido->setCodigoProducto($producto["codigo_producto"]);
                $pedido->setCantidadPrenda($producto["cant_pro_pedidos"]);
                $pedido->setIdTallas($producto["id_talla"]);
                $save = $pedido->verifyProduct();
                if (is_object($save)) {
                    return $this->sendAjax(["status" => 'error', "message"=>"El producto con el codigo " .
                        $producto["codigo_producto"] .
                        " no cuenta con el stock suficiente para realizar un pedido"
                    ]);
                }
            }
            foreach ($productos as $producto) {
                $pedido->setCodigoProducto($producto["codigo_producto"]);
                $pedido->setCodigoPedido($codigoPedido);
                $pedido->setCantidadPrenda($producto["cant_pro_pedidos"]);
                $pedido->setPrecioServiPedido($producto["precio_producto"]);
                $pedido->setIdTallas($producto["id_talla"]);
                $pedido->setNombreTalla($producto["nombre_talla"]);
                $save = $pedido->saveProPredido();
            }
        }

        if(!is_null($servicios)&&count($servicios)>=1){
            foreach ($servicios as $serviPedido) {
                $pedido->setIdServicio($serviPedido['id']);
                $pedido->setCodigoPedido($codigoPedido);
                $pedido->setCantidadPrenda($serviPedido['cant_prenda']);
                $pedido->setCantidadMedida($serviPedido['cant_medida']);
                $pedido->setPrecioServiPedido($serviPedido['precio_servicio']);
                $pedido->setIdTela($serviPedido['id_tela']);
                $save = $pedido->saveServiPedido();
            }
        }
        $codigoFactura = $pedido->generateNumberFactura();
        $modoPagoFactura = $this->input('modo_pago_factura');
        $porcentajeVentas = $this->input('porcentaje_pago_factura');
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setCodigoFactura($codigoFactura);
        $pedido->setModoPagoFactura($modoPagoFactura);
        $pedido->setPorcentajeVentaFactura($porcentajeVentas);
        $save = $pedido->saveFactura();
        return $this->sendAjax(["status"=>"success" ,"message"=> "Pedido creado correctamente."]);

    }

    public function details()
    {

        Helpers::hasPermissions('3','5',true,'Pedido');
        $codigoPedido = $_GET['id'];
        $pedido = new Pedido();
        $pedido->setCodigoPedido($codigoPedido);
        $pedido_find = $pedido->getBy();
        $telas = $pedido->getTelas();
        $servicios_find = $pedido->getServicicio();
        $productos_find = $pedido->getProductos();

        $this->view('Pedidos/Pedidos.Detalles',
            ['pedido' => $pedido_find,
                'servicios' => $servicios_find,
                'telas' => $telas,
                'productos' => $productos_find
            ]);

    }

    public function delete()
    {
        $pedido = new Pedido();
        $codigoPedido = $_GET['id'];
        $pedido->setCodigoPedido($codigoPedido);
        $deletePedido = $pedido->delete();
        $this->sendAjax($deletePedido);
    }


    public function saveServiPedido()
    {
        $data = $this->input('json');
        $pedido = new Pedido();
        foreach ($data as $serviPedido) {
            $pedido->setIdServicio($serviPedido['id']);
            $pedido->setCodigoPedido($serviPedido['codigo_pedido']);
            $pedido->setCantidadPrenda($serviPedido['cant_prenda']);
            $pedido->setCantidadMedida($serviPedido['cant_medida']);
            $pedido->setPrecioServiPedido($serviPedido['precio_servicio']);
            $pedido->setIdTela($serviPedido['id_tela']);
            $save = $pedido->saveServiPedido();
        }

        $this->sendAjax($save);
    }


    public function verifyCedula()
    {
        $cedulaCliente = $this->input('cedula_cliente');
        $pedido = new Pedido();
        $pedido->setCedulaCliente($cedulaCliente);
        $cliente = $pedido->checkCedula();
        isset($cliente->nombre_cliente)?$cliente->nombre_cliente=Helpers::aesDecrypt($cliente->nombre_cliente):null;
        $this->sendAjax($cliente);
    }


    public function getTelas()
    {
        $pedido = new Pedido();
        $telas = $pedido->getTelas();
        $services = $pedido->getServices();
        $this->sendAjax(["telas" => $telas, "services" => $services]);
    }


    public function registerFactura()
    {
        $pedido = new Pedido();
        $codigoFactura = $pedido->generateNumberFactura();

        $codigoPedido = $this->input('codigo_pedido');
        $modoPagoFactura = $this->input('modo_pago_factura');
        $porcentajeVentas = $this->input('porcentaje_pago_factura');
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setCodigoFactura($codigoFactura);
        $pedido->setModoPagoFactura($modoPagoFactura);
        $pedido->setPorcentajeVentaFactura($porcentajeVentas);
        $save = $pedido->saveFactura();
        $this->sendAjax($save);
    }


    public function productosFind()
    {
        $pedido = new Pedido();
        $find = $this->input("codigo_producto");
        $talla = $this->input("talla");
        $pedido->setCodigoProducto($find);
        $pedido->setIdTallas($talla);


        $productos = $pedido->findProductos();
        $this->sendAjax($productos);
    }

    public function registerProducto()
    {
        $codigo_producto = $this->input('codigo_producto');
        $cant_pro_pedida = $this->input('cant_pro_pedida');
        $precio_pro=$this->input('precio');
        $codigo_pedido = $this->input('codigo_pedido');
        $id_talla = $this->input('id_talla');

        $pedido = new Pedido();
        for ($i = 0; $i < count($codigo_producto);$i++){
            $pedido->setCodigoProducto($codigo_producto[$i]);
            $pedido->setCantidadPrenda($cant_pro_pedida[$i]);
            $pedido->setIdTallas($id_talla[$i]);
            $save = $pedido->verifyProduct();

            if(is_object($save)){
                break;
            }
        }


        if(!is_object($save)){
            for ($i = 0; $i < count($codigo_producto);$i++){
                $pedido->setCodigoProducto($codigo_producto[$i]);
                $pedido->setCodigoPedido($codigo_pedido);
                $pedido->setCantidadPrenda($cant_pro_pedida[$i]);
                $pedido->setPrecioServiPedido($precio_pro[$i]);
                $pedido->setIdTallas($id_talla[$i]);
                $save = $pedido->saveProPredido();
            }

            $save=['status'=>'success'];
        }else{
            $save=['status'=>'error','producto'=>$save];
        }

        $this->sendAjax($save);
    }


    public function update()
    {
        $codigoPedido = $this->input('codigo_pedido');
        $cedulaCliente = $this->input('cedula_cliente');
        $fechaPedido = $this->input('fecha_pedido');
        $fechaEntregaPedido = $this->input('fecha_entrega_pedido');
        $statusPedido = $this->input('status_pedido');
        $descripcionPedido = $this->input('descripcion_pedido');

        $codigoProducto = $this->input('codigo_producto');
        $cant_producto_pedido = $this->input('cant_producto_pedido');


        $pedido = new Pedido();
        $pedido->setCedulaCliente($cedulaCliente);
        $pedido->setFechaEntregaPedido($fechaEntregaPedido);
        $pedido->setFechaPedido($fechaPedido);
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setStatusPedido($statusPedido);
        $pedido->setDescripcionPedido($descripcionPedido);

        $pedido->update();


        $id_servicio = $this->input('id_servicio');
        $cantidadPrenda = $this->input('cantidad_prenda');
        $cantidadMedida = $this->input('cantidad_medida');
        $idTela = $this->input('id_tela');



        if(!is_null($id_servicio)){
            for ($i = 0; $i < count($id_servicio); $i++) {
                $pedido->setIdServicio($id_servicio[$i]);
                $pedido->setCantidadPrenda($cantidadPrenda[$i]);
                $pedido->setCantidadMedida($cantidadMedida[$i]);
                $pedido->setIdTela($idTela[$i]);
                $pedido->updateServiPedido();
            }
        }


        if(!is_null($cant_producto_pedido)){
            for ($i = 0; $i < count($cant_producto_pedido); $i++) {
                $pedido->setCantidadPrenda($cant_producto_pedido[$i]);
                $pedido->setCodigoProducto($codigoProducto[$i]);
                $pedido->updateProducto();
            }
        }
        $_SESSION['message']=true;
        header('Location:'.BASE_URL.'Pedido/details/'.$codigoPedido);
    }


    public function checkStock(){
        $codigoProducto=$this->input('codigo_producto');
        $cantProPedidos=$this->input('cant_pro_pedidos');
        $idTalla=$this->input('id_talla');

        $pedido=new Pedido();
        $pedido->setCodigoProducto($codigoProducto);
        $pedido->setCantidadPrenda($cantProPedidos);
        $pedido->setIdTallas($idTalla);

        $save = $pedido->verifyProduct();
        if (is_object($save)) {
            return $this->sendAjax(["status" => 'error', "message"=>
                "El producto con el codigo " .
                $codigoProducto .
                " no tiene el stock ingresado"
            ]);
        }

      return $this->sendAjax(["status" => 'success', "Tiene stock"]);

    }

}
