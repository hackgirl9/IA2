<?php

class Servicio extends BaseModel {

    // Atributos
    private $id_servicio;
    private $nombre_Servicio;
    private $unidad_Medida;
    private $descripcion_servicio;
    private $precio_servicio;
    private $costo_servicio;
    private $table;
    private $table2;

    // Métodos
    public function __construct() {
        parent::__construct();
        $this->table = "servicios";
        $this->table2 = "materiales";
    }

    // Getters & Setters

    public function getIdServicio() {
        return $this->id_servicio;
    }

    public function getNombreServicio() {
        return $this->nombre_servicio;
    }

    public function getUnidadMedida() {
        return $this->unidad_medida;
    }

    public function getDescripcion() {
        return $this->descripcion_servicio;
    }

    public function getPrecio() {
        return $this->precio_servicio;
    }

    public function getCosto() {
        return $this->costo_servicio;
    }

    public function setIdServicio($idServicio) {
        $this->id_servicio = $idServicio;
    }

    public function setNombreServicio($nombreServicio) {
        $this->nombre_Servicio = $nombreServicio;
    }

    public function setUnidadMedida($unidadMedida) {
        $this->unidad_medida = $unidadMedida;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion_servicio = $descripcion;
    }

    public function setCosto($costo) {
        $this->costo_servicio = $costo;
    }

    public function setPrecio($precio) {
        $this->precio_servicio = $precio;
    }

    public function save() {
        $this->registerBitacora(SERVICIOS,REGISTRAR);
        $sql = "INSERT INTO $this->table
        		(nombre_servicio,descripcion_servicio,precio_servicio,costo_servicio,unidad_medida) VALUES (:nombreServicio,:descripcionServicio,:precioServicio,:costoServicio,:unidadMedida)";

        $result = $this->db()->prepare($sql);

        $result->bindParam(':nombreServicio', $this->nombre_Servicio);
        $result->bindParam(':descripcionServicio', $this->descripcion_servicio);
        $result->bindParam(':precioServicio', $this->precio_servicio);
        $result->bindParam(':costoServicio', $this->costo_servicio);
        $result->bindParam(':unidadMedida', $this->unidad_medida);

        $respuesta = $result->execute();


        return $respuesta;
    }

    public function getAll() {
        $this->registerBitacora(SERVICIOS,CONSULTAR);
        $query = $this->db()->query("SELECT * FROM $this->table");

        if ($query && $query->rowCount() != 0) {// Evalua la cansulta 
            $row = $query->fetchAll();
        } else { // 
            $row = NULL;
        }

        return $row;
    }

    public function getOne() {
        $this->registerBitacora(SERVICIOS,DETALLES);
        $query = $this->db()->query("SELECT * FROM $this->table WHERE id_servicio = '$this->id_servicio'");

        if ($query && $query->rowCount() != 0) {// Evalua la cansulta 
            $row = $query->fetchAll();
        } else { // 
            $row = NULL;
        }

        return $row;
    }

    public function update() {
        $this->registerBitacora(SERVICIOS,ACTUALIZAR);
        $sql = "UPDATE $this->table SET nombre_servicio=:nombre_servicio,descripcion_servicio=:descripcion_servicio,precio_servicio=:precio_servicio,costo_servicio= :costo_servicio,unidad_medida=:unidad_medida WHERE id_servicio=:id_servicio";

        $result = $this->db()->prepare($sql);
        $result->bindParam(':nombre_servicio', $this->nombre_Servicio);
        $result->bindParam(':descripcion_servicio', $this->descripcion_servicio);
        $result->bindParam(':precio_servicio', $this->precio_servicio);
        $result->bindParam(':costo_servicio', $this->costo_servicio);
        $result->bindParam(':unidad_medida', $this->unidad_medida);
        $result->bindParam(':id_servicio', $this->id_servicio);

        $update = $result->execute();

        return $update;
    }

    public function delete() {
        $this->registerBitacora(SERVICIOS,ELIMINAR);
        $delete = $this->db()->query("DELETE FROM $this->table WHERE id_servicio = '$this->id_servicio'");

        return $delete;
    }

    public function getMaterial() {
        $materiales = $this->db()->query("SELECT *FROM materiales ");

        if ($materiales->rowCount() >= 1) {
            while ($row = $materiales->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }

    public function verificarServicio() {
       
        $servicio = $this->db()->query("SELECT * FROM servicios where nombre_servicio='$this->nombre_Servicio'");
        
        if ($servicio && $servicio->rowCount() !== 0) {
            $respuesta = true;
        } else {
            $respuesta = false;
        }

        return $respuesta;
    }

    public function saveMaterial($idMateriales, $cantidad) {
        $this->registerBitacora(SERVICIOS,ACTUALIZAR);
        if ($this->id_servicio == 0) {
            $query = $this->db()->query('select id_servicio from servicios order by id_servicio desc');

            if ($query && $query->rowCount() != 0) {// Evalua la cansulta 
                $row = $query->fetchAll();
            } else { // 
                $row = NULL;
            }

            //Registro de servicios y materiales en tabla puente

            $sql1 = "INSERT INTO mat_servicios(id_material,id_servicio,cant_mat_servicio) VALUES (:idMaterial,:idServicio,:cantMaterial)";
            $resultado = $this->db()->prepare($sql1);

            $resultado->bindParam(':idServicio', $row[0]['id_servicio']);
            $resultado->bindParam(':idMaterial', $idMateriales);
            $resultado->bindParam(':cantMaterial', $cantidad);

            $respuesta = $resultado->execute();

            return $respuesta;
        } else {
            $sql1 = "INSERT INTO mat_servicios(id_material,id_servicio,cant_mat_servicio) VALUES (:idMaterial,:idServicio,:cantMaterial)";
            $resultado = $this->db()->prepare($sql1);

            $resultado->bindParam(':idServicio', $this->id_servicio);
            $resultado->bindParam(':idMaterial', $idMateriales);
            $resultado->bindParam(':cantMaterial', $cantidad);

            $respuesta = $resultado->execute();

            return $respuesta;
        }
    }

    public function searchMaterial($search) {
        $query = $this->db()->query("SELECT * FROM materiales where id_material='$search'");

        if ($query && $query->rowCount() != 0) {// Evalua la cansulta 
            $row = $query->fetchAll();
        } else { // 
            $row = NULl;
        }

        return $row;
    }

    public function getMaterialByServi($id) {

        $materialServi = $this->db()->query("SELECT * FROM materiales inner join mat_servicios on mat_servicios.id_material=materiales.id_material where mat_servicios.id_servicio='$id'");

        if ($materialServi->rowCount() >= 1) {
            while ($row = $materialServi->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }

    public function deleteMaterial() {
        $this->registerBitacora(SERVICIOS,ACTUALIZAR);
        $delete = $this->db()->query("DELETE FROM mat_servicios WHERE id_material = '$this->id_servicio'");

        return $delete;
    }

    public function getMaterialIdByServi($idServicio,$idMaterial) {

        $materialServi = $this->db()->query("SELECT * FROM materiales inner join mat_servicios on mat_servicios.id_material=materiales.id_material where mat_servicios.id_servicio='$idServicio' AND mat_servicios.id_material='$idMaterial'");

        if ($materialServi->rowCount() >= 1) {
            while ($row = $materialServi->fetch(PDO::FETCH_OBJ)) {
                $resulSet[] = $row;
            }
        } else {
            $resulSet = null;
        }

        return $resulSet;
    }

    public function updateMatByServi($cant, $idMaterial,$idServicio) {
        $this->registerBitacora(SERVICIOS,ACTUALIZAR);
        $sql = "update mat_servicios set cant_mat_servicio='$cant' where id_material='$idMaterial' and id_servicio='$idServicio'";

        $result = $this->db()->prepare($sql);
        $update = $result->execute();

        return $update;
    }

}

?>