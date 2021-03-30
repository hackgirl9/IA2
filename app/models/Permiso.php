<?php
	class Permiso extends BaseModel {
		// Atributos
		private $idPermiso;
        private $nombrePermiso;
        private $descripcionPermiso;


		// Métodos
		public function __construct() {
			$this->table = 'permisos';
			parent::__construct();
		}

		public function getIdPermiso() {
            return $this->idPermiso;
        }

        public function getNombrePermiso() {
            return $this->nombrePermiso;
        }

        public function getDescripcionPermiso() {
            return $this->descripcionPermiso;
        }

        public function setIdPermiso($idPermiso) {
            $this->idPermiso = $idPermiso;
        }

        public function setNombrePermiso($nombrePermiso) {
            $this->nombrePermiso = $nombrePermiso;
        }

        public function setDescripcionPermiso($descripcionPermiso) {
            $this->descripcionPermiso = $descripcionPermiso;
        }

        public function save() {

        }

        public function update() {

        }

        public function delete() {

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

        public function getBy() {

        }
	}
