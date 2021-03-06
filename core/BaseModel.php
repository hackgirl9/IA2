<?php

class BaseModel{
    private $database;
    private $connect;


    public function __construct(){
        require_once ('Connect.php');
        $this->connect=new Connect();// Intancia del objeto Conexion.
        $this->database=$this->connect->connection();
    }

    public function getConnect(){ // Retorna la conexion con la base de datos.
        return $this->connect;
    }

    public function db(){// Retorna la base de datos.
        return $this->database;
    }
    public function getAll(){//para consultar todos lo registros de una tabla

    }

    public function getBy(){//para consultar un registro por un determinado campo

    }

    public function save(){//para insertar o guardar un registro de la tabla

    }
    public function update(){//para actualizar un registro de la tabla

    }
    public function delete(){//para eliminar un registro de la tabla

    }

    /*funcion que registrar en bitacora, la idea seria enviar solo modulo y accion,
     pero necesiton que login este listo para detectar si los cambios fueron realizados
    */
    public function registerBitacora($module=null,$action=null,$nickUsuario=null){

        $insert = false;
        $nickUser=$nickUsuario!==null?$nickUsuario:$_SESSION['nick_usuario'];
        if($module!==null&&$action!==null){

            date_default_timezone_set('America/Caracas');//zona horaria
            $fecha_actual =date('d/m/Y');//hora actual
            $hora_actual =date('G:i:s');//fecha actual
            $module=strtoupper($module);
            $action=strtoupper($action);
            $ip_address=$this->getUserIpAddress();
            //   var_export($_SESSION); die();

            $sql="INSERT INTO 
              bitacoras(nick_usuario,fecha_actu_bitacora,hora_actu_bitacora,modulo_bitacora,accion_bitacora,ip_address)
              VALUES ('$nickUser','$fecha_actual','$hora_actual','$module','$action','$ip_address')";
            $query= $this->db()->query($sql);
            if($query){
                $insert=true;
            }
            return $insert;
        }else{
            echo "DEBE ESPECIFICAR LOS PARAMETROS MODULE Y ACTION";
            die();
        }

    }



    /*Obtener direccion ip*/
    function getUserIpAddress() {

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




}
