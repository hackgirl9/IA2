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
    <title>Seguridad - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Seguridad','index'); ?>" class="breadcrumb">Seguridad</a>
                </div>
                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Seguridad','bitacora'); ?>" class="btn-app green-gradient">
                        <i class="icon-format_list_bulleted"></i>
                        <span>Bitacora</span>
                    </a>
                </div>
                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Seguridad','roles'); ?>" class="btn-app red-gradient">
                        <i class="icon-supervisor_account"></i>
                        <span>Gestionar Roles y Permisos</span>
                    </a>
                </div>
                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Modulo','getAll'); ?>" class="btn-app indigo-gradient">
                        <i class="icon-apps"></i>
                        <span>Mostrar Módulos</span>
                    </a>
                </div>



                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Auditoria','index'); ?>" class="btn-app pink-gradient">
                        <i class="icon-apps"></i>
                        <span>Auditoria</span>
                    </a>
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