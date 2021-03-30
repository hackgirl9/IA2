<?php
require_once ('config/database.php');

class Helpers{//clases donde se añaden metodos que se necesiten en la vista

    public static function url($controller=DEFAULT_CONTROLLER,$action=DEFAULT_ACTION){//Pinta la url para la redirreciones
        $urlString=BASE_URL.$controller.'/'.$action;
         return  $urlString;
    }

    //verifica si hay un error en la validacion
    public static function isError($_name){
        if(isset($_SESSION[$_name])){
            return true;
        }else{
            return false;
        }
    }
    //muestra el mensaje de error en una session y luego lo borra
    public static function messageError($_name){
            if(isset($_SESSION[$_name])){
                $message=$_SESSION[$_name];
                $_SESSION[$_name]=null;
                unset($_SESSION[$_name]);
            }

            return $message;
        }

    // Mejorar para identificar al usuario
    /*public static function isAuth() {
        if(!isset($_SESSION['user_auth'])) {
            header("Location:".BASE_URL);
        }
        else{
            return true;
        }
    }
*/
    public static function saveImage($file,$directory){ // Se encarga de guardar los datos y mover la imagen a un directorio
        if(isset($file)){ // Si se ha definido un archivo
            $filename = $file['name']; // Nombre del archivo
            $tmpFilename = $file['tmp_name'];  // Nombre del archivo en carpeta temporal
            $mimetype = $file['type']; // Tipo del archivo
            if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif'){ // Verifica si el tipo de archivo es correcto
                if(!is_dir('storage/'.$directory)){ // Sino existe el directorio
                    mkdir('storage/'.$directory,0777,true); // Lo crea con todos los permisos
                }
                move_uploaded_file($tmpFilename,"storage/$directory/$filename"); // Y mueve el archivo del directorio temporal al directorio fisico
            }
            return $filename; // Finalmente, retorna el nombre del archivo para la base de datos
        }
        else{
            return null; // Sino, retorna null.
        }
    }

    public static function getTallas() {
        $producto = new Producto();
        $tallas = $producto->getAllTallas();
        return $tallas;
    }

    public static function hasPermissions($module,$permission=null,$route=null,$nameModule=null) {
        /*Funcion para la verificación de los permisos:
         * module:numero de modulo de registro en base de datos (OBLIGATORIO)
         * permission:numero de permisos en el registro en base de datos(OPCIONAL)
         *  route:parametro true se indica para el bloqueo de la ruta bool (OPCIONAL)
         * nameModule:Nombre de modulo se utiliza para la redireccion al index
         *
         * Objetivo:si solo se pasa el parametro module, verifica que el modulo sea del usuario
         *          si se le pasan los 2 parametros,verifica que el modulo sea del usaurio y tenga ese permiso
         *          si le pasan 3 y 4 parametros, si el modulo y ese permiso no le pertenece al usuario lo redirege al
         *          home de cada modulo
         *
         *          retorna true=SI tiene permiso.
         *                   false=NO tiene permiso.
         * */





        $band=false;
        if(isset($_SESSION['permissions'])){
            for($i=0;$i<count($_SESSION['permissions']);$i++){
               if(is_null($permission)){
                   if($_SESSION['permissions'][$i]->id_modulo==$module){
                       $band=true;
                       break;
                   }
               }else{

                   if($_SESSION['permissions'][$i]->id_modulo==$module&&$_SESSION['permissions'][$i]->id_permiso==$permission){
                       $band=true;
                       break;
                   }
               }

            }

            if(!is_null($route)&& !$band){
                header('Location:'.BASE_URL.$nameModule."/index");
            }
        }

        return $band;
    }



    public  static function blowfishKey($key)
    {
        if("$key" === '')
            return $key;

        $len = (16+2) * 4;
        while(strlen($key) < $len) {
            $key .= $key;
        }
        $key = substr($key, 0, $len);
        return $key;
    }


    public static  function blowfishEncrypt($str)
    {
        $key=KEY_BLOWFISH;

        $blockSize = 64;
        $len = strlen($str);
        $paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
        $padding = str_repeat("\0", $paddingLen);
        $data = $str . $padding;
        $key = self::blowfishKey($key);
        $encrypted = openssl_encrypt($data, 'BF-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
        return bin2hex($encrypted);
    }

    public static function blowfishDecrypt($hex){
        $key=KEY_BLOWFISH;
        $is_hash = substr($hex, 16);

        if(!$is_hash){
            return $hex;
        }
        $key = self::blowfishKey($key);
        $decrypted = openssl_decrypt(hex2bin($hex), 'BF-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
        return rtrim($decrypted, "\0");
    }


    public static function  aesEncrypt($plaintext) {
        $method = "AES-256-CBC";
        $password=KEY_AES;
        $key = hash('sha256', $password, true);
        $blockSize = 64;
        $len = strlen($plaintext);
        $paddingLen = intval(($len + $blockSize - 1) / $blockSize) * $blockSize - $len;
        $padding = str_repeat("\0", $paddingLen);
        $plaintext = $plaintext . $padding;

        $iv = openssl_random_pseudo_bytes(16);
        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
        return base64_encode($iv . $hash . $ciphertext);
    }
    public static function aesDecrypt($ivHashCiphertext) {
        $codeEncrypt=$ivHashCiphertext;
        $ivHashCiphertext=base64_decode($ivHashCiphertext);
        $password=KEY_AES;
        $method = "AES-256-CBC";
        $iv = substr($ivHashCiphertext, 0, 16);
        $hash = substr($ivHashCiphertext, 16, 32);
        $ciphertext = substr($ivHashCiphertext, 48);
        $key = hash('sha256', $password, true);

        if(!$ciphertext){
            return $codeEncrypt;
        }

        if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
        return rtrim(openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv),"\0");
    }





    /*Obtener direccion ip*/
    public static function getUserIpAddress() {

        if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    public static function CheckDate($dateBlock){
        $dateNow=time();
        $dateCheck=($dateNow-$dateBlock)/60;
        return round($dateCheck);
    }




}



