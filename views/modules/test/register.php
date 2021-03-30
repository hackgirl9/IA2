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
    <title>Registrar Producto - Inversiones A2</title>
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
                <a href="<?php echo Helpers::url('Producto','create'); ?>" class="breadcrumb">Registrar Producto</a>

            </div>
        </div>
    </div>
    <div class="container">
        <form action="<?php echo Helpers::url('Test','save'); ?>"  method="post" class="row" id="register" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header center-align">
                    <h4>Registrar Producto</h4>
                </div>
                <div class="card-content row">
                    <div class="file-field input-field col s12 m6 xl8">
                        <div class="btn purple-gradient">
                            <span><i class="icon-photo_size_select_actual right"></i>Imagen</span>
                            <input type="file" name="test" id="test">
                        </div>
                    </div>

                </div>
                <div class="card-footer center-align">
                    <button type="submit" class="btn btn-large btn-rounded waves-effect waves-light green-gradient">
                        Registrar
                        <i class="icon-save right"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>


<!-- Footer -->
<?php require_once "views/layouts/footer.php"; ?>


<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>
</body>
</html>
