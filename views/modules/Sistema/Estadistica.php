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
    <title>Estadisticas - Inversiones A2</title>
</head>
<body class="grey lighten-4">
    <!-- Header -->
    <?php require_once "views/layouts/header.php" ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">

            <h4 class="black-text" style="margin-left:20px;"> Estadisticas Inversiones A2</h4>

            <div class="divider"></div>
            <!-- Widgets -->

            <div class="row" style="margin-top:20px;">
                <div class="col s12 m6">
                    <div class="widget bootstrap-widget stats">
                        <div class="widget-stats-icon red-gradient white-text">
                            <i class="icon-group_add"></i>
                        </div>
                        <div class="widget-stats-content">
                            <span class="widget-stats-title">Clientes Registrados al Mes</span>

                                <?php
                                $count1=0;
                                $count2=0;
                                    $fecha = date('m/Y');

                                    $count1=0;
                                    $count2=0;
                                    error_reporting(0);
                                        foreach($cliente as $clientes):
                                            if($clientes->mes==$fecha){
                                                $band=true;
                                            }else{
                                                $band=false;
                                            }

                                            if($band == false):?>

                                            <?php $band=true;?>
                                        <?php else:
                                            if($band==true):
                                                $count2+=$clientes->registro;
                                            ?>
                                                <span class="timer widget-stats-number" data-from="0" data-to=""><?php echo $count2?></span>
                                        <?php
                                            endif;
                                        endif;
                                        endforeach;
                                        if($count2 == 0):?>
                                            <span class="timer widget-stats-number" data-from="0" data-to="0"><?php echo $count2 ?></span>
                                        <?php endif?>

                        </div>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="widget bootstrap-widget stats">
                        <div class="widget-stats-icon blue-gradient white-text">
                            <i class="icon-equalizer"></i>
                        </div>
                        <div class="widget-stats-content">
                            <span class="widget-stats-title">Ventas facturadas al Mes</span>
                                <?php
                                    $fecha = date('m/Y');

                                   ?>
                                    <?php
                                    $count1=0;
                                    $count2=0;
                                        foreach($factura as $facturas):
                                            if($facturas->mes==$fecha){
                                                $band=true;
                                            }else{
                                                $band=false;
                                            }

                                            if($band == false):?>

                                            <?php $band=true;?>
                                        <?php else:
                                            if($band==true):
                                                $count2+=$facturas->registro;
                                            ?>
                                                <span class="timer widget-stats-number" data-from="0" data-to=""><?php echo $count2?></span>
                                        <?php
                                            endif;
                                        endif;
                                        endforeach;
                                        if($count2 == 0):?>
                                            <span class="timer widget-stats-number" data-from="0" data-to="0"><?php echo $count2 ?></span>
                                        <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row para gráficos -->
            <div class="row">
                <div class="col s12 m12 xl12">
                    <div class="card">
                        <div class="card-content">
                            <canvas id="ventas"></canvas>
                        </div>
                    </div>
                </div>
                <!-- <div class="col s12 m12 xl12">
                    <div class="card">
                        <div class="card-content">
                            <canvas id="ganancias"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Row para tablas -->
            <div class="row">
                <div class="col s12 m6">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5><i class="icon-event_note"></i>  Pedidos Pendientes</h5></li>
                        <?php if($pedido==null){  ?>
                            <li class="collection-item">

                            <div>
                                <span class="title"></b>No hay Pedidos En Proceso</span><br>
                            </div>
                        </li>
                        <?php }else{foreach($pedido as $pedidos): ?>
                        <li class="collection-item">

                            <a href="<?php echo Helpers::url('Pedido','details')."/".$pedidos->codigo_pedido; ?>"><span class="new badge red icon-touch_app small" data-badge-caption="Pendiente || Ver Pedido"></span></a>
                            <span class="title"><b>Cliente: </b> <?php echo Helpers::aesDecrypt($pedidos->nombre_cliente); ?></span><br>
                            <span class=""><b>Contacto: </b><?php  echo Helpers::aesDecrypt( $pedidos->telefono_cliente); ?></span><br>
                            <span class=""><b>Fecha Entrega: </b><?php echo $pedidos->fecha_entrega_pedido; ?></span>

                        </li>
                        <?php endforeach;}?>
                    </ul>
                </div>
                <div class="col s12 m6">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5><i class="icon-local_mall"></i>  Productos Mas Vendidos Anuales</h5></li>
                        <?php if($producto==null){  ?>
                            <li class="collection-item">

                            <div>
                                <span class="title"></b>No hay Productos Vendidos</span><br>

                            </div>
                        </li>

                        <?php  }else{foreach($producto as $productos): ?>
                        <li class="collection-item">

                            <div>
                            <a href="<?php echo Helpers::url('Producto','details')."/".$productos->codigo_producto; ?>"><span class="new badge blue icon-touch_app small" data-badge-caption="Ver Producto"></span></a>
                                <span class="title"><b>Producto: </b><?php echo $productos->nombre_producto ?></span><br>
                                <span><b>Codigo: </b><?php echo $productos->codigo_producto; ?></span><br>
                                <span><b>Precio: </b><?php echo $productos->precio_producto; ?></span><br>
                                <span><b>Ventas por Pedidos: </b><?php echo $productos->total; ?></span>
                            </div>
                        </li>
                            <?php endforeach;}?>
                    </ul>
                </div>

                <div class="col s12 m12">
                    <ul class="collection with-header">
                        <li class="collection-header"><h5><i class="icon-local_atm"></i>  Servicios Mas Vendidos Anuales</h5></li>
                        <?php if($servicio==null){  ?>
                            <li class="collection-item">

                            <div>
                                <span class="title"></b>No hay Servicios Vendidos</span><br>

                            </div>
                        </li>

                        <?php
                        }else{foreach($servicio as $servicios): ?>
                        <li class="collection-item">

                            <div>
                                <a href="<?php echo Helpers::url('Servicio','details')."/".$servicios->id_servicio; ?>"><span class="new badge green icon-touch_app small" data-badge-caption="Ver Servicio"></span></a>
                                <span class="title"><b>Servicio: </b><?php echo $servicios->nombre_servicio ?></span><br>
                                <span><b>Descripción: </b><?php echo $servicios->descripcion_servicio; ?></span><br>
                                <span><b>Precio: </b><?php echo $servicios->precio_servicio; ?></span><br>
                                <span><b>Ventas por Pedidos: </b><?php echo $servicios->total; ?></span>
                            </div>
                        </li>
                            <?php endforeach;}?>
                    </ul>
                </div>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Dashboard.js"></script>
</body>
</html>
