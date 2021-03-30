<?php

class Cliente extends BaseModel{
    // Atributos
    public $cedulaCliente;
    public $tipoDocumentoCliente;
    public $nombreCliente;
    public $descripcionCliente;
    public $telefonoCliente;
    public $representanteCliente;
    public $direccionCliente;


    public function __construct(){
        parent::__construct();
    }

    public function getDireccionCliente(){
        return $this->direccionCliente;
    }

    public function getCedulaCliente(){
        return $this->cedulaCliente;
    }

    public function getTipoDocumentoCliente(){
        return $this->tipoDocumentoCliente;
    }

    public function getNombreCliente(){
        return $this->nombreCliente;
    }

    public function getDescripcionCliente(){
        return $this->descripcionCliente;
    }

    public function getTelefonoCliente(){
        return $this->telefonoCliente;
    }

    public function getRepresentanteCliente(){
        return $this->representanteCliente;
    }

    public function setNombreCliente($nombreCliente){
        $this->nombreCliente = Helpers::aesEncrypt($nombreCliente);
    }

    public function setCedulaCliente($cedulaCliente){
        $this->cedulaCliente = $cedulaCliente;
    }


    public function setTipoDocumentoCliente($tipoDocumentoCliente){
        $this->tipoDocumentoCliente = $tipoDocumentoCliente;
    }

    public function setDescripcionCliente($descripcionCliente){
        $this->descripcionCliente = $descripcionCliente;
    }

    public function setTelefonoCliente($telefonoCliente){
        $this->telefonoCliente =Helpers::aesEncrypt($telefonoCliente);
    }

    public function setRepresentanteCliente($representanteCliente){
        $this->representanteCliente = $representanteCliente;
    }

    public function setDireccionCliente($direccionCliente){
        $this->direccionCliente =Helpers::aesEncrypt( $direccionCliente);
    }

    public function getAll(){
        $this->registerBitacora(CLIENTES,CONSULTAR);
        $query=$this->db()->query("SELECT * FROM clientes ORDER BY cedula_cliente ASC");
        if($query){
            if($query->rowCount() != 0) {
                while($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $resultset[] = $row;
                }
            }
            else{
                $resultset = null;
            }
        }
        return $resultset;
    }


    public function save(){

        try {
            $this->db()->beginTransaction();
           $this->registerBitacora(CLIENTES,REGISTRAR);
            $sql =   "INSERT INTO clientes 
                      (cedula_cliente, tipo_documento_cliente, nombre_cliente, descripcion_cliente,
                      direccion_cliente, telefono_cliente, representante_cliente) 
                      VALUES (:cedulaCliente,:tipoCliente,:nombreCliente,:descripcionCliente,:direccionCliente,
                      :telefonoCliente,:representanteCliente)";


            $result = $this->db()->prepare($sql);
            $save = $result->execute(array(":cedulaCliente" => $this->cedulaCliente,
                ":tipoCliente" => $this->tipoDocumentoCliente,
                ":nombreCliente" => $this->nombreCliente,
                ":descripcionCliente" => $this->descripcionCliente,
                ":direccionCliente" => $this->direccionCliente,
                ":telefonoCliente" => $this->telefonoCliente,
                ":representanteCliente" => $this->representanteCliente));
                $this->db()->commit();
            return $save;
        }catch (Exception $e) {
            $this->db()->rollBack();
            return false;
        }

    }

    public function getBy(){
        $this->registerBitacora(CLIENTES,DETALLES);
        $sql="SELECT * FROM clientes WHERE cedula_cliente='$this->cedulaCliente'";
        $row=$this->db()->query($sql);
        if($row = $row->fetch(PDO::FETCH_OBJ)){
            $register = $row;
        }
        return $register;
    }

    public function checkCedula(){
        $this->registerBitacora(CLIENTES,VERIFICAR);

        $sql="SELECT * FROM clientes WHERE cedula_cliente='$this->cedulaCliente'";
        $query=$this->db()->query($sql);
        if($query->rowCount()>=1){
            return true;
        }else{
            return false;
        }


    }


    public function update(){

        try{
            $this->db()->beginTransaction();
            $this->registerBitacora(CLIENTES,ACTUALIZAR);
            $sql="UPDATE clientes SET cedula_cliente=:cedula_cliente,nombre_cliente=:nombre_cliente,
              tipo_documento_cliente=:tipo_documento,descripcion_cliente=:descripcion_cliente,
              direccion_cliente=:direccion_cliente,telefono_cliente=:telefono_cliente, 
              representante_cliente=:representante_cliente WHERE cedula_cliente=:cedula";
            $query=$this->db()->prepare($sql);
            $query->bindValue(":cedula_cliente",$this->cedulaCliente);
            $query->bindValue(":cedula",$this->cedulaCliente);
            $query->bindValue(":nombre_cliente",$this->nombreCliente);
            $query->bindValue(":tipo_documento",$this->tipoDocumentoCliente);
            $query->bindValue(":descripcion_cliente",$this->descripcionCliente);
            $query->bindValue(":direccion_cliente",$this->direccionCliente);
            $query->bindValue(":telefono_cliente",$this->telefonoCliente);
            $query->bindValue(":representante_cliente",$this->representanteCliente);
            $update=$query->execute();
            $this->db()->commit();
            return $update;
        }catch (Exception $e) {
            $this->db()->rollBack();
            return false;
        }

    }


    public function delete(){
        $this->registerBitacora(CLIENTES,ELIMINAR);
        $sql="DELETE FROM clientes WHERE cedula_cliente='$this->cedulaCliente'";
        $register=$this->db()->query($sql);
        if($register){
            return true;
        }else{
            return false;
        }


    }


}
