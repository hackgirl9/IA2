<?php
	class Tela extends BaseModel {
		// Atributos de la clase
		private $id_tela;
		private $nombre_tela;
		private $descripcion_tela;
		private $unidad_med_tela;
		private $tipo_tela;
		private $table;

		// Métodos de la clase
		public function __construct() {
			$this->table="telas"; //colocar valor al atributo table
			parent::__construct();
		}

		//Setter de los atributos
		public function setId_tela($id_tela){

			$this->id_tela = $id_tela;
		}

		public function setNombre_tela($nombre_tela) {

				$this->nombre_tela = $nombre_tela;
		}

		public function setDescripcion_tela($descripcion_tela){

				$this->descripcion_tela = $descripcion_tela;
		}

		public function setUnidad_med_tela($unidad_med_tela){

				$this->unidad_med_tela = $unidad_med_tela;
		}

		public function setTipo_tela($tipo_tela){

				$this->tipo_tela = $tipo_tela;

		}

		// Getter de los atributos
		public function getId_tela(){

			return $this->id_tela;
		}

		public function getNombre_tela(){

			return $this->nombre_tela;
		}


		public function getDescripcion_tela(){

				return $this->descripcion_tela;
		}

		public function getUnidad_med_tela(){

				return $this->unidad_med_tela;
		}


		public function getTipo_tela(){

				return $this->tipo_tela;
		}

		public function getAll(){ // Consulta para obtener todas las telas registardas

			$query= $this->db()->query("SELECT * FROM $this->table ORDER BY nombre_tela ASC"); // Creando consulta sql

			if($query->rowCount()>=1){ //Verificando si hay mas de una fila

				while($row = $query->fetch(PDO::FETCH_OBJ)){ //Creando un ciclo para que los devuelva los registros como objetos

					$register [] = $row; // Guardando los registros en un array
				}

			}else{
					$register = null; // Devolvemos un null si la condicion no se cumple
			}

			$this->registerBitacora(TELAS , CONSULTAR);

			return $register; // Retornamos la variable


		}

		public function getById(){ // Consulta para obtener un solo registro especifico

			$query = $this->db()->query("SELECT * FROM $this->table WHERE id_tela='$this->id_tela'"); // Creando consulta sql

			if($row = $query->fetch(PDO::FETCH_OBJ)){ // Guardamos el registro como objeto si existe

				$result = $row; // Se guarda el registro en una variable
			}

			$this->registerBitacora(TELAS , DETALLES);

			return $result; //retornamos la variable

		}

		public function save(){ // Metodo de registro

			//Consulta sql
            try {
                $this->db()->beginTransaction();

                $sql="INSERT INTO $this->table (id_tela,
											nombre_tela,
											descripcion_tela,
											unidad_med_tela,
											tipo_tela)

				  VALUES                    (default,
				  							 :nombre,
											 :descrip,
											 :unidad,
											 :tipo)";

                $query = $this->db()->prepare($sql); //preparamos consulta

                //asignamos valores a los marcadores
                $query->bindParam(':nombre' , $this->nombre_tela);
                $query->bindParam(':descrip', $this->descripcion_tela);
                $query->bindParam(':unidad'	, $this->unidad_med_tela);
                $query->bindParam(':tipo'   , $this->tipo_tela);

                $registering = $query->execute(); // Ejecutamos el registro y guardamos en una variable

                $this->registerBitacora(TELAS , REGISTRAR);
                $this->db()->commit();

                return $registering; // retornamos la variable
            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }


	}

		public function delete(){ // Metodo Eliminar

            try {
                $this->db()->beginTransaction();

                $query=$this->db()->query("DELETE FROM $this->table WHERE id_tela= '$this->id_tela' "); // Creando consulta sql
                $this->registerBitacora(TELAS , ELIMINAR);
                $this->db()->commit();

                return $query; // Retornamos la variable
            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }


		}

		public function update(){ // Metodo Actualizar

            try {
                $this->db()->beginTransaction();
                // Consulta sql
                $sql="UPDATE $this->table SET  nombre_tela     =:nombre,
										   descripcion_tela=:descrip,
										   unidad_med_tela =:unidad,
										   tipo_tela       =:tipo
				   WHERE id_tela =:id_tela";

                $query=$this->db()->prepare($sql); // Preparamos la consulta

                //le asignamos los valores a los marcadores
                $query->bindParam(':id_tela', $this->id_tela);
                $query->bindParam(':nombre',  $this->nombre_tela);
                $query->bindParam(':descrip', $this->descripcion_tela);
                $query->bindParam(':unidad',  $this->unidad_med_tela);
                $query->bindParam(':tipo',    $this->tipo_tela);

                $updating = $query->execute(); // Ejecutamos la consulta

                $this->registerBitacora(TELAS , ACTUALIZAR);
                $this->db()->commit();
                return $updating; // Retornamos la variable

            }catch (Exception $exception){
                $this->db()->rollBack();
                return false;
            }


		}

		public function search($nombre){

			$query = $this->db()->query("SELECT * FROM telas WHERE nombre_tela ='$nombre'");

			if ($row = $query->fetch(PDO::FETCH_OBJ)){

				$search = $row;

			}else{

				$search = null;
			}

			return $search;

		}
}
