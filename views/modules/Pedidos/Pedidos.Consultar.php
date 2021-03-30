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
    <title>Consultar Pedidos - Inversiones A2</title>
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
                <a href="<?php echo Helpers::url('Pedido','index'); ?>" class="breadcrumb">Gestionar Pedidos</a>
                <a href="<?php echo Helpers::url('Pedido','getAll'); ?>" class="breadcrumb">Consultar Pedidos</a>
            </div>

            <div class="col s12">
                <div class="card">
                    <div class="card-header center-align">
                        <h4>Listado de Pedidos</h4>
                    </div>
                    <div class="card-content row">
                        <div class="col s12" style="padding:30px">
                            <table class="centered striped" id="pedidos" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Fecha del Pedido</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Detalles</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($pedidos != null): ?>
                                    <?php foreach ($pedidos as $pedido):?>
                                        <tr>
                                            <td><?php echo $pedido->codigo_pedido;?></td>
                                            <td><?php echo Helpers::aesDecrypt($pedido->nombre_cliente)?></td>
                                            <td><?php echo Helpers::aesDecrypt($pedido->status_pedido);?></td>
                                            <td><?php echo $pedido->fecha_pedido;?></td>
                                            <td><?php echo $pedido->fecha_entrega_pedido;?></td>
                                            <td><a href="<?php echo Helpers::url('Pedido','details')."/".$pedido->codigo_pedido; ?>" class="btn btn-floating btn-small pink waves-effect waves-light"><i class="icon-pageview"></i></a></td>
                                        </tr>
                                    <?php endforeach;?>
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
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Pedido.js"></script>
</body>
</html>
