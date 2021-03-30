<?php
	class Modulo extends BaseModel {
		// Atributos
		private $idModulo;
		private $nombreModulo;


		// Métodos
		public function __construct() {
			$this->table = 'modulos';
			parent::__construct();
		}

		public function getIdModulo() {
            return $this->idModulo;
        }

        public function getNombreModulo() {
            return $this->nombreModulo;
        }

        public function setIdModulo($idModulo) {
            $this->idModulo = $idModulo;
        }

        public function setNombreModulo($nombreModulo) {
            $this->nombreModulo = $nombreModulo;
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
	}
