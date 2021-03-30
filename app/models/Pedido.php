<?php

class Pedido extends BaseModel
{
    // Atributos-Pedido
    private $codigoPedido;
    private $cedulaCliente;
    private $statusPedido;
    private $descripcionPedido;
    private $fechaPedido;
    private $fechaEntregaPedido;

    //Atributos-Servicios
    private $idServiPedidos;
    private $idServicio;
    private $precioServiPedido;
    private $cantidadPrenda;
    private $cantidadMedida;
    //atributo tela
    private $idTela;


    //atributos factura
    private $codigoFactura;
    private $fechaFactura;
    private $modoPagoFactura;
    private $porcentajeVentaFactura;

    //atributos de productos
    private $codigoProducto;
    private $nombreProducto;
    private $idTallas;
    private $nombreTalla;


    /**
     * @param mixed $idTallas
     */





    public function __construct()
    {
        parent::__construct();
    }

    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    public function getNombreTalla()
    {
        return $this->nombreTalla;
    }


    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }


    public function getCodigoProducto()
    {
        return $this->codigoProducto;
    }


    public function setCodigoProducto($codigoProducto)
    {
        $this->codigoProducto = $codigoProducto;
    }


    //get pedido
    public function getCedulaCliente()
    {
        return $this->cedulaCliente;
    }


    public function getStatusPedido()
    {
        return $this->statusPedido;
    }


    public function getDescripcionPedido()
    {
        return $this->descripcionPedido;
    }

    public function getFechaEntregaPedido()
    {
        return $this->fechaEntregaPedido;
    }

    public function getCodigoPedido()
    {
        return $this->codigoPedido;
    }


    //get ServiPedido
    public function getCantidadMedida()
    {
        return $this->cantidadMedida;
    }

    public function getIdServiPedidos()
    {
        return $this->idServiPedidos;
    }

    public function getIdServicio()
    {
        return $this->idServicio;
    }

    public function getCantidadPrenda()
    {
        return $this->cantidadPrenda;
    }

    public function getPrecioServiPedido()
    {
        return $this->precioServiPedido;
    }

    //get tela
    public function getIdTela()
    {
        return $this->idTela;
    }


    //get Factura

    public function getCodigoFactura()
    {
        return $this->codigoFactura;
    }

    public function getModoPagoFactura()
    {
        return $this->modoPagoFactura;
    }

    public function getPorcentajeVentaFactura()
    {
        return $this->porcentajeVentaFactura;
    }

    public function getFechaFactura()
    {
        return $this->fechaFactura;
    }

    public function getIdTallas()
    {
        return $this->idTallas;
    }

    //Set Pedido
    public function setDescripcionPedido($descripcionPedido)
    {
        $this->descripcionPedido = $descripcionPedido;
    }

    public function setFechaEntregaPedido($fechaEntregaPedido)
    {
        $this->fechaEntregaPedido = $fechaEntregaPedido;
    }

    public function setCodigoPedido($codigoPedido)
    {
        $this->codigoPedido = $codigoPedido;
    }

    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;
    }

    public function setStatusPedido($statusPedido)
    {
        $this->statusPedido = Helpers::aesEncrypt($statusPedido);
    }

    public function setNombreTalla($nombreTalla)
    {
        $this->nombreTalla = $nombreTalla;
    }

    public function setCantidadMedida($cantidadMedida)
    {
        $this->cantidadMedida = $cantidadMedida;
    }

    public function setCedulaCliente($cedulaCliente)
    {
        $this->cedulaCliente = $cedulaCliente;
    }


    //Set ServiPedido
    public function setIdServiPedidos($idServiPedidos)
    {
        $this->idServiPedidos = $idServiPedidos;
    }

    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }

    public function setPrecioServiPedido($precioServiPedido)
    {
        $this->precioServiPedido = $precioServiPedido;
    }

    public function setCantidadPrenda($cantidadPrenda)
    {
        $this->cantidadPrenda = $cantidadPrenda;
    }

    //set telas
    public function setIdTela($idTela)
    {
        $this->idTela = $idTela;
    }


    //set facturas

    public function setCodigoFactura($codigoFactura)
    {
        $this->codigoFactura = $codigoFactura;
    }

    public function setFechaFactura($fechaFactura)
    {
        $this->fechaFactura = $fechaFactura;
    }


    public function setModoPagoFactura($modoPagoFactura)
    {
        $this->modoPagoFactura = $modoPagoFactura;
    }


    public function setPorcentajeVentaFactura($porcentajeVentaFactura)
    {
        $this->porcentajeVentaFactura = $porcentajeVentaFactura;
    }

    public function setIdTallas($idTallas)
    {
        $this->idTallas = $idTallas;
    }




    public function checkCedula()
    {

        $sql = "SELECT * FROM clientes WHERE cedula_cliente='$this->cedulaCliente'";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            $resulSet = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }


    public function generatedNumberPedido()
    {


        $codigoPedido = $this->db()->query("SELECT codigo_pedido FROM pedidos ORDER BY codigo_pedido DESC");

        if ($codigoPedido->rowCount() >= 1) {
            $row = $codigoPedido->fetch(PDO::FETCH_OBJ);
            $number = explode('-', $row->codigo_pedido);//LUEGO SOLO BUSCO LO NUMEROS
            $number_integer = (int)$number[1];//LOS COVIERTOS A UN ENTERO PARA PORDER SUMARLA 1 Y SEGUIR LA SECUENCIA
            $number_generated = strtoupper('P' . "-" . str_pad($number_integer + 1, 7, '0', STR_PAD_LEFT));
            return $number_generated;
        } else {
            $number_generated = strtoupper('P' . "-" . str_pad(1, 7, '0', STR_PAD_LEFT));
            return $number_generated;
        }
    }

    public function getServices()
    {
        $sql = "SELECT * FROM servicios";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }
        return $resulSet;
    }


    public function save()
    {
        try {
            $this->db()->beginTransaction();
            $this->registerBitacora(PEDIDOS, REGISTRAR);
            $sql = "INSERT INTO
                        pedidos(codigo_pedido, cedula_cliente, status_pedido, descripcion_pedido, fecha_pedido, fecha_entrega_pedido)
                          VALUES(:codigo_pedido,:cedula_cliente,:status_pedido,:descripcion_pedido,:fecha_pedido,:fecha_entrega_pedido)";
            $query = $this->db()->prepare($sql);
            $query->bindValue(':codigo_pedido', $this->codigoPedido);
            $query->bindValue(':cedula_cliente', $this->cedulaCliente);
            $query->bindValue(':status_pedido', $this->statusPedido);
            $query->bindValue(':descripcion_pedido', $this->descripcionPedido);
            $query->bindValue(':fecha_pedido', $this->fechaPedido);
            $query->bindValue(':fecha_entrega_pedido', $this->fechaEntregaPedido);
            $save = $query->execute();
            $this->db()->commit();
            return $save;
        }catch (Exception $e){
            $this->db()->rollBack();
            return false;
        }

    }

    public function getPrecioServicio()
    {
        $result = $this->db()->query("SELECT precio_servicio FROM servicios WHERE id_servicio='$this->idServicio'");
        $row = $result->fetch(PDO::FETCH_OBJ);
        return $row->precio_servicio;
    }

    public function saveServiPedido()
    {
        $sql = "INSERT INTO servi_pedidos(codigo_pedido, id_servicio,cantidad_prenda, cantidad_medida,id_tela,precio_servi_pedido) 
                  VALUES(:codigo_pedido,:id_servicio,:cantidad_prenda,:cantidad_medida,:id_tela,:precio_servi_pedido)";
        $query = $this->db()->prepare($sql);
        $query->bindValue(':codigo_pedido', $this->codigoPedido);
        $query->bindValue(':id_servicio', $this->idServicio);
        $query->bindValue(':id_tela', $this->idTela);
        $query->bindValue(':cantidad_prenda', $this->cantidadPrenda);
        $query->bindValue(':cantidad_medida', $this->cantidadMedida);
        $query->bindValue(':precio_servi_pedido', $this->precioServiPedido);
        $save = $query->execute();
        return $save;
    }


    public function getTelas()
    {
        $result = $this->db()->query("SELECT * FROM telas");
        if ($result->rowCount() >= 1) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }


    public function saveFactura()
    {
        $this->registerBitacora(PEDIDOS, FACTURAR);
        $sql = "INSERT INTO factura_ventas(codigo_factura, codigo_pedido, fecha_factura, modo_pago_factura,status_factura, porcentaje_venta_factura)
                  VALUES (:codigo_factura,:codigo_pedido,CURRENT_DATE,:modo_pago,:status_factura,:porcentaje_venta_factura)";
        $query = $this->db()->prepare($sql);
        $query->bindValue(':codigo_factura', $this->codigoFactura);
        $query->bindValue(':codigo_pedido', $this->codigoPedido);
        $query->bindValue(':modo_pago', $this->modoPagoFactura);
        $query->bindValue(':status_factura', 0);
        $query->bindValue(':porcentaje_venta_factura', $this->porcentajeVentaFactura);
        $save = $query->execute();
        return $save;
    }


    public function generateNumberFactura()
    {
        $codigoFactura = $this->db()->query("SELECT codigo_factura FROM factura_ventas ORDER BY codigo_factura DESC");

        if ($codigoFactura->rowCount() >= 1) {
            $row = $codigoFactura->fetch(PDO::FETCH_OBJ);
            $number = explode('-', $row->codigo_factura);//LUEGO SOLO BUSCO LO NUMEROS
            $number_integer = (int)$number[1];//LOS COVIERTOS A UN ENTERO PARA PORDER SUMARLA 1 Y SEGUIR LA SECUENCIA
            $number_generated = strtoupper('F' . "-" . str_pad($number_integer + 1, 7, '0', STR_PAD_LEFT));
            return $number_generated;
        } else {
            $number_generated = strtoupper('F' . "-" . str_pad(1, 7, '0', STR_PAD_LEFT));
            return $number_generated;
        }
    }


    public function getAll(){
        $this->registerBitacora(PEDIDOS, CONSULTAR);
        $sql = "SELECT * FROM pedidos INNER JOIN 
                              clientes ON pedidos.cedula_cliente = clientes.cedula_cliente 
                                  ORDER BY codigo_pedido DESC;";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }
    public function getBy()
    {
        $this->registerBitacora(PEDIDOS, DETALLES);
        $sql = "SELECT * FROM pedidos INNER JOIN clientes on pedidos.cedula_cliente = clientes.cedula_cliente WHERE pedidos.codigo_pedido='$this->codigoPedido'";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            $resulSet = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $resulSet = null;
        }

        return $resulSet;


    }

    public function getServicicio()
    {
        $sql = "SELECT * FROM servi_pedidos INNER JOIN servicios ON servi_pedidos.id_servicio = servicios.id_servicio WHERE servi_pedidos.codigo_pedido='$this->codigoPedido'";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }


    public function delete()
    {
        $this->registerBitacora(PEDIDOS, ELIMINAR);
        $queryFactura = $this->db()->query("DELETE FROM factura_ventas WHERE codigo_pedido='$this->codigoPedido'");

        if ($queryFactura) {
            $queryServiPedido = $this->db()->query("SELECT codigo_pedido FROM pedidos WHERE codigo_pedido='$this->codigoPedido'");
            $queryProductoPedido = $this->db()->query("SELECT codigo_pedido FROM pedidos WHERE codigo_pedido='$this->codigoPedido'");

            if ($queryServiPedido->rowCount() >= 1) {
                $queryServiPedido = $this->db()->query("DELETE FROM servi_pedidos WHERE codigo_pedido='$this->codigoPedido'");
            }

            if ($queryProductoPedido->rowCount() >= 1) {
                $queryServiPedido = $this->db()->query("DELETE FROM pro_pedidos WHERE codigo_pedido='$this->codigoPedido'");
            }

            $queryPedido = $this->db()->query("DELETE FROM pedidos WHERE codigo_pedido='$this->codigoPedido'");

          if($queryPedido){
              return true ;
          }else{
              return false;
          }


            return $queryPedido;
        }
    }

    public function findProductos()
    {
        $sql = "SELECT * FROM productos INNER JOIN pro_tallas
                on productos.codigo_producto = pro_tallas.codigo_producto INNER JOIN 
                tallas ON pro_tallas.id_talla = tallas.id_talla
                 WHERE productos.codigo_producto='$this->codigoProducto' AND tallas.nombre_talla ='$this->idTallas'";

        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $row->nombre_producto=Helpers::aesDecrypt($row->nombre_producto);
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }

    public function productoAll()
    {
        $sql = "SELECT * FROM productos INNER JOIN pro_tallas
                on productos.codigo_producto = pro_tallas.codigo_producto INNER JOIN 
                tallas ON pro_tallas.id_talla = tallas.id_talla
                 WHERE pro_tallas.stock_pro_talla != 0";

        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $row->nombre_producto=Helpers::aesDecrypt($row->nombre_producto);
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }











    public function saveProPredido()
    {
        $sql = "INSERT INTO pro_pedidos(codigo_pedido, codigo_producto, cant_pro_pedido,precio_pro_pedido,nombre_talla) 
                      VALUES(:codigo_pedido,:codigo_producto,:cant_pro_pedido,:precio_pro_pedido,:nombre_talla)";
        $query = $this->db()->prepare($sql);
        $query->bindValue(':codigo_pedido', $this->codigoPedido);
        $query->bindValue(':codigo_producto', $this->codigoProducto);
        $query->bindValue(':cant_pro_pedido', $this->cantidadPrenda);
        $query->bindValue(':precio_pro_pedido', $this->precioServiPedido);
        $query->bindValue(':nombre_talla', $this->nombreTalla);
        $save = $query->execute();


        $sql = "UPDATE pro_tallas SET stock_pro_talla=stock_pro_talla-'$this->cantidadPrenda'  WHERE pro_tallas.codigo_producto='$this->codigoProducto' AND id_talla='$this->idTallas'";
        $query = $this->db()->query($sql);

        $sql = "UPDATE productos SET stock_producto=stock_producto-'$this->cantidadPrenda'  WHERE productos.codigo_producto='$this->codigoProducto'";
        $query = $this->db()->query($sql);


        if($query){
            $query=true;
        }else{
            $query=false;
        }

        return $query;
    }


    public function getProductos()
    {
        $sql = "SELECT * FROM pro_pedidos INNER JOIN productos
              ON pro_pedidos.codigo_producto = productos.codigo_producto 
        
              INNER JOIN pro_tallas ON productos.codigo_producto = pro_tallas.codigo_producto 
              INNER JOIN tallas ON pro_tallas.id_talla = tallas.id_talla
             WHERE pro_pedidos.codigo_pedido='$this->codigoPedido'";


        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }


    public function update()
    {
        $this->registerBitacora(PEDIDOS, ACTUALIZAR);
        $sql = "UPDATE pedidos SET 
                cedula_cliente=:cedula_cliente,
                status_pedido=:status_pedido,
                fecha_pedido=:fecha_pedido,
                descripcion_pedido=:descripcion_pedido,
                fecha_entrega_pedido=:fecha_entrega_pedido  WHERE codigo_pedido='$this->codigoPedido'";

        $query = $this->db()->prepare($sql);
        $query->bindValue(':cedula_cliente', $this->cedulaCliente);
        $query->bindValue(':status_pedido', $this->statusPedido);
        $query->bindValue(':fecha_pedido', $this->fechaPedido);
        $query->bindValue(':fecha_entrega_pedido', $this->fechaEntregaPedido);
        $query->bindValue(':descripcion_pedido', $this->descripcionPedido);

        $save = $query->execute();
        return $save;

    }


    public function updateProducto()
    {
        $sql = "UPDATE pro_pedidos SET
                  codigo_producto=:codigo_producto,
                  cant_pro_pedido=:cant_pro_pedido  WHERE codigo_pedido='$this->codigoPedido' AND codigo_producto='$this->codigoProducto'";
        $query = $this->db()->prepare($sql);
        $query->bindValue(':codigo_producto', $this->codigoProducto);
        $query->bindValue(':cant_pro_pedido', $this->cantidadPrenda);
        $save = $query->execute();

        return $save;

    }


    public function updateServiPedido()
    {
        $sql = "UPDATE servi_pedidos SET
                      id_servicio=:id_servicio,
                      id_tela=:id_tela,
                      cantidad_prenda=:cant_prenda,
                      cantidad_medida=:cant_medida
                       WHERE codigo_pedido='$this->codigoPedido' AND  id_servicio='$this->idServicio'";

        $query = $this->db()->prepare($sql);
        $query->bindValue(':id_servicio', $this->idServicio);
        $query->bindValue(':cant_prenda', $this->cantidadPrenda);
        $query->bindValue(':id_tela', $this->idTela);
        $query->bindValue(':cant_medida', $this->cantidadMedida);
        $save = $query->execute();
        return $save;
    }


    public function verifyProduct()
    {
        $sql = "SELECT * FROM productos INNER JOIN pro_tallas ON 
                  productos.codigo_producto = pro_tallas.codigo_producto
                  WHERE productos.codigo_producto='$this->codigoProducto' AND pro_tallas.id_talla='$this->idTallas'";
        $query = $this->db()->query($sql);
        if ($query->rowCount() >= 1) {
            $resulSet = $query->fetch(PDO::FETCH_OBJ);
            if ($resulSet->stock_pro_talla >= $this->cantidadPrenda) {
                return true;
            } else {
                return $resulSet;
            }
        }
    }

}
