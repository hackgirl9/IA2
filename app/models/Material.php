<?php
	class Material extends BaseModel {

		// Atributos de la clase
		private $id_material;
		private $nombre_material;
		private $descripcion_material;
		private $unidad_material;
		private $precio_material;
		private $table;

		// Métodos de la clase
		public function __construct() {
			parent::__construct(); //colocar valor al atributo table
			require_once ('config/actions.php');
			require_once ('config/modules.php');
			$this->table="materiales";
		}

		//Setter de los atributos
		public function setId_material($id_material){

				$this->id_material = $id_material;
		}


		public function setNombre_material($nombre_material){

				$this->nombre_material = $nombre_material;
		}

		public function setDescripcion_material($descripcion_material){

				$this->descripcion_material = $descripcion_material;

		}


		public function setUnidad_material($unidad_material){

				$this->unidad_material = $unidad_material;
		}

		public function setPrecio_material($precio_material){

				$this->precio_material = $precio_material;
		}

		// Getter de los atributos

		public function getId_material(){

				return $this->id_material;
		}


		public function getNombre_material(){

				return $this->nombre_material;
		}


		public function getDescripcion_material(){

				return $this->descripcion_material;
		}

		public function getUnidad_material(){

				return $this->unidad_material;
		}

		public function getPrecio_material(){

				return $this->precio_material;
		}

		public function getAll(){ // Consulta para obtener todas las telas registardas

			$query = $this->db()->query("SELECT * FROM $this->table ORDER BY nombre_material ASC"); // Creando consulta sql

			if($query->rowCount()>=1){ //Verificando si hay mas de una fila

				while($row = $query->fetch(PDO::FETCH_OBJ)){ //Creando un ciclo para que los devuelva los registros como objetos

					$register [] = $row; // Guardando los registros en un array
				}

			}else{
				$register = null; // Devolvemos un null si la condicion no se cumple
			}

			$this->registerBitacora(MATERIALES , CONSULTAR);

			return $register; // Retornamos la variable

		}

		public function getById(){ // Consulta para obtener un solo registro especifico

			$query = $this->db()->query("SELECT * FROM $this->table WHERE id_material = $this->id_material"); // Creando consulta sql

			if($row = $query->fetch(PDO::FETCH_OBJ)){ // Guardamos el registro como objeto si existe

				$result = $row; // Se guarda el registro en una variable
			}

			$this->registerBitacora(MATERIALES , DETALLES);

			return $result; //retornamos la variable
		}

		public function save(){ // Metodo de registro

            try {
                $this->db()->beginTransaction();
                //Consulta sql
                $sql = "INSERT INTO $this->table (id_material,
											  nombre_material,
											  descripcion_material,
											  unidad_material,
											  precio_material)
											  
					VALUES                   (default,
											  :nombre,
											  :descrip,
											  :unidad,
											  :precio)";

                $material = $this->db()->prepare($sql); //preparamos consulta

                //asignamos valores a los marcadores
                $material->bindParam(':nombre',  $this->nombre_material);
                $material->bindParam(':descrip', $this->descripcion_material);
                $material->bindParam(':unidad',  $this->unidad_material);
                $material->bindParam(':precio',  $this->precio_material);

                $registering = $material->execute(); // Ejecutamos el registro y guardamos en una variable

                $this->registerBitacora(MATERIALES , REGISTRAR);
                $this->db()->commit();

                return $registering; // retornamos la variable
            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }


		}

		public function update(){ // Metodo Actualizar

            try {
                $this->db()->beginTransaction();
                // Consulta sql
                $sql = "UPDATE $this->table SET nombre_material      = :nombre,
											descripcion_material =:descrip,
											unidad_material      = :unidad,
											precio_material      = :precio
					WHERE id_material = :id ";

                $material = $this->db()->prepare($sql); // Preparamos la consulta

                //le asignamos los valores a los marcadores
                $material->bindParam(':id',      $this->id_material);
                $material->bindParam(':nombre',  $this->nombre_material);
                $material->bindParam(':descrip', $this->descripcion_material);
                $material->bindParam(':unidad',  $this->unidad_material);
                $material->bindParam(':precio',  $this->precio_material);

                $updating = $material->execute(); // Ejecutamos la consulta

                $this->registerBitacora(MATERIALES , ACTUALIZAR);
                $this->db()->commit();

                return $updating; // Retornamos la variable
            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }




		}

		public function delete(){ // Metodo Eliminar
            try {
                $this->db()->beginTransaction();

                $query = $this->db()->query("DELETE FROM $this->table WHERE id_material = '$this->id_material' "); // Creando consulta sql
                $this->registerBitacora(MATERIALES , ELIMINAR);
                $this->db()->commit();

                return $query; // Retornamos la variable

            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }

		}

		public function search($nombre){

			$query = $this->db()->query("SELECT * FROM materiales WHERE nombre_material ='$nombre'");

			if ($row = $query->fetch(PDO::FETCH_OBJ)){

				$search = $row;

			}else{

				$search = null;
			}

			return $search;

		}


	}
