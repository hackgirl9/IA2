<?php
	class MaterialController extends BaseController {
		public function __construct() {
			parent::__construct(); // Heredamos el constructor de la clase BaseController
		}

		public function index() { // Nos redirige a la vista index de Material
			$this->view('Materiales/Materiales');
		}

		public function create() { // Metodo para registrar

			if (isset($_POST["nombre_material"])){ // Creamos condición

				$material = new Material(); // Instaciamos la Clase

				// Se crean variables para los datos que se reciben por POST
				$nombre  =$_POST["nombre_material"];
				$descrip =$_POST["descripcion_material"];
				$unidad  =$_POST["unidad_material"];
				$precio  =$_POST["precio_material"];

				//Se ingresan los datos al modelo
				$material->setNombre_material(ucwords($nombre));
				$material->setDescripcion_material(ucwords($descrip));
				$material->setUnidad_material($unidad);
				$material->setPrecio_material($precio);

				$data= $material->save(); // Llamamos a la funcion de registro

				$this->sendAjax($data); // Enviamos la informacion a ajax

			}else{

				$this->view('Materiales/Materiales.Registrar'); // Si no se reciben parametros que muestre la vista de registro
			}
		}

		public function getAll() { //Metodo de consulta de todas los materiales

			$material = new Material(); // Instanciamos la clase
			$query = $material->getAll(); // Guardamos los registros en una variable utilizando el metodo de consulta en el modelo

			$this->view('Materiales/Materiales.Consultar', ['query'=> $query]); //retornamos a la vista y se le envia los valores
		}

		public function details() { // Metodo de detalles

			if(isset($_GET["id"])){ // Creamos Condicion

				$id = (int) $_GET["id"]; // Obtenemos el id por el metodo get y creamos variables

				$material = new Material(); // Instanciamos la Clase

				$material->setId_material($id); // Enviamos los valores al modelo
				$result = $material->getById(); // Llamamos a la funcion de consultar por id del modelo

				$this->view('Materiales/Materiales.Detalles', ['result'=>$result]); // Llamamos a la vista para que nos muestre informacion
			}

		}

		public function update() { // Metodo Actualizar

			if(isset($_POST["id_material"])){ // Creamos condición

			$material = new Material(); // Instanciamos la clase

			// Creamos variables para guardar la informacion recibida por POST
			$id      = $_POST["id_material"];
			$nombre  = $_POST["nombre_material"];
			$descrip = $_POST["descripcion_material"];
			$unidad  = $_POST["unidad_material"];
			$precio  = $_POST["precio_material"];

			//Enviamos los valores al modelo
			$material->setId_material($id);
			$material->setNombre_material($nombre);
			$material->setDescripcion_material($descrip);
			$material->setUnidad_material($unidad);
			$material->setPrecio_material($precio);

			$material->update(); // LLamamos al metodo actualizar del modelo

			}
		}

		public function delete() { // Metodo Eliminar

			if(isset($_POST["id_material"])){ // Creamos condición

			$material = new Material(); // Instaciamos la Clase

			$id= (int) $_POST["id_material"]; // Creamos variable para guardarel id recibido por GET

			$material->setId_material($id); // Enviamos los valores al modelo
			$material->delete(); // llamamos a la función de eliminar del modelo

			}

		}

		public function search(){

			$nombre = ucwords($_POST["nombre"]);

			$material = new Material();
			$query= $material->search($nombre);

			$this->sendAjax($query);
		}
	}
