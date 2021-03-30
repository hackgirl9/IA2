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
    <title>Reportes - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Factura','reportesIndex'); ?>" class="breadcrumb">Reportes</a>
                </div>
                <div class="col s12 m4 animated bounceIn">
                    <a href="<?php echo Helpers::url('Reporte','getAllPedido'); ?>" class="btn-app pink-gradient">
                        <i class="icon-assignment"></i>
                        <span>Reporte de Pedidos</span>
                    </a>
                </div>
                <div class="col s12 m4 animated bounceIn">
                    <a href="<?php echo Helpers::url('Reporte','getAllEntrega'); ?>" class="btn-app blue-gradient">
                        <i class="icon-assignment"></i>
                        <span>Reporte de Entregas</span>
                    </a>
                </div>
                <div class="col s12 m4 animated bounceIn">
                    <a href="<?php echo Helpers::url('Reporte','getAllProducto'); ?>" class="btn-app green-gradient">
                        <i class="icon-style"></i>
                        <span>Reporte de Productos</span>
                    </a>
                </div>
                <div class="col s12 m4 animated bounceIn">
                    <a href="<?php echo Helpers::url('Reporte','FactuIndex'); ?>" class="btn-app red-gradient">
                        <i class="icon-receipt"></i>
                        <span>Reporte de Facturas</span>
                    </a>
                </div>
                <div class="col s12 m4 animated bounceIn">
                    <a href="<?php echo Helpers::url('Home','dashboard'); ?>" class="btn-app orange-gradient">
                        <i class="icon-multiline_chart"></i>
                        <span>Visualizar Estadistica</span>
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