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
    <title>Consultar Clientes - Inversiones A2</title>
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
                <a href="<?php echo Helpers::url('Cliente','index'); ?>" class="breadcrumb">Gestionar Clientes</a>
                <a href="<?php echo Helpers::url('Cliente','getAll'); ?>" class="breadcrumb">Consultar Clientes</a>
            </div>
            <div class="col s12 center-align">
                <div class="card">
                    <div class="card-header center-align">
                        <h4>Consultar Clientes</h4>
                    </div>
                    <div class="card-content row">
                        <div class="col s12">
                            <table class="highlight centered" id="clientes" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Identificación</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Detalles</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!is_null($clientes)):?>
                                    <?php foreach ($clientes as $cliente):?>
                                        <tr>
                                            <td><?php echo Helpers::aesDecrypt($cliente->nombre_cliente);?></td>
                                            <td><?php echo Helpers::aesDecrypt($cliente->descripcion_cliente);?></td>
                                            <td><?php echo $cliente->tipo_documento_cliente ."-". $cliente->cedula_cliente;?></td>
                                            <td><?php echo Helpers::aesDecrypt($cliente->telefono_cliente);?></td>
                                            <td><?php echo Helpers::aesDecrypt($cliente->direccion_cliente);?></td>
                                            <td><a href="<?php echo Helpers::url('Cliente','details')."/".$cliente->cedula_cliente; ?>" class="btn btn-floating pink-gradient waves-effect waves-light"><i class="icon-find_in_page"></i></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif?>
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
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Cliente.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
</body>
</html>