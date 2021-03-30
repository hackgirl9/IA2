<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-gradient.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/icons/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owner.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Registrar Rol - Inversiones A2</title>
</head>
<body class="grey lighten-4">
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="<?php echo Helpers::url('Home', 'index'); ?>" class="breadcrumb">Inicio</a>
                    <a href="<?php echo Helpers::url('Seguridad', 'index'); ?>" class="breadcrumb">Seguridad</a>
                    <a href="<?php echo Helpers::url('Seguridad', 'roles'); ?>" class="breadcrumb">Gestionar Roles y Permisos</a>
                    <a href="<?php echo Helpers::url('Seguridad', 'create'); ?>" class="breadcrumb">Registrar Rol</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form action="<?php echo Helpers::url('Roles', 'register'); ?>" method="post" class="card">
                <div class="card-header center-align">
                    <h5>Registrar Rol</h5>
                </div>
                <div class="card-content row">
                    <div class="input-field col s12 m6">
                        <i class="icon-assignment prefix"></i>
                        <input type="text" name="nombre_rol" id="nombre_rol" class="validate"   required>
                        <label for="nombre_rol">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-directions prefix"></i>
                        <textarea name="descripcion_rol" id="descripcion_rol" cols="30" rows="10" class="materialize-textarea" required></textarea>
                        <label for="descripcion_rol">Descripción</label>
                    </div>
                    <table class="striped centered">
                        <thead>
                            <tr>
                                <th>Módulo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modulos as $modulo):?>
                            <tr>
                                <td>
                                    <p>
                                        <label>
                                            <input type="checkbox" id="" name="modules[]" value="<?php echo $modulo->id_modulo;?>"/>
                                            <span> <?php  echo $modulo->nombre_modulo;?></span>
                                        </label>
                                    </p>
                                </td>
                                <td>
                                    <div class="input-field col s12 m6 left-align">
                                    <?php foreach ($permisos as $permiso):?>
                                        <p class="<?php if(($modulo->nombre_modulo == 'ESTADISTICAS' && $permiso->nombre_permiso != 'CONSULTAR') || ($modulo->nombre_modulo == 'REPORTES' && $permiso->nombre_permiso != 'REPORTES') || ($modulo->nombre_modulo == 'SEGURIDAD' && $permiso->nombre_permiso != 'CONFIGURACIÓN') || ($modulo->nombre_modulo == 'MANTENIMIENTO' && $permiso->nombre_permiso != 'CONFIGURACIÓN') || ($modulo->nombre_modulo == 'FACTURAS' && $permiso->nombre_permiso != 'CONSULTAR')){ echo 'hide'; } elseif(($modulo->nombre_modulo == 'USUARIOS' || $modulo->nombre_modulo == 'PRODUCTOS' || 
                                             $modulo->nombre_modulo == 'CLIENTES' || $modulo->nombre_modulo == 'PEDIDOS' || 
                                             $modulo->nombre_modulo == 'SERVICIOS' || $modulo->nombre_modulo == 'FACTURAS' || 
                                             $modulo->nombre_modulo == 'TELAS' || $modulo->nombre_modulo == 'MATERIALES') &&
                                            ($permiso->nombre_permiso == 'CONFIGURACIÓN' || $permiso->nombre_permiso == 'REPORTES')) { echo 'hide'; } ?>">
                                            <label>
                                                <input type="checkbox" id="" name="permisos[<?php echo $modulo->id_modulo;?>][]" value=" <?php  echo $permiso->id_permiso;?>" />
                                                <span> <?php  echo $permiso->nombre_permiso;?></span>
                                            </label>
                                        </p>
                                    <?php endforeach;?>
                                    </div>

                                </td>
                            </tr>
                            <?php endforeach;?>

                        </tbody>
                    </table>
                    <div class="input-field col s12 center-align">
                        
                    </div>
                </div>
                <div class="card-footer center-align">
                    <button type="submit" class="btn btn-large btn-rounded green-gradient waves-effect waves-light">
                        <i class="icon-send left"></i>
                        Registrar
                        <i class="icon-send right"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>


    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>

</body>
</html>