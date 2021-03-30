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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/datatables.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Consultar Facturas - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Factura','FactuIndex'); ?>" class="breadcrumb">Facturación de Pedidos</a>
                </div>

                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Pedidos Realizados</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12">
                                <table class="stripe highlight" style="width: 100%" id="facturaPedidos">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Fecha de Factura</th>
                                        <th>Fecha de Entrega</th>
                                        <th>Dolares</th>
                                        <th>Bolivares</th>
                                    </tr>
                                    </thead>

                                    <?php if($allFactura != null): ?>
                                    <tbody>
                                    <?php foreach ($allFactura as $factura): ?>
                                        <tr>
                                            <td><?php echo $factura->codigo_factura?></td>
                                            <td><?php echo Helpers::aesDecrypt($factura->nombre_cliente)?></td>
                                            <td><?php echo Helpers::aesDecrypt($factura->status_pedido)?></td>
                                            <td><?php echo $factura->fecha_factura?></td>
                                            <td><?php echo $factura->fecha_entrega_pedido?></td>
                                            <td><a href="<?php echo Helpers::url('Reporte','facturaById')."/".$factura->codigo_factura?>" class="btn btn-floating green waves-effect waves-light"><i class="icon-monetization_on"></i></a></td>
                                            <td>
                                                <a href="<?php echo Helpers::url('Reporte','setDolar')."/".$factura->codigo_factura?>" class="btn btn-floating amber waves-effect waves-light"><i class="icon-money_off"></i></a></td>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Pedido.js"></script>
</body>
</html>
