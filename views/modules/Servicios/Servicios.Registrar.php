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

        <title>Registrar Servicio - Inversiones A2</title>
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
                        <a href="<?php echo Helpers::url('Configuracion', 'index'); ?>" class="breadcrumb">Configuración</a>
                        <a href="<?php echo Helpers::url('Servicio', 'index'); ?>" class="breadcrumb">Gestionar Servicios</a>
                        <a href="<?php echo Helpers::url('Servicio', 'create'); ?>" class="breadcrumb">Registrar Servicio</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="" method="post" class="row" id="register">
                        <div class="card">
                            <div class="card-header center-align">
                                <h4>Registrar Servicio</h4>
                            </div>
                            <div class="card-content row">
                                <div class="input-field col s12 m6">
                                    <i class="icon-stars prefix"></i>
                                    <input type="text" name="nombre_servicio" id="nombre_servicio" required>
                                    <label for="nombre_servicio">Nombre del Servicio</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-open_with prefix"></i>
                                    <input type="text" name="unidad_medida" id="unidad_medida" class="validate code-only" required>
                                    <label for="unidad_medida">Unidad de Medida</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-monetization_on prefix"></i>
                                    <input type="text" name="costo_servicio" id="costo_servicio" class="validate number-only-float" pattern="[0-9.,]+" title="Solo puede usar números." required>
                                    <label for="costo_servicio">Costo</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-attach_money prefix"></i>
                                    <input type="text" name="precio_servicio" id="precio_servicio" class="validate number-only-float" pattern="[0-9.,]+" title="Solo puede usar números." required>
                                    <label for="precio_servicio">Precio</label>
                                </div>
                                
                                <div class="input-field col s12">
                                    <i class="icon-description prefix"></i>
                                    <textarea name="descripcion_servicio" id="descripcion_servicio" cols="30" rows="10" class="materialize-textarea"></textarea>
                                    <label for="descripcion_servicio">Descripción</label>
                                </div>
                            </div>
                            <div class="card-footer center-align">
                                <button type="submit" class="btn btn-large btn-rounded green-gradient waves-light waves-effect">
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
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Servicio.js"></script>
    </body>
</html>