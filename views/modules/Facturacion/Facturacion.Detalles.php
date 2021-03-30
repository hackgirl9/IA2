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
        <title>Detalles - Inversiones A2</title>
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
                        <a href="<?php echo Helpers::url('Factura', 'index'); ?>" class="breadcrumb">Facturación de Ventas</a>
                        <a href="<?php echo Helpers::url('Factura', 'getAll'); ?>" class="breadcrumb">Consultar Facturas</a>
                        <a href="<?php echo Helpers::url('Factura', 'details'); ?>" class="breadcrumb">Detalles Factura</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5 class="center-align">Detalles de Factura</h5>
                    </div>
                    <div class="card-content">
                    <form action="" class="row">
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-attach_money prefix"></i>
                        <input type="text" name="codigo_factura" id="codigo_factura" value="<?php echo $detalles['Factura']->codigo_factura ?>" disabled>
                        <label for="codigo_factura">Codigo de Factura</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-stars prefix"></i>
                        <input type="text" name="codigo_pedido" id="codigo_pedido" value="<?php echo $detalles['Factura']->codigo_pedido ?>" disabled>
                        <label for="codigo_pedido">Codigo de Pedido</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-attach_money prefix"></i>
                        <input type="text" name="fecha_factura" id="fecha_factura" value="<?php echo $detalles['Factura']->fecha_factura ?>" disabled>
                        <label for="fecha_factura">Fecha de Factura</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="modo_pago_factura" id="modo_pago_factura" value="<?php echo $detalles['Factura']->modo_pago_factura ?>" disabled>
                        <label for="modo_pago_factura">Modalidad de Pago</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="cliente" id="modo_pago_factura" value="<?php echo Helpers::aesDecrypt($detalles['Cliente']->nombre_cliente) ?>" disabled>
                        <label for="modo_pago_factura">Cliente</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="modo_pago_factura" id="cedula" value="<?php echo $detalles['Cliente']->tipo_documento_cliente ?>-<?php echo $detalles['Cliente']->cedula_cliente ?>   " disabled>
                        <label for="modo_pago_factura">Cedula</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="modo_pago_factura" id="cedula" value="<?php echo Helpers::aesDecrypt($detalles['Cliente']->telefono_cliente) ?>" disabled>
                        <label for="modo_pago_factura">Telefono</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="modo_pago_factura" id="cedula" value="<?php echo Helpers::aesDecrypt($detalles['Cliente']->direccion_cliente) ?>" disabled>
                        <label for="modo_pago_factura">Direccion</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-open_with prefix"></i>
                        <input type="text" name="porcentaje_venta_factura" id="porcentaje_venta_factura" value="<?php echo $detalles['Factura']->porcentaje_venta_factura ?>" disabled>
                        <label for="porcentaje_venta_factura">Porcentaje de Venta</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-open_with prefix"></i>
                        <input type="text" name="status_factura" id="status_factura" value="<?php echo $status ?>" disabled>
                        <label for="status_factura">Estado de Venta</label>
                    </div>
                    <?php
                    $montoServicio = 0;
                    if ($detalles['ServiPedido'] !== 0):
                        ?>
                        <?php for ($i = 0; $i < $detalles['RowServiPedido']; $i++): ?>

                            <div class="input-field col s12 m6 xl6">
                                <i class="icon-open_with prefix"></i>
                                <input type="text" name="status_factura" id="servicio" value="<?php echo $detalles['Servicio'][$i]->nombre_servicio ?>" disabled>
                                <label for="servicio">Servicio</label>
                            </div>
                            <?php
                            if ($detalles['ServiPedido'][$i]->cantidad_medida !== 0) {

                                $monto1 = $detalles['Servicio'][$i]->precio_servicio * $detalles['ServiPedido'][$i]->cantidad_prenda * $detalles['ServiPedido'][$i]->cantidad_medida;

                                $montoServicio += $monto1;
                            } else {
                                $monto1 = $detalles['Servicio'][$i]->precio_servicio * $detalles['ServiPedido'][$i]->cantidad_prenda;

                                $montoServicio += $monto1;
                            }
                            ?>


                        <?php endfor; ?>
                        <div class="input-field col s12 m6 xl6">
                            <i class="icon-open_with prefix"></i>
                            <input type="text" name="total" id="total" value="<?php echo $montoServicio ?> $" disabled>
                            <label for="total">Total a Pagar Por Servicio:</label>
                        </div>
                    <?php else: ?>


                    <?php endif; ?>

                    <?php $montoProducto = 0;?>
                    <?php if ($detalles['ProPedidos'] !== 0): ?>

                        <?php for ($i = 0; $i < $detalles['RowProPedido']; $i++):?>

                            <div class="input-field col s12 m4 xl4">
                                <i class="icon-open_with prefix"></i>
                                <input type="text" name="name_producto" id="name_producto" value="<?php echo $detalles['Producto'][$i][0]['nombre_producto']?>" disabled>
                                <label for="name_producto">Producto</label>
                            </div>
                            <div class="input-field col s12 m4 xl4">
                                <i class="icon-open_with prefix"></i>
                                <input type="text" name="name_producto" id="name_producto" value="<?php echo $detalles['ProPedidos'][$i]->cant_pro_pedido?>" disabled>
                                <label for="name_producto">Cantidad</label>
                            </div>
                            <div class="input-field col s12 m4 xl4">
                                <i class="icon-open_with prefix"></i>
                                <input type="text" name="name_producto" id="name_producto" value="<?php echo $detalles['Producto'][$i][0]['precio_producto']?> $" disabled>
                                <label for="name_producto">Precio</label>
                            </div>

                            <?php

                            $monto1 = $detalles['Producto'][$i][0]['precio_producto'] * $detalles['ProPedidos'][$i]->cant_pro_pedido;

                            $montoProducto += $monto1;
                            ?>

                        <?php endfor; ?>
                        <div class="input-field col s12 m12 xl12">
                            <i class="icon-open_with prefix"></i>
                            <input type="text" name="total" id="total" value="<?php echo $montoProducto ?> $" disabled>
                            <label for="total">Total a Pagar Por Producto:</label>
                        </div>

                    <?php else: ?>


                    <?php endif; ?>
                    <div class="input-field col s12 m12 xl12">
                        <i class="icon-open_with prefix"></i>
                        <input type="text" name="total" id="total" value="<?php echo $montoProducto + $montoServicio ?> $" disabled>
                        <label for="total">Total a Pagar:</label>
                    </div>
                <?php if (Helpers::hasPermissions('6','3')): ?>
                <?php if($StatusFactura):?>
                    <div class="input-field col s12 m12 center-align">
                        <a href="#!" class="btn red waves-effect waves-light col s12" id="anular">
                            <i class="icon-delete right"></i>
                            Anular
                        </a>
                    </div>
                <?php else:?>
                    <div class="input-field col s12 m12 center-align">
                        <a href="#!" class="btn red waves-effect waves-light col s12" id="anular" disabled>
                            <i class="icon-delete right"></i>
                            Anular
                        </a>
                    </div>
                <?php endif?>
                <?php endif?>
                </form>
                    </div>
                </div>
                
            </div>
        </main>

        <!-- Footer -->
        <?php require_once "views/layouts/footer.php"; ?>


        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/factura.js"></script>
    </body>
</html>
