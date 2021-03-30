<?php
	class Estadistica extends BaseModel {


		public function __construct() {
			parent::__construct();
		}

		public function producto(){

			$fecha = date('Y');

			$producto=$this->db()->query("	SELECT pedidos.fecha_pedido, pro_pedidos.codigo_producto, productos.nombre_producto, productos.tipo_producto, productos.precio_producto,
											COUNT( pro_pedidos.codigo_producto ) AS total FROM  pro_pedidos 
											INNER JOIN productos ON pro_pedidos.codigo_producto = productos.codigo_producto
											INNER JOIN pedidos ON pedidos.codigo_pedido = pro_pedidos.codigo_pedido
											WHERE to_char(fecha_pedido, 'YYYY') = '$fecha'
											GROUP BY pedidos.fecha_pedido,pro_pedidos.codigo_producto, productos.nombre_producto, productos.tipo_producto, productos.precio_producto
											ORDER BY total DESC LIMIT 5");

				if($producto->rowCount()>=1){

					while($fila=$producto->fetch(PDO::FETCH_OBJ)){
						$result[]=$fila;
					}
					return $result;
				}
					else{
						return $result=null;
					}
		}

		public function pedido(){

			$pedido=$this->db()->query("SELECT * FROM pedidos INNER JOIN clientes ON pedidos.cedula_cliente = clientes.cedula_cliente  WHERE status_pedido = 'En Proceso' LIMIT 5");

			if($pedido->rowCount()>=1){

				while($fila=$pedido->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}
				return $result;
			}
				else{
					return $result=null;
				}

		}
		public function servicio(){

			$fecha = date('Y');

			$servicio=$this->db()->query("	SELECT pedidos.fecha_pedido, servi_pedidos.id_servicio, servicios.nombre_servicio, servicios.descripcion_servicio ,servicios.precio_servicio,
											COUNT( servi_pedidos.id_servicio ) AS total FROM  servi_pedidos 
											INNER JOIN servicios ON servi_pedidos.id_servicio = servicios.id_servicio
											INNER JOIN pedidos 	 ON pedidos.codigo_pedido = servi_pedidos.codigo_pedido
											WHERE to_char(pedidos.fecha_pedido, 'YYYY') ='$fecha'
											GROUP BY pedidos.fecha_pedido,servi_pedidos.id_servicio, servicios.nombre_servicio,servicios.descripcion_servicio, servicios.precio_servicio ORDER BY total DESC LIMIT 3");

				if($servicio->rowCount()>=1){

					while($fila=$servicio->fetch(PDO::FETCH_OBJ)){
						$result[]=$fila;
					}
					return $result;
				}
					else{
						return $result=null;
					}

			}

		public function cliente(){
		$cliente=$this->db()->query("SELECT to_char(fecha_actu_bitacora, 'MM/YYYY') AS mes, count(*) AS registro  FROM bitacoras WHERE accion_bitacora = 'REGISTRAR' AND modulo_bitacora='CLIENTES' GROUP BY mes");

			if($cliente->rowCount()>=1){

				while($fila=$cliente->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}
				return $result;
			}
				else{
					 $result = 0;
				}

			}

		public function factura(){

			$fecha = date('Y');

			$factura=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS registro  FROM factura_ventas WHERE to_char(fecha_factura, 'YYYY') = '$fecha' GROUP BY mes");

			if($factura->rowCount()>=1){

				while($fila=$factura->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}

				return $result;

			}
				else{
					return $result=0;
				}

		}

		public function ingreso(){

			$enero		=0;
			$febrero	=0;
			$marzo		=0;
			$abril		=0;
			$mayo		=0;
			$junio		=0;
			$julio		=0;
			$agosto		=0;
			$septiembre	=0;
			$octubre	=0;
			$noviembre	=0;
			$diciembre	=0;

			$fecha = date('Y');

			$enero=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '01/$fecha' GROUP BY mes");

			if($enero->rowCount()>=1){
				while($fila=$enero->fetch(PDO::FETCH_OBJ)){
					$resultEnero[]=$fila;
				}

			}else{
				$resultEnero[0]["ventas"] = 0;
			}

			$febrero=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '02/$fecha' GROUP BY mes");

			if($febrero->rowCount()>=1){
				while($fila=$febrero->fetch(PDO::FETCH_OBJ)){
					$resultFebrero[]=$fila;
				}

			}else{
				$resultFebrero[0]["ventas"] = 0;
			}

			$marzo=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '03/$fecha' GROUP BY mes");

			if($marzo->rowCount()>=1){
				while($fila=$marzo->fetch(PDO::FETCH_OBJ)){
					$resultMarzo[]=$fila;
				}

			}else{
				$resultMarzo[0]["ventas"] = 0;
			}

			$abril=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '04/$fecha' GROUP BY mes");

			if($abril->rowCount()>=1){
				while($fila=$abril->fetch(PDO::FETCH_OBJ)){
					$resultAbril[]=$fila;
				}

			}else{
				$resultAbril[0]["ventas"] = 0;
			}

			$mayo=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '05/$fecha' GROUP BY mes");

			if($mayo->rowCount()>=1){
				while($fila=$mayo->fetch(PDO::FETCH_OBJ)){
					$resultMayo[]=$fila;
				}

			}else{
				$resultMayo[0]["ventas"] = 0;
			}

			$junio=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '06/$fecha' GROUP BY mes");

			if($junio->rowCount()>=1){
				while($fila=$junio->fetch(PDO::FETCH_OBJ)){
					$resultJunio[]=$fila;
				}

			}else{
				$resultJunio[0]["ventas"] = 0;
			}

			$julio=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '07/$fecha' GROUP BY mes");

			if($julio->rowCount()>=1){
				while($fila=$julio->fetch(PDO::FETCH_OBJ)){
					$resultJulio[]=$fila;
				}

			}else{
				$resultJulio[0]["ventas"] = 0;
			}

			$agosto=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '08/$fecha' GROUP BY mes");

			if($agosto->rowCount()>=1){
				while($fila=$agosto->fetch(PDO::FETCH_OBJ)){
					$resultAgosto[]=$fila;
				}

			}else{
				$resultAgosto[0]["ventas"] = 0;
			}

			$septiembre=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '09/$fecha' GROUP BY mes");

			if($septiembre->rowCount()>=1){
				while($fila=$septiembre->fetch(PDO::FETCH_OBJ)){
					$resultSeptiembre[]=$fila;
				}

			}else{
				$resultSeptiembre[0]["ventas"] = 0;
			}

			$octubre=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '10/$fecha' GROUP BY mes");

			if($octubre->rowCount()>=1){
				while($fila=$octubre->fetch(PDO::FETCH_OBJ)){
					$resultOctubre[]=$fila;
				}

			}else{
				$resultOctubre[0]["ventas"] = 0;
			}

			$noviembre=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '11/$fecha' GROUP BY mes");

			if($noviembre->rowCount()>=1){
				while($fila=$noviembre->fetch(PDO::FETCH_OBJ)){
					$resultNoviembre[]=$fila;
				}

			}else{
				$resultNoviembre[0]["ventas"] = 0;
			}

			$diciembre=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas  FROM factura_ventas WHERE to_char(fecha_factura, 'MM/YYYY') = '12/$fecha' GROUP BY mes");

			if($diciembre->rowCount()>=1){
				while($fila=$diciembre->fetch(PDO::FETCH_OBJ)){
					$resultDiciembre[]=$fila;
				}

			}else{
				$resultDiciembre[0]["ventas"] = 0;
			}

			return $result= array(
				'enero'		=>$resultEnero,
				'febrero'	=>$resultFebrero,
				'marzo'		=>$resultMarzo,
				'abril'		=>$resultAbril,
				'mayo'		=>$resultMayo,
				'junio'		=>$resultJunio,
				'julio'		=>$resultJulio,
				'agosto'	=>$resultAgosto,
				'septiembre'=>$resultSeptiembre,
				'octubre'	=>$resultOctubre,
				'noviembre'	=>$resultNoviembre,
				'diciembre'	=>$resultDiciembre
			);
		}

		public function registrarBitacora(){

			$this->registerBitacora(ESTADISTICAS, CONSULTAR);
		}

		public function ganancia(){


		}

	}
