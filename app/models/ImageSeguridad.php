<?php
	class ImageSeguridad extends BaseModel {
		// Atributos
		private $idImagenSeguridad;
        private $image;

        // Métodos
        public function __construct() {
            $this->table = 'imagen_seguridad';
            parent::__construct();
        }

        public function getIdImagenSeguridad()
        {
            return $this->idImagenSeguridad;
        }


        public function setIdImagenSeguridad($idImagenSeguridad)
        {
            $this->idImagenSeguridad = $idImagenSeguridad;
        }


        public function getImage()
        {
            return $this->image;
        }


        public function setImage($image)
        {
            $this->image = $image;
        }


        public function getAll() {
			// $this->registerBiracora(PRODUCTOS,CONSULTAR);
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



        public function getBy(){
            $sql="SELECT * FROM  $this->table WHERE id_imagen_seguridad='$this->idImagenSeguridad'";
            $row=$this->db()->query($sql);
            if($row = $row->fetch(PDO::FETCH_OBJ)){
                $register = $row;
            }
            return $register;
        }


        public function getImagenRand(){
            $sql = "SELECT * FROM $this->table WHERE id_imagen_seguridad != '$this->idImagenSeguridad' ORDER BY random() limit 6" ;
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







	}
