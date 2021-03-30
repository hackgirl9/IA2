<?php
	class Rol extends BaseModel {
		// Atributos
        private $idRol;
        private $nombreRol;
        private $descripcionRol;


		// Métodos
		public function __construct() {
			$this->table = 'roles';
			parent::__construct();
		}

        public function getIdRol() {
            return $this->idRol;
        }

        public function getNombreRol() {
            return $this->nombreRol;
        }

        public function getDescripcionRol() {
            return $this->descripcionRol;
        }

        public function setIdRol($idRol) {
            $this->idRol = $idRol;
        }

        public function setNombreRol($nombreRol) {
            $this->nombreRol = $nombreRol;
        }

        public function setDescripcionRol($descripcionRol) {
            $this->descripcionRol = $descripcionRol;
        }

        public function save() {
            $this->registerBitacora(ROLES_PERMISOS,REGISTRAR);
            // var_export('hola'); die();
            $query = "INSERT INTO roles (nombre_rol, descripcion_rol) VALUES (:nombre_rol,:descripcion_rol) "; // COnsulta SQL
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            $result->bindParam(':nombre_rol',$this->nombreRol);
            $result->bindParam(':descripcion_rol',$this->descripcionRol);
            $save = $result->execute(); // Ejecuta la consulta
            return $save;
        }


        public function update() {
            // $this->registerBiracora(USUARIOS,ACTUALIZAR);
            $query = "UPDATE $this->table SET 
                        nombre_rol = :nombre_rol,
                        descripcion_rol = :descripcion_rol
                        WHERE id_rol = :id_rol";
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            // Limpia los parametros
            $result->bindParam(':id_rol',$this->idRol);
            $result->bindParam(':nombre_rol',$this->nombreRol);
            $result->bindParam(':descripcion_rol',$this->descripcionRol);
            $update = $result->execute(); // Ejecuta la consulta
            return $update;
        }

        public function delete() {

        }

        public function getAll() {
            $sql = "SELECT * FROM roles";
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
        //obtengo un rol
        public function getBy() {
            $sql="SELECT * FROM roles WHERE id_rol='$this->idRol'";
            $row=$this->db()->query($sql);
            if($row = $row->fetch(PDO::FETCH_OBJ)){
                $register = $row;
            }
            return $register;

        }
        //obtengo el modulo asociado a ese permisos
        public function getByModule(){
            $sql="SELECT * FROM roles
                                INNER JOIN rol_permisos_modulos on roles.id_rol = rol_permisos_modulos.id_rol  
                                    INNER JOIN modulos ON modulos.id_modulo=rol_permisos_modulos.id_modulo WHERE roles.id_rol='$this->idRol'";

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
            //obtengo el permiso asociado
        public function getByPermisos(){
            $sql="SELECT * FROM roles
                                INNER JOIN rol_permisos_modulos on roles.id_rol = rol_permisos_modulos.id_rol  
                                    INNER JOIN permisos ON permisos.id_permiso=rol_permisos_modulos.id_permiso WHERE roles.id_rol='$this->idRol'";
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
            //obtengo el ultimo rol insertado
        public function getByIdLast(){
		    $sql="SELECT * FROM roles ORDER BY id_rol DESC LIMIT 1";
            $row=$this->db()->query($sql);
            if($row = $row->fetch(PDO::FETCH_OBJ)){
                $register = $row;
            }
            return $register;
        }

        //obtengo los modulos registrados
        public function getModule(){
            $sql = "SELECT * FROM modulos";
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

        //obtengo los permisos registrados
        public function getPermisos(){
            $sql = "SELECT * FROM permisos";
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

        public function saveRolPermisoModule($id_rol,$id_modulo,$id_permiso){

            $query = "INSERT INTO rol_permisos_modulos (id_rol, id_permiso, id_modulo) VALUES (:id_rol,:id_permiso,:id_modulo) "; // COnsulta SQL
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            $result->bindParam(':id_rol',$id_rol);
            $result->bindParam(':id_permiso',$id_permiso);
            $result->bindParam(':id_modulo',$id_modulo);
            $save = $result->execute(); // Ejecuta la consulta
            return $save;
        }

        public function updateRolPermisoModule($id_rol,$id_modulo,$id_permiso) {
            // $this->registerBiracora(USUARIOS,ACTUALIZAR);
            $query = "UPDATE rol_permisos_modulos SET 
                        id_permiso = :id_permiso,
                        id_modulo = :id_modulo 
                        WHERE id_rol = :id_rol";
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            $result->bindParam(':id_rol',$id_rol);
            $result->bindParam(':id_permiso',$id_permiso);
            $result->bindParam(':id_modulo',$id_modulo);
            $update = $result->execute(); // Ejecuta la consulta
            return $update;
        }


        public function deleteRolPermisoModule($id_rol,$id_modulo,$id_permiso) {
            // $this->registerBiracora(USUARIOS,ELIMINAR);
            $query = "DELETE FROM rol_permisos_modulos WHERE id_rol = '$id_rol'"; // Consulta SQL
            $delete = $this->db()->query($query);
            return $delete;
        }

        public function getPermisosXModulosByRol($id_rol) {
            $sql = "SELECT id_modulo,id_permiso FROM rol_permisos_modulos WHERE id_rol = '$id_rol'";
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
