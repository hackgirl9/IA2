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
    <title>Ver Productos - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Producto','index'); ?>" class="breadcrumb">Gestionar Productos</a>
                    <a href="<?php echo Helpers::url('Producto','getAll'); ?>" class="breadcrumb">Consultar Productos</a>
                </div>
                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4 class="center-align">Listado de Productos</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12">
                                <table class="centered highlight" id="productos-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Costo</th>
                                            <th>Precio</th>
                                            <th>Cant. Disp</th>
                                            <?php if (Helpers::hasPermissions('2','5')): ?>
                                            <th>Detalles</th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                    <tbody>
                                    <?php if($allProductos != null): ?>
                                        <?php foreach($allProductos as $producto): ?>
                                        <tr>
                                            <td><?php echo $producto->codigo_producto; ?></td>
                                            <td><?php echo Helpers::aesDecrypt($producto->nombre_producto); ?></td>
                                            <td><?php echo Helpers::aesDecrypt($producto->descripcion_producto); ?></td>
                                            <td><?php echo $producto->costo_producto; ?>$</td>
                                            <td><?php echo $producto->precio_producto; ?>$</td>
                                            <td><?php echo $producto->stock_max_producto; ?></td>
                                            <?php if (Helpers::hasPermissions('2','5')): ?>
                                                <td><a href="<?php echo Helpers::url('Producto','details'); ?>/<?php echo $producto->codigo_producto; ?>" class="btn btn-floating pink-gradient waves-effect effect-light"><i class="icon-find_in_page"></i></a></td>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Producto.js"></script>
</body>
</html>