<?php
	class Usuario extends BaseModel {
		// Atributos
		private $table;
		private $nickUsuario;
		private $nombreUsuario;
		private $apellidoUsuario;
		private $emailUsuario;
		private $contraseniaUsuario;
		private $idRol;
		private $status;
        private $contraseniaEspecial;


		// Métodos
		public function __construct() {
			$this->table = 'usuarios';
			parent::__construct();
		}

		public function getNickUsuario() {
 			return $this->nickUsuario;
		}

		public function getNombreUsuario() {
 			return $this->nombreUsuario;
		}

		public function getApellidoUsuario() {
 			return $this->apellidoUsuario;
		}

		public function getEmailUsuario() {
 			return $this->emailUsuario;
		}

		public function getContraseniaUsuario() {
 			return $this->contraseniaUsuario;
		}

		public function getIdRol() {
 			return $this->idRol;
		}


        public function getStatus(){
            return $this->status;
        }



		public function setNickUsuario($nickUsuario) {
			$this->nickUsuario = $nickUsuario;
		}

		public function setNombreUsuario($nombreUsuario) {
			$this->nombreUsuario = $nombreUsuario;
		}

		public function setApellidoUsuario($apellidoUsuario) {
			$this->apellidoUsuario = $apellidoUsuario;
		}

		public function setEmailUsuario($emailUsuario) {
			$this->emailUsuario = $emailUsuario;
		}

		public function setContraseniaUsuario($contraseniaUsuario) {
			$this->contraseniaUsuario = $contraseniaUsuario;
		}

		public function setIdRol($idRol) {
			$this->idRol = $idRol;
		}

		public function setContraseniaEncriptada ($contraseniaUsuario) {
			$this->contraseniaUsuario = password_hash($contraseniaUsuario, PASSWORD_DEFAULT, array('cost'=>12));
		}


        public function setStatus($status){
            $this->status = $status;
        }

        public function setContraseniaEspecial ($contraseniaEspecial) {
            $this->contraseniaEspecial = password_hash($contraseniaEspecial, PASSWORD_DEFAULT, array('cost'=>12));
        }

		public function verifyEmail(){
            $sql = "SELECT * FROM $this->table WHERE email_usuario = '$this->emailUsuario'";
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
            return $resultSet; // Finalmente retorna el arreglo con los elementos.
        }

        public function sendEmail(){
			$sql = "SELECT * FROM $this->table WHERE email_usuario = '$this->emailUsuario'";
			$query = $this->db()->query($sql);
			$result = $query->fetch(PDO::FETCH_OBJ);

			$cadena = $result->nombre_usuario.$result->apellido_usuario.rand(1,9999999).date('Y-m-d');
			$token = hash("sha512",$cadena);

			$insert = "INSERT INTO tokens (token,revoked,nick_usuario) VALUES (:token,:revoked,:nick_usuario) "; // COnsulta SQL
			$register = $this->db()->prepare($insert);
			$revoked = true;

			$register->bindParam(':token',$token);
			$register->bindParam(':revoked',$revoked);
			$register->bindParam(':nick_usuario',$result->nick_usuario);

			$save = $register->execute(); // Ejecuta la consulta

			$to = 'angelmserranog@gmail.com';
			//$to = $this->emailUsuario;
			$subject = "Recuperar Contrasena";
			$headers =  'MIME-Version: 1.0' . "\r\n";
			$headers .= 'From: Your name <info@address.com>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$message = "
				<html>
				<head>
				<title>Recuperar Cuenta Inversiones IA2 </title>
				</head>
				<body>
				<h1>Recuperar Cuenta Inversiones IA2</h1>
				<p>Presione en el boton para reestablecer su contraseña</p>
					<a href='http://localhost/project-IA2/Auth/recoverAccount/$token' class='btn btn-large btn-rounded a2-green-gradient waves-effect effect-light'>
							Recuperar Contraseña
						   <i class='icon-send right'></i>
					 </a>
				</body>
				</html>";

			mail($to, $subject, $message, $headers);

			return true;

		}

		public function recoverAccount($token){
			$sql = "SELECT * FROM tokens WHERE token = '$token' AND revoked = 'true'";
			$query = $this->db()->query($sql);

			if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
				$result = $row;
			}

			if($row === true){
				return $row;
			}else{
				return $row;
			}
		}

		public function updateToken($token){
			$query = "UPDATE tokens SET 
						revoked = false
						WHERE token = '$token'";
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}

		public function updatePassword($token){

			$sql = "SELECT * FROM tokens WHERE token = '$token'";
			$query = $this->db()->query($sql);
			$row = $query->fetch(PDO::FETCH_OBJ);

			$query = "UPDATE $this->table SET 
						contrasenia_usuario = :contrasenia_usuario
						WHERE nick_usuario = '$row->nick_usuario'";

			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':contrasenia_usuario',$this->contraseniaUsuario);
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}

        public function updatePasswordEspecial($nick){

		    $nick_user = $nick;

            $query = "UPDATE $this->table SET 
						contrasenia_especial = :contrasenia_especial
						WHERE nick_usuario = '$nick_user'";

            $result = $this->db()->prepare($query); // Prepara la consulta SQL


            // Limpia los parametros
            $result->bindParam(':contrasenia_especial',$this->contraseniaEspecial);
            $update = $result->execute(); // Ejecuta la consulta

            return $update;
        }

        public function updateProfile($nick) {
            $this->registerBitacora(USUARIOS,ACTUALIZAR);
            $query = "UPDATE $this->table SET 
						nombre_usuario = :nombre_usuario,
						apellido_usuario = :apellido_usuario, email_usuario = :email_usuario,
                        nick_usuario = :nick_usuario
						WHERE nick_usuario = '$nick'";
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            // Limpia los parametros
            $result->bindParam(':nick_usuario',$this->nickUsuario);
            $result->bindParam(':nombre_usuario',$this->nombreUsuario);
            $result->bindParam(':apellido_usuario',$this->apellidoUsuario);
            $result->bindParam(':email_usuario',$this->emailUsuario);

            $update = $result->execute(); // Ejecuta la consulta
            return $update;
        }

		public function save() {
			$this->registerBitacora(USUARIOS,REGISTRAR);

			$query = "INSERT INTO $this->table (nick_usuario,
nombre_usuario,apellido_usuario,email_usuario,contrasenia_usuario, contrasenia_especial ,id_rol,
status) VALUES (:nick_usuario,:nombre_usuario,:apellido_usuario,:email_usuario,:contrasenia_usuario, :contrasenia_especial , :id_rol,:status) "; // COnsulta SQL

			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
            $status=0;
			$result->bindParam(':nick_usuario',$this->nickUsuario);
			$result->bindParam(':nombre_usuario',$this->nombreUsuario);
			$result->bindParam(':apellido_usuario',$this->apellidoUsuario);
			$result->bindParam(':email_usuario',$this->emailUsuario);
			$result->bindParam(':status',$status);
			$result->bindParam(':contrasenia_usuario',$this->contraseniaUsuario);
			$result->bindParam(':contrasenia_especial',$this->contraseniaEspecial);
			$result->bindParam(':id_rol',$this->idRol);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function update() {
			$this->registerBitacora(USUARIOS,ACTUALIZAR);
			$query = "UPDATE $this->table SET 
						nombre_usuario = :nombre_usuario,
						apellido_usuario = :apellido_usuario, email_usuario = :email_usuario, id_rol = :id_rol ,status=:status
						WHERE nick_usuario = :nick_usuario";
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nickUsuario);
			$result->bindParam(':nombre_usuario',$this->nombreUsuario);
			$result->bindParam(':apellido_usuario',$this->apellidoUsuario);
			$result->bindParam(':email_usuario',$this->emailUsuario);
			$result->bindParam(':status',$this->status);
			$result->bindParam(':id_rol',$this->idRol);
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}

		public function delete() {
			$this->registerBitacora(USUARIOS,ELIMINAR);
			$query = "DELETE FROM $this->table WHERE nick_usuario = '$this->nickUsuario'"; // Consulta SQL
			$delete = $this->db()->query($query);
			return $delete;
		}

		public function getAll() {
			$this->registerBitacora(USUARIOS,CONSULTAR);
			$sql = "SELECT * FROM $this->table INNER JOIN roles ON roles.id_rol = usuarios.id_rol";
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

		public function getOne($nickUsuario) {
			//$this->registerBitacora(USUARIOS,DETALLES);
            $register=null;
			$sql = "SELECT * FROM $this->table INNER JOIN roles ON roles.id_rol = usuarios.id_rol WHERE usuarios.nick_usuario = '$nickUsuario'"; // Consulta SQL
			$query = $this->db()->query($sql); // Ejecuta la consulta SQL
            if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                $register = $row; // Lo almacena en $register
            }
            return $register; // Y finalmente, lo retorna.
		}

		public function login() {
		    $register=null;
			$query = "SELECT * FROM $this->table WHERE nick_usuario = '$this->nickUsuario'"; // Consulta SQL
			$login = $this->db()->query($query); // Ejecuta la consulta SQL directamente
			if($login && $login->rowCount() == 1) { // Si existe un registro...
				if($usuario = $login->fetch(PDO::FETCH_OBJ)) {
					$verify = password_verify($this->contraseniaUsuario,$usuario->contrasenia_usuario); // Verifica la contraseña
                    if($verify){ // Si la verificacion es exitosa
                        $register = $usuario;
                    }
				}
				else {
					$register = null;
				}
			}
			else {
				$register = null;
			}



			return $register;
		}

		public function checkNickUsuario() {
			$sql = "SELECT nick_usuario FROM $this->table 
					WHERE nick_usuario = '$this->nickUsuario'";
			$query = $this->db()->query($sql);
			if($query){
                if($query->rowCount() != 0){
                    if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                        $register = $row; // Lo almacena en $register
                    }
                }
                else{
                    $register = null;
                }
            }
            return $register; // Y finalmente, lo retorna.
		}

		public function checkEmailUsuario() {
			$sql = "SELECT email_usuario FROM $this->table 
					WHERE email_usuario = '$this->emailUsuario'";
			$query = $this->db()->query($sql);
			if($query){
                if($query->rowCount() != 0){
                    if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                        $register = $row; // Lo almacena en $register
                    }
                }
                else{
                    $register = null;
                }
            }
            return $register; // Y finalmente, lo retorna.
		}

		public function changePassword() {

		}

		public function getBitacora() {
			$this->registerBitacora(BITACORA,CONSULTAR);
			$sql = "SELECT * FROM bitacoras ORDER BY hora_actu_bitacora DESC";
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


		public function getFailsUsers(){

		    $now=date('Y-m-d');
            $sql = "SELECT * FROM bitacoras where
                 nick_usuario='$this->nickUsuario' and accion_bitacora='FALLO' 
                 AND modulo_bitacora='INICIAR SESION'  and fecha_actu_bitacora='$now'";
            $query = $this->db()->query($sql);

            if($query){ // Evalua la cansulta
                if($query->rowCount() >= 3) { // Si existe al menos un registro...
                  return  ["intento"=>$query->rowCount(),"block"=>true];
                }
                else{ // Sino...
                    return ["intento"=>3-$query->rowCount(),"block"=>false];
                }
            }
            return null; // Finalmente retornla el arreglo con los elementos.
        }



        public function updateStatus(){
            $query = "UPDATE $this->table SET 
						status = :status
						WHERE nick_usuario = :nick_usuario";

            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            // Limpia los parametros
            $result->bindParam(':nick_usuario',$this->nickUsuario);
            $result->bindParam(':status',$this->status);
            $update = $result->execute(); // Ejecuta la consulta
            return $update;
        }






		public function updatePassword2(){

			// $sql = "SELECT * FROM tokens WHERE token = '$token'";
			// $query = $this->db()->query($sql);
			// $row = $query->fetch(PDO::FETCH_OBJ);
			$query = "UPDATE $this->table SET 
						contrasenia_usuario = :contrasenia_usuario
						WHERE nick_usuario = :nick_usuario";

			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nickUsuario);
			$result->bindParam(':contrasenia_usuario',$this->contraseniaUsuario);
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}



        public function verifyPasswordEspecial ($password){
            $verify = false;
            $query = $this->db()->query("SELECT * FROM $this->table WHERE  nick_usuario='$this->nickUsuario'"); // Creando consulta sql

            if($row = $query->fetch(PDO::FETCH_OBJ)){ // Guardamos el registro como objeto si existe
                $result = $row; // Se guarda el registro en una variable
                $verify = password_verify($password, $result->contrasenia_especial);
            }else{
                $result = null;
            }

            return $verify;

        }

	}
