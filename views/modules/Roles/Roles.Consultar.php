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
    <title> - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Cliente','index'); ?>" class="breadcrumb">Gestionar Roles</a>
                    <a href="<?php echo Helpers::url('Cliente','getAll'); ?>" class="breadcrumb">Consultar Roles</a>
                </div>
                <div class="col s12 center-align">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Consultar Roles</h4>
                        </div>
                        <div class="card-content row">
                            <div class="col s12">
                                <table class="responsive-table highlight centered">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!is_null($roles)):?>
                                        <?php foreach ($roles as $rol):?>
                                            <tr>
                                                <td><?php echo $rol->nombre_rol;?></td>
                                                <td><?php echo $rol->descripcion_rol;?></td>
                                                <td><a href="<?php echo Helpers::url('Roles','getBy')."/".$rol->id_rol; ?>" class="btn btn-floating pink-gradient waves-effect waves-light"><i class="icon-find_in_page"></i></a></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="6"><h5 class="center-align">Todavia no registras un rol.</h5></td>
                                        </tr>

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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
</body>
</html>