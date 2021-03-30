<?php

class Factura extends BaseModel {

    // Atributos
    private $codigo_factura;
    private $codigo_pedido;
    private $fecha_factura;
    private $modo_pago_factura;
    private $porcentaje_venta_factura;
    private $status_factura;
    private $table;

    // Métodos
    public function __construct() {
        parent::__construct();
        $this->table = "factura_ventas";
    }

    public function getCodigoFactura() {
        return $this->codigo_factura;
    }

    public function setCodigoFactura($codigo_factura) {
        $this->codigo_factura = $codigo_factura;

        return $this;
    }

    public function getCodigoPedido() {
        return $this->codigo_pedido;
    }

    public function setCodigoPedido($codigo_pedido) {
        $this->codigo_pedido = $codigo_pedido;

        return $this;
    }

    public function getFechaFactura() {
        return $this->fecha_factura;
    }

    public function setFechaFactura($fecha_factura) {
        $this->fecha_factura = $fecha_factura;

        return $this;
    }

    public function getModoPagoFactura() {
        return $this->modo_pago_factura;
    }

    public function setModoPagoFactura($modo_pago_factura) {
        $this->modo_pago_factura = $modo_pago_factura;

        return $this;
    }

    public function getPorcentajeVentaFactura() {
        return $this->porcentaje_venta_factura;
    }

    public function setPorcentajeVentaFactura($porcentaje_venta_factura) {
        $this->porcentaje_venta_factura = $porcentaje_venta_factura;

        return $this;
    }

    public function getStatusFactura() {
        return $this->status_factura;
    }

    public function setStatusFactura($status_factura) {
        $this->status_factura = $status_factura;

        return $this;
    }

    public function getAll() {
		$sql = "SELECT * FROM $this->table";
        $query = $this->db()->query($sql);
        if($query){ // Evalua la cansulta
            if($query->rowCount() != 0) { // Si existe al menos un registro...
                while($row = $query->fetch(PDO::FETCH_OBJ)) { // Recorre un array (tabla) fila por fila.
                    $resultSet[] = $row; // Llena el array con cada uno de los registros de la tabla.
                }
            }
            else{ // Sino...
                $resultSet = null; // Almacena null
            }
        }
		return $resultSet; // Finalmente retornla el arreglo con los elementos.
    }

    public function getOne() {
        $this->registerBitacora(FACTURAS,DETALLES);

        $rowProducto = 0;

        $factura = $this->db()->query("SELECT * FROM $this->table WHERE codigo_factura = '$this->codigo_factura'");

        if ($factura && $factura->rowCount() != 0) {// Evalua la cansulta
            $rowFactura = $factura->fetchObject();
            $p = $rowFactura->codigo_pedido;
        } else { //
            $rowFactura = 0;
        }


        if ($rowFactura !== 0) {

            $pedido = $this->db()->query("SELECT * FROM pedidos WHERE codigo_pedido = '$p'");

            if ($pedido && $pedido->rowCount() != 0) {// Evalua la cansulta
                $rowPedido = $pedido->fetchObject();

                $cedulaPedido = $rowPedido->cedula_cliente;
            } else { //
                $rowPedido = 0;
            }
        } else { //
            $rowPedido = 0;
        }


        if ($rowPedido !== 0) {
            $cliente = $this->db()->query("SELECT * FROM clientes WHERE cedula_cliente = '$cedulaPedido'");
            if ($cliente && $cliente->rowCount() != 0) {// Evalua la cansulta
                $rowCliente = $cliente->fetchObject();
            } else { //
                $rowCliente = 0;
            }
        } else { //
            $rowCliente = 0;
        }

        if ($rowFactura !== 0) {

            $proPedido = $this->db()->query("SELECT * FROM pro_pedidos WHERE codigo_pedido = '$p'");

            if ($proPedido && $proPedido->rowCount() != 0) {// Evalua la cansulta
                while ($rowProPedid = $proPedido->fetchObject()) {
                    $rowProPedido[] = $rowProPedid;
                }
            } else { //
                $rowProPedido = 0;
            }
        } else { //
            $rowProPedido = 0;
        }


$rowProducto=[];
        if ($rowProPedido !== 0) {

            for ($i = 0; $i < $proPedido->rowCount(); $i++) {

                $codigo = $rowProPedido[$i]->codigo_producto;
                $producto = $this->db()->query("SELECT * FROM productos WHERE codigo_producto = '$codigo'");

                if ($producto && $producto->rowCount() != 0) {// Evalua la cansulta
                    while ($rowProduc = $producto->fetchAll()) {

                        $rowProducto+=array($i=>$rowProduc);

                   }
                } else { //
                    $rowProducto = 0;
                }
            }
        } else { //
            $rowProducto = 0;
        }


        if (!is_null($rowFactura)) {

            $serviPedido = $this->db()->query("SELECT * FROM servi_pedidos WHERE codigo_pedido = '$p' ");
            //$serviPedido = $this->db()->query("SELECT id_servicio FROM servi_pedidos");

            if ($serviPedido && $serviPedido->rowCount() != 0) {// Evalua la cansulta
                while ($rowServiP = $serviPedido->fetchObject()) {
                    $rowServiPedido[] = $rowServiP;
                }
            } else { //
                $rowServiPedido = 0;
            }
        } else { //
            $rowServiPedido = 0;
        }

        if ($rowServiPedido !== 0) {
            for ($i = 0; $i < $serviPedido->rowCount(); $i++) {
                $id = $rowServiPedido[$i]->id_servicio;

                $servicio = $this->db()->query("SELECT * FROM servicios WHERE id_servicio =$id");

                if ($servicio && $servicio->rowCount() != 0) {// Evalua la cansulta
                    while ($rowServi = $servicio->fetchObject()) {
                        $rowServicio[] = $rowServi;
                    }
                } else { //
                    $rowServicio = 0;
                }
            }
        } else { //
            $rowServicio = 0;
        }

        if ($rowFactura !== 0 and $rowPedido !== 0 and $rowCliente !== 0) {
            $row = array(
                'Factura' => $rowFactura,
                'Pedido' => $rowPedido,
                'Cliente' => $rowCliente);

            if ($rowProPedido !== 0) {
                $row += array(
                    'ProPedidos' => $rowProPedido,
                    'Producto' => $rowProducto,
                    'RowProPedido' => $proPedido->rowCount()
                );
            } else {
                $row += array(
                    'ProPedidos' => $rowProPedido,
                    'Producto' => $rowProducto,
                    'RowProPedido' => $proPedido->rowCount()
                );
            }
            if ($rowServiPedido !== 0) {
                $row += array(
                    'ServiPedido' => $rowServiPedido,
                    'Servicio' => $rowServicio,
                    'RowServiPedido' => $serviPedido->rowCount()
                );
            } else {
                $row += array(
                    'ServiPedido' => $rowServiPedido,
                    'Servicio' => $rowServicio,
                    'RowServiPedido' => $serviPedido->rowCount()
                );
            }
        }

        return $row;
    }

    public function anular() {
        $this->registerBitacora(FACTURAS,ACTUALIZAR);
        $sql = "UPDATE $this->table SET status_factura=false WHERE codigo_factura=:codigo_factura";

        $result = $this->db()->prepare($sql);
        $result->bindParam(':codigo_factura', $this->codigo_factura);

        $update = $result->execute();

        return $update;
    }

}
