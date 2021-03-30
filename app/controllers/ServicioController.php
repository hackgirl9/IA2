<?php

class ServicioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view('Servicios/Servicios');
    }

    public function create() {
        $materiales = new Servicio();
        $valor = $materiales->getMaterial();

        $this->view('Servicios/Servicios.Registrar', array(
            'materiales' => $valor
        ));
    }

    public function getAll() {
        $Servicio = new Servicio();
        $result = $Servicio->getAll();
        $this->view('Servicios/Servicios.Consultar', array("servicios" => $result));
    }

    public function save() {

        $nombreServicio = ucwords($_POST['nombre_servicio']);
        $unidadMedida = strtoupper($_POST['unidad_medida']);
        $precio = $_POST['precio_servicio'];
        $costo = $_POST['costo_servicio'];
        $descripcion = ucwords($_POST['descripcion_servicio']);

        $Servicio = new Servicio();

        $Servicio->setNombreServicio($nombreServicio);
        $Servicio->setUnidadMedida($unidadMedida);
        $Servicio->setPrecio($precio);
        $Servicio->setCosto($costo);
        $Servicio->setDescripcion($descripcion);

        $result = $Servicio->save();

        $this->sendAjax($result);
    }

    public function delete() {
        $idServicio = $_POST['id_servicio'];

        $Servicios = new Servicio();
        $Servicios->setIdServicio($idServicio);

        $result = $Servicios->delete();

        $this->sendAjax($result);
    }

    public function details() {

        $idServicio = $_GET['id'];

        $Servicios = new Servicio();
        $Servicios->setIdServicio($idServicio);

        $material = new Servicio();
        $materiales = $material->getMaterialByServi($idServicio);

        $result = $Servicios->getOne();
        $mateCount = count($result);

        $this->view('Servicios/Servicios.Detalles', array(
            'detalles' => $result,
            'materiales' => $materiales
        ));
    }

    public function update() {

        $idServicio = $_POST['id_servicio'];
        $nombreServicio = $_POST['nombre_servicio'];
        $unidadMedida = $_POST['unidad_medida'];
        $precio = $_POST['precio_servicio'];
        $costo = $_POST['costo_servicio'];
        $descripcion = $_POST['descripcion_servicio'];

        $Servicios = new Servicio();
        $Servicios->setIdServicio($idServicio);
        $Servicios->setNombreServicio($nombreServicio);
        $Servicios->setUnidadMedida($unidadMedida);
        $Servicios->setPrecio($precio);
        $Servicios->setCosto($costo);
        $Servicios->setDescripcion($descripcion);

        $result = $Servicios->update();

        $this->sendAjax($result);
    }

    public function getMateriales() {
        $materiales = new Servicio();
        $valor = $materiales->getMaterial();
        if (!empty($_GET['id'])) {
            $_SESSION['servicio']=$_GET['id'];
            $this->view('Servicios/Servicios.addMateriales', array(
                'materiales' => $valor
            ));
        } else {
            $_SESSION['servicio']=0;
            $this->view('Servicios/Servicios.addMateriales', array(
                'materiales' => $valor
            ));
        }
    }

    public function verificarServicio() {
        if ($_POST['nombre_servicio']) {
            $nombre = $_POST['nombre_servicio'];
        } else {

            $nombre = '';
        }

        $servicio = new Servicio();
        $servicio->setNombreServicio($nombre);
        $respuesta = $servicio->verificarServicio();

        $this->sendAjax($respuesta);
    }

    public function searchMateriales() {
        $idMaterial = $_GET['id'];
            $materiales = new Servicio();
            $respuesta = $materiales->searchMaterial($idMaterial);

            $this->view('Servicios/Servicios.addMateriales.Servicio', array(
                'materiales' => $respuesta
            ));
    }

    public function saveMaterial() {
        $idMaterial = $_POST['id'];
        $cantidad = $_POST['cantidad'];
        $idServicio = $_SESSION['servicio'];

        if ($idServicio == 0) {
            $Servicio = new Servicio();

            $Servicio->setIdServicio($idServicio);
            $result = $Servicio->saveMaterial($idMaterial, $cantidad);

            $this->sendAjax($result);
        } else {
            $Servicio = new Servicio();

            $Servicio->setIdServicio($idServicio);
            $result = $Servicio->saveMaterial($idMaterial, $cantidad);

            $this->sendAjax($result);
        }
    }

    public function deleteMaterial()
    {
        $id=$_GET['id'];

        $servicio= new Servicio();
        $servicio->setIdServicio($id);
        $respuesta=$servicio->deleteMaterial();

        $this->redirect('Servicio','getAll');
    }



}
