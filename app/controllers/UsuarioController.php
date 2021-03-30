<?php

       require_once "vendor/autoload.php";


	class UsuarioController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Usuarios/Usuarios');
		}

		public function create() {
            $rol = new Rol();
            $roles=$rol->getAll();

            $pregunta=new Pregunta();
            $allPreguntas=$pregunta->getAll();

            $imageSeguridad=new ImageSeguridad();
            $allImageSeguridad=$imageSeguridad->getAll();


			$this->view('Usuarios/Usuarios.Registrar',['roles'=>$roles,
                'allPreguntas'=>$allPreguntas,
                'allImageSeguridad'=>$allImageSeguridad
            ]);
		}

		public function getAll() {
			$usuario = new Usuario(); // Instancia el objeto
			$allUsuarios = $usuario->getAll(); // Obtiene todos los usuarios


			$this->view('Usuarios/Usuarios.Consultar', ['allUsuarios' => $allUsuarios]);
		}

		public function register() {
			if($_POST) { // Si se pasan datos por post
				// Valida los datos recibidos por los inputs
				$nickUsuario = $_POST['nick_usuario'];
				$nombreUsuario = $this->input('nombre_usuario', true, 'string');
				$apellidoUsuario = $this->input('apellido_usuario', true, 'string');
				$emailUsuario = $this->input('email_usuario', true, 'string');
				$contraseniaUsuario = $this->input('contrasenia_usuario', true, 'string');
				$contraseniaEspecial = $this->input('contrasenia_especial', true, 'string');
				$idRol = $this->input('id_rol', true, 'int');
                $pregunta = $this->input('pregunta', true, 'string');
                $respuesta = $this->input('respuesta', true, 'string');
                $imagen= $this->input('image', true, 'string');
                $imagenSelect= $this->input('id_imagen_select', true, 'string');


				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Usuario','index'); // Redirecciona al inicio.
				}
				else {


				    // Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nickUsuario);
					$usuario->setNombreUsuario(ucwords($nombreUsuario));
					$usuario->setApellidoUsuario(ucwords($apellidoUsuario));
					$usuario->setEmailUsuario($emailUsuario);
					$usuario->setContraseniaEncriptada($contraseniaUsuario);
                    $usuario->setContraseniaEspecial($contraseniaEspecial);
					$usuario->setIdRol($idRol);
					$data = $usuario->save();


                    $processor = new KzykHys\Steganography\Processor();
                    $image = $processor->encode( $imagen,  Helpers::aesEncrypt($respuesta)); // jpg|png|gif
                    $imagePath='storage/preguntas/image'.time().".png";
                    $image->write($imagePath); // png only
                    $preguntaSeguridad = new PreguntaSeguridad(); // Instancia el objeto
                    $preguntaSeguridad->setNickUsuario($nickUsuario);
                    $preguntaSeguridad->setRespuesta($imagePath);
                    $preguntaSeguridad->setIdImagenSeguridad($imagenSelect);
                    $preguntaSeguridad->setPregunta($pregunta);
                    $preguntaSeguridad->save();

					$this->sendAjax($data);
				}
			}
		}

		public function details() {
			if(isset($_GET['id'])) {
                $rol = new Rol();
                $roles=$rol->getAll();
				$nickUsuario = $_GET['id'];
				$usuario = new Usuario();
				$register = $usuario->getOne($nickUsuario);
				$this->view('Usuarios/Usuarios.Detalles', ['usuario' => $register,'roles'=>$roles]);
			}
		}

		public function update() {
			if($_POST) { // Si se pasan datos por post
				// Valida los datos recibidos por los inputs
				$nickUsuario = $_POST['nick_usuario'];
				$nombreUsuario = $this->input('nombre_usuario', true, 'string');
				$apellidoUsuario = $this->input('apellido_usuario', true, 'string');
				$emailUsuario = $this->input('email_usuario', true, 'string');
				//$contraseniaUsuario = $this->input('contrasenia_usuario', true, 'string');
				$idRol = $this->input('id_rol', true, 'int');
				$status = $_POST['status'];
				// Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nickUsuario);
					$usuario->setNombreUsuario(ucwords($nombreUsuario));
					$usuario->setApellidoUsuario(ucwords($apellidoUsuario));
					$usuario->setEmailUsuario($emailUsuario);
					//$usuario->setContraseniaEncriptada($contraseniaUsuario);
					$usuario->setIdRol($idRol);
					$usuario->setStatus($status);
					$data = $usuario->update();
					$this->sendAjax($data);

			}
		}

		public function delete() {
			if(isset($_POST['nick_usuario'])) {
				$nickUsuario = $_POST['nick_usuario'];
				$usuario = new Usuario();
				$usuario->setNickUsuario($nickUsuario);
				$data = $usuario->delete();
				$this->sendAjax($data);
			}
		}

		public function checkNickUsuario() {
			$nickUsuario = $this->input('nick_usuario', true, 'string');
    		$usuario = new Usuario();
    		$usuario->setNickUsuario($nickUsuario);
   			$response = $usuario->checkNickUsuario();
    		$this->sendAjax($response);
    	}

    	public function checkEmailUsuario() {
			$emailUsuario = $this->input('email_usuario', true, 'string');
    		$usuario = new Usuario();
    		$usuario->setEmailUsuario($emailUsuario);
   			$response = $usuario->checkEmailUsuario();
    		$this->sendAjax($response);
    	}

			public function updatePassword() {
				if($_POST) { // Si se pasan datos por post
					// Valida los datos recibidos por los inputs
					$nickUsuario = $this->input('nick_usuario', true, 'string');
					$contraseniaUsuario = $this->input('contrasenia_usuario', true, 'string');
					$repearContraseniaUsuario = $_POST['repeat_contrasenia_usuario'];
					if($contraseniaUsuario === $repearContraseniaUsuario) {
						$usuario = new Usuario(); // Instancia el objeto
						$usuario->setNickUsuario($nickUsuario);
						$usuario->setContraseniaEncriptada($contraseniaUsuario);
						$data = $usuario->updatePassword2();
						$this->sendAjax($data);
					}
				}
			}
	}
