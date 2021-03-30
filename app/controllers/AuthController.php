<?php

  require_once "vendor/autoload.php";

	class AuthController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Auth/Login');
		}

		public function recoverPasswordView (){
		    $this->view('Auth/Recover.Password');
        }

        public function verifyEmail(){
			$email = $_POST['email'];
			$usuario = new Usuario ();
			$usuario->setEmailUsuario($email);

			$response= $usuario->verifyEmail();
			$this->sendAjax($response);

		}

		public function recoverPassword (){
			$email = $_POST['email'];
			$usuario = new Usuario();

			$usuario->setEmailUsuario($email);
			$usuario->sendEmail();

			$this->redirect('Auth', 'index');

		}

		public function recoverAccount (){
			$token = $_GET['id'];
			$user = new Usuario();

			$result = $user->recoverAccount($token);

			//var_dump($result);
			if($result){
				$user->updateToken($token);
				$this->view('Auth/Recover.Account', ['token' => $token]);
			}else{
				$this->view('Auth/Recover.Password', ['message' => 'Este Token ya fue revocado...']);

			}
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

        public function updatePasswordEspecial (){
            $password = $_POST['contrasenia_especial'];
            $nick = $_POST['nick_usuario'];

            $usuario = new Usuario();
            $usuario->setContraseniaEspecial($password);

            $response= $usuario->updatePasswordEspecial($nick);

            $this->sendAjax($response);

        }

		public function login() {



			if($_POST) { // Si se enviaron datos por post
				$usuario = new Usuario(); // Instancia del objeto
				$rol = new ROl();
				// Se setean los datos
				$usuario->setNickUsuario($_POST['nick_usuario']);
				$usuario->setContraseniaUsuario($_POST['contrasenia_usuario']);
				$usuarioSession = $usuario->login();

                $register = $usuario->getOne($_POST['nick_usuario']);


                if(is_object($register)&&$register->status==1){
                    $this->withMessage("Su usuario ha sido bloqueado por demasiados intentos fallidos,Debe contactar con un administrador para poder ser desbloqueado.");
                    $usuario->registerBitacora(INICIAR_SESION,FALLO,$register->nick_usuario);

                    return $this->redirect('Auth', 'index');

                }

				if($usuarioSession && is_object($usuarioSession)) { // Si se definio el usuario y es un objeto
				    $this->getAsk($usuarioSession->nick_usuario);
				}


				else {
                    $this->withMessage();
				    date_default_timezone_set('America/Caracas');
				    if(is_object($register)){
                        $usuario->registerBitacora(INICIAR_SESION,FALLO,$register->nick_usuario);
                        $data=$usuario->getFailsUsers();
                        if($data["block"]){
                            $usuario->setStatus(1);
                            $usuario->updateStatus();
                            $this->withMessage("Su usuario ha sido bloqueado por demasiados intentos fallidos,Debe contactar con un administrador para poder ser desbloqueado.");
                        }else{
                            $this->withMessage("Sus credenciales son incorrectas. Por favor, intente de nuevo. Intentos restantes:". $data["intento"]);
                        }
                    }




                    $this->redirect('Auth', 'index');
				}

			}
		}







		public function logout() {
			if(isset($_SESSION)) {
				$usuario = new Usuario();
				$usuario->registerBitacora(LOGOUT,CERRAR_SESION);
				session_destroy();
				$this->redirect();
			}
		}

		public function passwordRestore() {
            $usuario = new Usuario(); // Instancia del objeto
            $usuario->setNickUsuario($_POST['nick_usuario']);
            $usuario->setContraseniaUsuario($_POST['contrasenia_usuario']);
            $usuarioSession = $usuario->login();
            if($usuarioSession && is_object($usuarioSession)) {
                $this->sendAjax(true);
            }else{
                $this->sendAjax(false);
            }
		}



		public function changeProfileData (){
            $name       = $_POST['nombre_usuario'];
            $surname    = $_POST['apellido_usuario'];
            $nick       = $_POST['nick_usuario'];
            $email       = $_POST['email_usuario'];

            $usuario = new Usuario();

            $usuario->setNombreUsuario($name);
            $usuario->setNickUsuario($nick);
            $usuario->setApellidoUsuario($surname);
            $usuario->setEmailUsuario($email);

            $response= $usuario->updateProfile($nick);

            $this->sendAjax($response);
        }



		public function withMessage($message=null){
            $_SESSION['error'] = true;
		    if(is_null($message)){
                $_SESSION['message'] = "Sus credenciales son incorrectas. Por favor, intente de nuevo.";
            }else{
                $_SESSION['message'] = $message;
            }
        }


        public function profile(){
            if(isset($_GET['id'])) {
                $rol = new Rol();
                $roles=$rol->getAll();
                $nickUsuario = $_GET['id'];
                $usuario = new Usuario();

                $pregunta=new Pregunta();
                $allPreguntas=$pregunta->getAll();

                $imageSeguridad=new ImageSeguridad();
                $allImageSeguridad=$imageSeguridad->getAll();

                $register = $usuario->getOne($nickUsuario);

                return $this->view('Perfil/Perfil',['usuario' => $register,
                    "allPreguntas"=>$allPreguntas,
                    "allImageSeguridad"=>$allImageSeguridad
                ]);
            }
        }




        public function updatePreguntaSeguridad(){
            if($_POST) { // Si se enviaron datos por post
                $nickUsuario=$_POST['nick'];
                $pregunta=$_POST['pregunta'];
                $respuesta=$_POST['respuesta'];
                $imagen=$_POST['image'];
                $idImagenSelect=$_POST['id_imagen_select'];



                $preguntaSeguridad = new PreguntaSeguridad(); // Instancia del objeto
                $preguntaSeguridad->setNickUsuario($nickUsuario);
                $isPregunta = $preguntaSeguridad->getBy();

                if(!is_null($isPregunta)){
                    $preguntaSeguridad->delete();
                }
                $this->crearImagenSeguridad($imagen,$nickUsuario,$pregunta,$respuesta,$idImagenSelect);
                $this->sendAjax(true);
            }

        }




        public function crearImagenSeguridad($imagen,$nickUsuario,$pregunta,$respuesta,$idImagenSelect){
            $processor = new KzykHys\Steganography\Processor();
            $image = $processor->encode( $imagen,  Helpers::aesEncrypt($respuesta)); // jpg|png|gif
            $respuesta='storage/preguntas/image'.time().".png";
            $image->write($respuesta); // png only
            $preguntaSeguridad = new PreguntaSeguridad(); // Instancia el objeto
            $preguntaSeguridad->setNickUsuario($nickUsuario);
            $preguntaSeguridad->setRespuesta($respuesta);
            $preguntaSeguridad->setPregunta($pregunta);
            $preguntaSeguridad->setIdImagenSeguridad($idImagenSelect);
            $preguntaSeguridad->save();
        }





        public function getAsk($nick){
            $_SESSION['error'] = false;
            $preguntaSeguridad = new PreguntaSeguridad(); // Instancia el objeto
            $preguntaSeguridad->setNickUsuario($nick);
            $pregunta=$preguntaSeguridad->getBy();



            if($pregunta==null&&$nick=='root'){
                return $this->createdSession($nick);
            }

            $image=new ImageSeguridad();
            $image->setIdImagenSeguridad($pregunta->id_imagen_seguridad);
            $imageUser=$image->getBy();
            $allImagen=$image->getImagenRand();
            $allImagen[]=$imageUser;
            $this->shuffle_assoc($allImagen);

		    return $this->view('Auth/Verify.Ask',["nick"=>$nick,"allImagen"=>$allImagen, "pregunta"=>$pregunta]);
        }



        function shuffle_assoc(&$array) {
            $keys = array_keys($array);

            shuffle($keys);

            foreach($keys as $key) {
                $new[$key] = $array[$key];
            }

            $array = $new;
            return true;
        }


        public function verifyAsK()
        {

            if ($_POST) { // Si se enviaron datos por post
                $preguntaSeguridad = new PreguntaSeguridad(); // Instancia del objeto
                $preguntaSeguridad->setNickUsuario($_POST['nick_usuario']);

                $pregunta = $preguntaSeguridad->getBy();
                $respuesta = $_POST["respuesta"];
                $idImagenSelect = $_POST["id_image_select"];


                $imagePath = Helpers::aesDecrypt($pregunta->respuesta);
                $processor = new KzykHys\Steganography\Processor();
                $message = $processor->decode($imagePath);
                $respuestaDecript = Helpers::aesDecrypt($message);


                if($respuesta!=$respuestaDecript||$idImagenSelect!=$pregunta->id_imagen_seguridad){
                    $this->withMessage("Su respuesta fue incorrecta. Por favor, intente de nuevo. ");
                    $this->redirect('Auth', 'index');
                }else{

                    $this->createdSession($_POST['nick_usuario']);
                }

            }
        }



        public function createdSession($nickUsuario){
            $rol = new ROl();
            $usuario=new Usuario();
            $usuarioSession = $usuario->getOne($nickUsuario);

            $idRol = $usuarioSession->id_rol;

            $PermisosXModulos = $rol->getPermisosXModulosByRol($idRol);
            $_SESSION['nick_usuario'] = $usuarioSession->nick_usuario;
            $_SESSION['user'] = $usuarioSession;
            $_SESSION['authenticated'] = true;
            $_SESSION['permissions'] = $PermisosXModulos;
            $_SESSION['error'] = false;

            $_SESSION['message'] = "Log in successfully";
            $usuario->registerBitacora(USUARIOS,INICIAR_SESION);
            $this->redirect('Home','index');
        }

	}
