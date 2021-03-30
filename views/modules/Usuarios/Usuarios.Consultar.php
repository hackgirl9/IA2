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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/datatables.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Consultar Usuarios - Inversiones A2</title>
</head>
<body class="grey lighten-4">
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="<?php echo Helpers::url('Home','index'); ?>" class="breadcrumb">Inicio</a>
                    <a href="<?php echo Helpers::url('Usuario','index'); ?>" class="breadcrumb">Gestionar Usuarios</a>
                    <a href="<?php echo Helpers::url('Usuario','getAll'); ?>" class="breadcrumb">Consultar Usuarios</a>
                </div>
                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Consultar Usuarios</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12">
                                <table class="centered highlight" style="width: 100%" id="usuarios-table">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>E-mail</th>
                                            <th>Rol</th>
                                            <?php if (Helpers::hasPermissions('1','5')): ?>
                                            <th>Detalles</th>
                                            <?php endif; ?>
                                            <!-- <th></th>
                                            <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($allUsuarios != null): ?>
                                        <?php foreach($allUsuarios as $usuario): ?>
                                        <tr>
                                            <td><?php echo $usuario->nick_usuario; ?></td>
                                            <td><?php echo $usuario->nombre_usuario . " " . $usuario->apellido_usuario; ?></td>
                                            <td><?php echo $usuario->email_usuario; ?></td>
                                            <td><?php echo $usuario->nombre_rol; ?></td>
                                            <?php if (Helpers::hasPermissions('1','5')): ?>
                                            <td><a href="<?php echo Helpers::url('Usuario','details'); ?>/<?php echo $usuario->nick_usuario; ?>" class="btn btn-floating pink-gradient waves-effect waves-light"><i class="icon-pageview"></i></a></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Usuario.js"></script>
</body>
</html>