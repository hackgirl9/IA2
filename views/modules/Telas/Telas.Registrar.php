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
    <title>Registrar Tela - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="breadcrumb">Configuración</a>
                    <a href="<?php echo Helpers::url('Tela','index'); ?>" class="breadcrumb">Gestionar Telas</a>
                    <a href="<?php echo Helpers::url('Tela','create'); ?>" class="breadcrumb">Registrar Tela</a>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="" method="post" class="row" id="register">
                <div class="col s12">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Registrar Tela</h4>
                        </div>
                        <div class="card-content row">
                            <input type="hidden" name="id_tela" id="id_tela">
                            <div class="input-field col s12 m6">
                                <i class="icon-rate_review prefix"></i>
                                <input type="text" name="nombre_tela" id="nombre_tela" class="validate" minlength="1" maxlength="20" required>
                                <label for="nombre_tela">Nombre de Tela</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="icon-straighten prefix"></i>
                                <input type="text" name="unidad_med_tela" id="unidad_med_tela" class="validate text-validate" minlength="1" maxlength="3" required>
                                <label for="unidad_med_tela">Unidad de Medida</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="icon-texture prefix"></i>
                                <input type="text" name="tipo_tela" id="tipo_tela" class="validate" minlength="1" maxlength="20" required>
                                <label for="tipo_tela">Tipo de Tela</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="icon-description prefix"></i>
                                <textarea name="descripcion_tela" id="descripcion_tela" cols="30" rows="10" class="materialize-textarea"></textarea>
                                <label for="descripcion_tela">Descripción</label>
                            </div>
                        </div>
                        <div class="card-footer center-align">
                            <button type="submit" class="btn btn-large btn-rounded green-gradient waves-effect waves-light" name="registrar">
                                <i class="icon-save left"></i>
                                Registrar
                                <i class="icon-save right"></i>
                            </button>
                        </div>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Tela.js"></script>
</body>
</html>
