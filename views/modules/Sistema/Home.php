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

    <title>Inicio - Inversiones A2</title>
</head>
<body class="grey lighten-4">
<!-- Header -->
<?php require_once "views/layouts/header.php" ?>

<!-- Main Container -->
<main>
    <div class="container-fluid">
        <!-- Enlaces rapidos -->
        <div class="row">
            <div class="col s12 breadcrumb-nav left-align">
                <a href="#!" class="breadcrumb">Inicio</a>
            </div>
            <?php if (Helpers::hasPermissions('2')): ?>

                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Producto', 'index'); ?>" class="btn-app green-gradient">
                        <i class="icon-loyalty"></i>
                        <span class="truncate">Gestionar Producto</span>
                    </a>
                </div>

            <?php endif; ?>




<!--                <div class="col s12 m3 animated bounceIn">-->
<!--                    <a href="--><?php //echo Helpers::url('Test', 'test'); ?><!--" class="btn-app purple-gradient">-->
<!--                        <i class="icon-contact_phone"></i>-->
<!--                        <span class="truncate">Test</span>-->
<!--                    </a>-->
<!--                </div>-->






            <?php if (Helpers::hasPermissions('4')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Cliente', 'index'); ?>" class="btn-app purple-gradient">
                        <i class="icon-contact_phone"></i>
                        <span class="truncate">Gestionar Clientes</span>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (Helpers::hasPermissions('3')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Pedido', 'index'); ?>" class="btn-app teal-gradient">
                        <i class="icon-library_books"></i>
                        <span class="truncate">Gestionar Pedidos</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (Helpers::hasPermissions('6')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Factura', 'index'); ?>" class="btn-app red-gradient">
                        <i class="icon-event_available"></i>
                        <span class="truncate">Facturación de Ventas</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (Helpers::hasPermissions('5') || Helpers::hasPermissions('8') || Helpers::hasPermissions('9')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Configuracion', 'index'); ?>" class="btn-app yellow-gradient">
                        <i class="icon-build"></i>
                        <span class="truncate">Configuración</span>
                    </a>
                </div>
            <?php endif ?>
            <?php if (Helpers::hasPermissions('7')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Reporte', 'reporteIndex'); ?>" class="btn-app cyan-gradient">
                        <i class="icon-report"></i>
                        <span class="truncate">Reportes</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php if (Helpers::hasPermissions('1')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Usuario', 'index'); ?>" class="btn-app blue-gradient">
                        <i class="icon-group_add"></i>
                        <span class="truncate">Gestionar Usuarios</span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (Helpers::hasPermissions('11')): ?>
                <div class="col s12 m3 animated bounceIn">
                    <a href="<?php echo Helpers::url('Seguridad', 'index'); ?>" class="btn-app indigo-gradient">
                        <i class="icon-security"></i>
                        <span class="truncate">Seguridad</span>
                    </a>
                </div>
            <?php endif; ?>
<!--            --><?php //if (Helpers::hasPermissions('12')): ?>
<!--                <div class="col s12 m3 animated bounceIn">-->
<!--                    <a href="--><?php //echo Helpers::url('Mantenimiento', 'index'); ?><!--" class="btn-app orange-gradient">-->
<!--                        <i class="icon-perm_data_setting"></i>-->
<!--                        <span class="truncate">Mantenimiento</span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            --><?php //endif; ?>
        </div>
    </div>
</main>

<!-- Footer -->
<?php require_once "views/layouts/footer.php"; ?>

<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/Chart.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/bootstrap-notify.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/jquery.countTo.js"></script>
</body>
</html>
