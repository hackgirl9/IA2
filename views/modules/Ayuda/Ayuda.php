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
    <title>Ayuda - Inversiones A2</title>
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
                <a href="<?php echo Helpers::url('Ayuda','index'); ?>" class="breadcrumb">Ayuda</a>
            </div>

                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Ayuda','user'); ?>" class="btn-app green-gradient">
                        <i class="icon-local_laundry_service"></i>
                        <span>Manual de Usuario</span>
                    </a>
                </div>

                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Ayuda','installed'); ?>" class="btn-app blue-gradient">
                        <i class="icon-library_books"></i>
                        <span>Manual de Instalación</span>
                    </a>
                </div>

                <div class="col s12 m6 animated bounceIn">
                    <a href="<?php echo Helpers::url('Ayuda','system'); ?>" class="btn-app red-gradient">
                        <i class="icon-personal_video"></i>
                        <span>Manual del Sistema</span>
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