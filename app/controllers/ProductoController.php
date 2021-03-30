<?php
	class ProductoController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Productos/Productos');
		}

		public function create() {
			$this->view('Productos/Productos.Registrar');
		}


		public function getAll() {
			$producto = new Producto(); // Instancia el objeto
			$allProductos = $producto->getAll(); // Obtiene todos los registros del producto
			$this->view('Productos/Productos.Consultar', ['allProductos' => $allProductos]); // Envia los registros a la vista
		}

		public function register() {
			if($_POST) {
				$codigoProducto = $this->input('codigo_producto', true, 'string');
				$nombreProducto = $this->input('nombre_producto', true, 'string');
				$descripcionProducto = $this->input('descripcion_producto', true, 'string');
				$tipoProducto = $this->input('tipo_producto', true, 'string');
				$modeloProducto = $this->input('modelo_producto', true, 'string');
				$costoProducto = $this->input('costo_producto', true, 'int');
				$precioProducto = $this->input('precio_producto', true, 'int');
				$stockMaxProducto = $this->input('stock_max_producto', true, 'int');
				$stockMinProducto = $this->input('stock_min_producto', true, 'int');
				$stockProducto = $this->input('stock_producto', true, 'int');
				$imgProducto = $_FILES['img_producto'];
				$idTalla = $this->input('id_talla');
				$stockProTalla = $this->input('stock_pro_talla');
				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Producto','index'); // Redirecciona al inicio.
				}
				else {
					$producto = new Producto(); // Instancia el objeto
					// Setea los campos
					$producto->setCodigoProducto($codigoProducto);
					$producto->setNombreProducto(ucwords($nombreProducto));
					$producto->setDescripcionProducto(ucwords($descripcionProducto));
					$producto->setTipoProducto($tipoProducto);
					$producto->setModeloProducto($modeloProducto);
					$producto->setCostoProducto($costoProducto);
					$producto->setPrecioProducto($precioProducto);
					$producto->setStockMaxProducto($stockMaxProducto);
					$producto->setStockMinProducto($stockMinProducto);
					$producto->setStockProducto($stockProducto);
					$producto->setImgProducto(Helpers::saveImage($imgProducto,'productos'));
					$dataProducto = $producto->save();
					if(count($stockProTalla) !== 0) {
						for ($i = 0; $i < count($stockProTalla); $i++) {
							$producto->setIdTalla($idTalla[$i]);
							$producto->setStockProTalla($stockProTalla[$i]);
							$dataTallas = $producto->saveTallas();
							if(is_object($dataTallas)){
											break;
								$this->sendAjax($dataTallas);
										}
						}
					}
					$this->sendAjax($dataProducto);
				}
			}
		}

		public function details() {
			if(isset($_GET['id'])){
				$codigoProducto = $_GET['id'];
				$producto = new Producto();
				$_producto = $producto->getOne($codigoProducto);
				$_tallas = $producto->getProductoXTallas($codigoProducto);
				$this->view('Productos/Productos.Detalles',
					[
						'producto' => $_producto,
						'pro_tallas' => $_tallas
					]);
			}
		}

		public function update() {
			if($_POST) {
				$codigoProducto = $this->input('codigo_producto', true, 'string');
				$nombreProducto = $this->input('nombre_producto', true, 'string');
				$descripcionProducto = $this->input('descripcion_producto', true, 'string');
				$tipoProducto = $this->input('tipo_producto', true, 'string');
				$modeloProducto = $this->input('modelo_producto', true, 'string');
				$costoProducto = $this->input('costo_producto', true, 'int');
				$precioProducto = $this->input('precio_producto', true, 'int');
				$stockMaxProducto = $this->input('stock_max_producto', true, 'int');
				$stockMinProducto = $this->input('stock_min_producto', true, 'int');
				$stockProducto = $this->input('stock_producto', true, 'int');
				if(isset($_FILES['img_producto']) && $_FILES['img_producto']['name'] !== '') {
					$imgProducto = $_FILES['img_producto'];
				}
				else {
					$imgProducto = $_POST['img_producto_name'];
				}
				$idTalla = $this->input('id_talla');
				$stockProTalla = $this->input('stock_pro_talla');
				if($this->validateFails()) { // Si la validacion falla
					// $this->redirect('Producto','index'); // Redirecciona al inicio.
					var_export($_POST); 
					// var_export('hola');
					// die();
				}
				else {
					$producto = new Producto(); // Instancia el objeto
					// Setea los campos
					$producto->setCodigoProducto($codigoProducto);
					$producto->setNombreProducto(ucwords($nombreProducto));
					$producto->setDescripcionProducto(ucwords($descripcionProducto));
					$producto->setTipoProducto($tipoProducto);
					$producto->setModeloProducto($modeloProducto);
					$producto->setCostoProducto($costoProducto);
					$producto->setPrecioProducto($precioProducto);
					$producto->setStockMaxProducto($stockMaxProducto);
					$producto->setStockMinProducto($stockMinProducto);
					$producto->setStockProducto($stockProducto);
					if(isset($_FILES['img_producto']) && $_FILES['img_producto']['name'] !== '') {
						$producto->setImgProducto(Helpers::saveImage($imgProducto,'productos'));
					}
					else {
						$producto->setImgProducto($_POST['img_producto_name']);
					}
					$dataProducto = $producto->update();
					for ($i = 0; $i < count($stockProTalla); $i++) {
						$producto->updateTalla($stockProTalla[$i], $idTalla[$i], $codigoProducto);
					}
					$this->sendAjax($dataProducto);
				}
			}
		}

		public function delete() {
			if(isset($_POST['codigo_producto'])){
				$codigoProducto = $_POST['codigo_producto'];
				$producto = new Producto();
				$producto->setCodigoProducto($codigoProducto);
				$data = $producto->delete();
				$this->sendAjax($data);
			}
		}

		public function getAllTallas() {
	        $producto = new Producto();
	        $tallas = $producto->getAllTallas();
	        $this->sendAjax($tallas);
    	}

    	public function checkCodigoProducto() {
				$codigoProducto = $this->input('codigo_producto', true, 'string');
    		$producto = new Producto();
    		$producto->setCodigoProducto($codigoProducto);
				$response = $producto->checkCodigoProducto();

    		$this->sendAjax($response);
    	}

	}
