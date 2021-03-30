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
    <title>Telas Disponibles - Inversiones A2</title>
</head>
<body class="grey lighten-4">
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="contaner-fluid">
            <div class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="<?php echo Helpers::url('Home','index'); ?>" class="breadcrumb">Inicio</a>
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="breadcrumb">Configuración</a>
                    <a href="<?php echo Helpers::url('Tela','index'); ?>" class="breadcrumb">Gestionar Telas</a>
                    <a href="<?php echo Helpers::url('Tela','getAll'); ?>" class="breadcrumb">Consultar Telas</a>
                </div>
                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Telas Disponibles</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12" style="padding:30px">
                                <table class="centered striped" id="Tela" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Tela</th>
                                            <th>Descripción</th>
                                            <th>U. Medida</th>
                                            <th>Tipo</th>
                                            <?php if (Helpers::hasPermissions('8','5')): ?>
                                            <th>Detalles</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($query != null): ?>
                                        <?php foreach($query as $tela):?>
                                            <tr>
                                                <td><?php echo $tela->nombre_tela; ?></td>
                                                <td><?php echo $tela->descripcion_tela; ?></td>
                                                <td><?php echo $tela->unidad_med_tela; ?></td>
                                                <td><?php echo $tela->tipo_tela; ?></td>
                                                <?php if (Helpers::hasPermissions('8','5')): ?>
                                                <td>
                                                    <a href="<?php echo Helpers::url('Tela','details')."/".$tela->id_tela?>" class="btn btn-floating pink-gradient waves-effect effect-light"><i class="icon-pageview"></i></a>
                                                </td>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Tela.js"></script>
</body>
</html>