<?php
class Auditoria extends BaseModel {

    // Atributos de la clase
    private $table;

    // Métodos de la clase
    public function __construct() {
        parent::__construct(); //colocar valor al atributo table
        require_once ('config/actions.php');
        require_once ('config/modules.php');
//        $this->table="materiales";
    }


    public function getAll(){

        $query = $this->db()->query("SELECT * FROM pg_catalog.pg_tables WHERE schemaname = 'pgaudit'");

        if($query->rowCount()>=1){

            while($row = $query->fetch(PDO::FETCH_OBJ)){
                if($row->tablename !== 'config'){
                    $queryAll [] = $row;
                }
            }

        }else{
            $queryAll = null;
        }

//        var_dump($queryAll);
//        die();
        return $queryAll;
    }

    public function getByTable ($name){
        $query = $this->db()->query("SELECT * FROM pgaudit.public$$name");

        if($query->rowCount()>=1){

            while($row = $query->fetch(PDO::FETCH_OBJ)){
                    $queryAll [] = $row;
            }

        }else{
            $queryAll = null;
        }

        return $queryAll;
    }

}
