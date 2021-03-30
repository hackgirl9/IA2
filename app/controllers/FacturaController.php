<?php
	class FacturaController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Facturacion/Facturacion');
		}

		public function getAll() {
			$Factura = new Factura();
			$result = $Factura->getAll();
			$this->view('Facturacion/Facturacion.Consultar',array('factura'=>$result));
		}

		public function details(){
			if(isset($_GET['id'])) {
				$codigoFactura = $_GET['id'];

				$Factura = new Factura();
				$Factura->setCodigoFactura($codigoFactura);
				$result= $Factura->getOne();
	
	
	
				if ($result['Factura']->status_factura) {
					$status_factura="Vigente";
				}
				else{
					$status_factura="Anulada";
				}
	
				$this->view('Facturacion/Facturacion.Detalles',array(
					'detalles'=>$result,
					'status'=>$status_factura,
					'StatusFactura'=>$result['Factura']->status_factura
				));

			}
		}

		public function anular(){

			$codigoFactura = $_POST['codigo_factura'];

			$Factura = new Factura();
			$Factura->setCodigoFactura($codigoFactura);

			$result= $Factura->anular();

			$this->sendAjax($result);
		}

	}
