<?php

class RolesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view('Seguridad/Roles');
    }

    public function create()
    {
        $rol = new Rol();
        $permisos = $rol->getPermisos();
        $modulos = $rol->getModule();
        $this->view('Roles/Roles.Registrar', ['permisos' => $permisos, 'modulos' => $modulos]);

    }

    public function getAll()
    {    $rol = new Rol();
        $roles=$rol->getAll();
        $this->view('Roles/Roles.Consultar', ['roles'=>$roles]);
    }

    public function register()
    {
        // var_export($_POST);
        $rol = new Rol();
        $nombre_rol = $_POST['nombre_rol'];
        $descripcion_rol = $_POST['descripcion_rol'];

        $rol->setNombreRol($nombre_rol);
        $rol->setDescripcionRol($descripcion_rol);
        $rol->save();

        $rol_insert = $rol->getByIdLast();


        $modules = $_POST['modules'];
        $permisos = $_POST["permisos"];

        for ($i = 0; $i < count($modules); $i++) {
            for ($j = 0; $j < count($permisos[$modules[$i]]); $j++) {


                $rol->saveRolPermisoModule($rol_insert->id_rol,$modules[$i],$permisos[$modules[$i]][$j]);

                //echo "Modulo:" . $modules[$i] . "<br>";
                //echo "Permisos:" . $permisos[$modules[$i]][$j] . "<br>";
            }
        }

        return $this->redirect('Roles','getAll');
    }

    public function update(){
        $rol = new Rol();
        $id_rol = $_POST['id_rol'];
        $nombre_rol = $_POST['nombre_rol'];
        $descripcion_rol = $_POST['descripcion_rol'];
        $rol->update();
        $modules = $_POST['modules'];
        $permisos = $_POST["permisos"];
        $rol->setIdRol($id_rol);
        $rol_db = $rol->getBy();
        foreach ($modules as $module) {
            foreach ($permisos[$module] as $array => $permiso) {
                $rol->deleteRolPermisoModule($id_rol,$module,$permiso);
            }
        }
        foreach ($modules as $module) {
            foreach ($permisos[$module] as $array => $permiso) {
                $rol->saveRolPermisoModule($id_rol,$module,$permiso);
            }
        }
        $rol->registerBitacora(ROLES_PERMISOS,ACTUALIZAR);
        return $this->redirect('Roles','getAll');
    }

    public function delete()
    {

    }

    public function getBy(){
        $id=$_GET['id'];
        $rol = new Rol();
        $rol->setIdRol($id);
        $rol_find=$rol->getBy();
        $modules_find=$rol->getByModule();
        $permisos_find=$rol->getByPermisos();
        $modulos=$rol->getModule();
        $permisos=$rol->getPermisos();


        $this->view('Roles/Roles.Detalles', [
            'rol_find' => $rol_find,
            'module_find' => $modules_find,
            'permisos_find'=>$permisos_find,
            'modulos'=>$modulos,
            'permisos'=>$permisos,
        ]);
    }
}
