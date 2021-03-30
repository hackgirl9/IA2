<?php
        require_once "vendor/autoload.php";
	class ReporteController extends BaseController {

		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Reportes/Reportes');
		}


        public function FactuIndex() {
            $factura = new Reporte(); // Instancia un objeto
            $allFactura = $factura->getFactura();
            $this->view('Reportes/Facturacion.Listado',
                ['allFactura' => $allFactura]);
            //$this->view('Reportes/Reportes');
        }



        public function getAllPedido() {
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
            $pedido = new Reporte(); // Instancia un objeto
            $allPedido = $pedido->getPedidos();
            $this->view('Reportes/pedidos',['allPedido' => $allPedido]);
            $html = ob_get_clean();
            $mpdf->SetHTMLFooter('
            <footer style="color: #777777; width: 90%; height: 30px; position: absolute; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0;">  
            <div style="padding-left: 6px; border-left: 6px solid #4E504E;">
            <div>Advertencia:</div>
            <div style="font-size: 1.2em;">En la siguiente lista de pedidos solo se muestran LOS PEDIDOS QUE AÚN NO HAN SIDO ENTREGADOS</div>
            </div>
            </footer>');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit();
        }

         public function getAllEntrega() {
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
            $pedido = new Reporte(); // Instancia un objeto
            $allPedido = $pedido->getPedidos();
            $this->view('Reportes/entrega',['allPedido' => $allPedido]);
            $html = ob_get_clean();
            $mpdf->SetHTMLFooter('
            <footer style="color: #777777; width: 90%; height: 30px; position: absolute; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0;">  
            <div style="padding-left: 6px; border-left: 6px solid #4E504E;">
            <div>Advertencia:</div>
            <div style="font-size: 1.2em;">En la siguiente lista de pedidos solo se muestran LOS PEDIDOS ENTREGADOS</div>
            </div>
            </footer>');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit();
        }




        public function getAllProducto() {
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
            $producto = new Reporte(); // Instancia un objeto
            $allProducto = $producto->getProductos();
            $this->view('Reportes/productos',['allProducto' => $allProducto]);
            $html = ob_get_clean();
            $mpdf->SetHTMLFooter('
            <footer style="color: #777777; width: 90%; height: 30px; position: absolute; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0;">  
            Si Desea algun producto de la Lista contactar con la empresa o visita nuestras redes sociales.
      Feliz Día
            </footer>');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }

        public function facturaById() {
            if (isset($_GET["id"])) {
                $mpdf = new \Mpdf\Mpdf();
                ob_start();
                $factura = new Reporte();
                $id=$_GET["id"];

                $factura->setCodigoFactura($id);
                $factura_find = $factura->getFacturaId($id);
                $servicio_find = $factura->getFacturaServicioById($id);
                $producto_find=$factura->getFacturaProductoById($id);

                // echo var_export($factura_find); die();

                $this->view('Reportes/Invoice',
                    ['servicio' => $servicio_find,
                        'producto' => $producto_find,
                        'factura' => $factura_find
                    ]);

                $html = ob_get_clean();
                $mpdf->SetHTMLFooter('
                <footer style="color: #777777; width: 90%; height: 30px; position: absolute; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0;">  
                 No Requiere Firma
                </footer>');
                $mpdf->WriteHTML($html);
                $mpdf->Output();
            }
        }

        public function setDolar() {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                // $factura = new Reporte(); // Instancia un objeto
                // $factura->setCodigoFactura($id);
                // $allFactura = $factura->getFacturaId($id);
                // var_export($allFactura); die();
                $this->view('Reportes/setDolar',
                    ['id' => $id]);
            }
        }

        public function facturaBolivares() {

                if (isset($_POST["id"])) {
                $mpdf = new \Mpdf\Mpdf();
                ob_start();
                $factura = new Reporte();
                $id=$_POST["id"];
                $dolar=$_POST["dolar"];
                $_SESSION['precioDolar']=$dolar;
                $factura->setCodigoFactura($id);
                $factura_find = $factura->getFacturaId($id);
                $servicio_find = $factura->getFacturaServicioById($id);
                $producto_find =$factura->getFacturaProductoById($id);

                $this->view('Reportes/facturaBolivares',

                    [   'servicio' => $servicio_find,
                        'producto' => $producto_find,
                        'factura' => $factura_find
                    ]);

                $html = ob_get_clean();
                $mpdf->SetHTMLFooter('
                <footer style="color: #777777; width: 90%; height: 30px; position: absolute; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0;">  
                 No Requiere Firma
                </footer>');
                $mpdf->WriteHTML($html);
                $mpdf->Output();
            }

        }



	}



