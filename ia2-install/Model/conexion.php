<?php
class Conexion{
    private $driver = "pgsql";
    private $host = "localhost";
    private $user = "postgres";
    private $password = "1234";
    private $dbname = "ia2";
    protected $dbConexion;

    public function __construct(){

        try {
            $this->dbConexion = new PDO("$this->driver:host=$this->host;dbname=" . $this->dbname, $this->user, $this->password);
            $this->dbConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage() . "<br>";
            echo "Linea:" . $e->getLine() . "<br>";

        }

        return $this->dbConexion;

    }




}

?>
