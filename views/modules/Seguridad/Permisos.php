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
    <title> - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Permiso', 'getAll'); ?>" class="breadcrumb">Ver Permisos</a>
                </div>
                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Listado de Permisos</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12">
                                <?php if($allPermisos == null): ?>
                                    <h5 class="center-align">No hay registros para mostrar.</h5>
                                <?php else: ?>
                                <table class="centered highlight">
                                    <thead>
                                        <tr>
                                            <th>Permiso</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allPermisos as $permiso): ?>
                                        <tr>
                                            <td><?php echo $permiso->nombre_permiso ?></td>
                                            <td><?php echo $permiso->descripcion_permiso ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>


    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
</body>
</html>