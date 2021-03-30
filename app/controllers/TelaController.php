<?php
	class TelaController extends BaseController {

		public function __construct() {
			parent::__construct(); // Heredamos el constructor de la clase BaseController
		}

		public function index() { // Nos redirige a la vista index de tela
			$this->view('Telas/Telas');
		}

		public function create() { // Metodo para registrar

			if (isset($_POST["nombre_tela"])){ // Creamos condición

				$tela = new Tela(); // Instaciamos la Clase

				// Se crean variables para los datos que se reciben por POST
				$nombre  =$_POST["nombre_tela"];
				$descrip =$_POST["descripcion_tela"];
				$unidad  =$_POST["unidad_med_tela"];
				$tipo    =$_POST["tipo_tela"];

				//Se ingresan los datos al modelo
				$tela->setNombre_tela(ucwords($nombre));
				$tela->setDescripcion_tela(ucwords($descrip));
				$tela->setUnidad_med_tela(ucwords($unidad));
				$tela->setTipo_tela(ucwords($tipo));

				$data= $tela->save();  // Llamamos a la funcion de registro

				$this->sendAjax($data); // Enviamos la informacion a ajax

			}else{

				$this->view('Telas/Telas.Registrar'); // Si no se reciben parametros que muestre la vista de registro

			}
		}

		public function getAll() { //Metodo de consulta de todas las telas

			$tela= new Tela(); // Instanciamos la clase
			$query = $tela->getAll(); // Guardamos los registros en una variable utilizando el metodo de consulta en el modelo

			$this->view('Telas/Telas.Consultar',['query'=>$query]); //retornamos a la vista y se le envia los valores
		}

		public function details() { // Metodo de detalles

			if(isset($_GET["id"])){ // Creamos Condicion

				$tela = new Tela(); // Instanciamos la Clase

				$id = (int)$_GET["id"]; // Obtenemos el id por el metodo get y creamos variables

				$tela->setId_tela($id); // Enviamos los valores al modelo
				$result = $tela->getById(); // Llamamos a la funcion de consultar por id del modelo

			$this->view('Telas/Telas.Detalles', ['result'=>$result]); // Llamamos a la vista para que nos muestre informacion

		   }
		}

		public function update() { // Metodo Actualizar

			if(isset($_POST["id_tela"])){ // Creamos condición

				$tela = new Tela(); // Instanciamos la clase

				// Creamos variables para guardar la informacion recibida por POST
				$id = $_POST["id_tela"];
				$nombre = $_POST["nombre_tela"];
				$descrip = $_POST["descripcion_tela"];
				$unidad = $_POST["unidad_med_tela"];
				$tipo = $_POST["tipo_tela"];

				//Enviamos los valores al modelo
				$tela->setId_tela($id);
				$tela->setNombre_tela($nombre);
				$tela->setDescripcion_tela($descrip);
				$tela->setUnidad_med_tela($unidad);
				$tela->setTipo_tela($tipo);

				$tela->update(); // LLamamos al metodo actualizar del modelo

			}
		}

		public function delete() { // Metodo Eliminar

			if(isset($_POST["id_tela"])){ // Creamos condición

				$tela = new Tela(); // Instaciamos la Clase
				$id=(int)$_POST["id_tela"]; // Creamos variable para guardarel id recibido por GET

				$tela->setId_tela($id); // Enviamos los valores al modelo
				$tela->delete(); // llamamos a la función de eliminar del modelo

			}
		}

		public function search(){

			$nombre = ucwords($_POST["nombre"]);

			$tela = new Tela();
			$query= $tela->search($nombre);

			$this->sendAjax($query);
		}
	}
