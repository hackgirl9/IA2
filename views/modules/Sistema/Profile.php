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

    <title>Perfil - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Home','account'); ?>" class="breadcrumb">Perfil</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card testimonial-card">
                        <div class="card-up primary-gradient"></div>
                        <div class="avatar avatar-centered">
                            <img src="<?php echo BASE_URL; ?>assets/images/avatar-1.png" alt="" srcset="">
                        </div>
                        <div class="card-content row">
                            <form action="" class="row">
                                <div class="input-field col s12 m6">
                                    <i class="icon-contact_mail prefix"></i>
                                    <input id="cedulaUsuario" type="text" name="cedulaUsuario" class="validate" value="12345678" disabled>
                                    <label for="cedulaUsuario">Cedula del Usuario</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-person_pin prefix"></i>
                                    <input id="nombreUsuario" type="text" name="nombreUsuario"  class="validate" minlength="3" maxlength="20"  pattern="[A-Za-z]+" title="Solo puedes usar letras." required>
                                    <label for="nombreUsuario" >Nombre del Usuario</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-person_pin prefix"></i>
                                    <input id="apellidoUsuario" type="text" name="apellidoUsuario" class="validate"  minlength="3" maxlength="20"  pattern="[A-Za-z]+" title="Solo puedes usar letras." required>
                                    <label for="apellidoUsuario">Apellido del Usuario</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-phone_android prefix"></i>
                                    <input id="telefonoUsuario" type="text" name="telefonoUsuario" class="validate" minlength="11" maxlength="11" pattern="[0-9]+"  title="Solo puedes usar numeros." required>
                                    <label for="telefonofUsuario">Teléfono del Usuario</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-markunread prefix"></i>
                                    <input type="email" name="emailUsuario" id="emailUsuario" class="validate" required>
                                    <label for="emailUsuario">E-mail del Usuario</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="icon-person_pin prefix"></i>
                                    <input type="text" name="nickUsuario" id="nickUsuario" class="validate" required>
                                    <label for="nickUsuario">Nick del Usuario</label>
                                </div>
                                <div class="input-field col s12">
                                    <span>
                                        <label>
                                            <input type="checkbox" class="filled-in"/>
                                            <span>Estoy de acuerdo con los terminos y condiciones</span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col s12 center-align">
                                    <div class="btn btn-small primary-gradient waves-effect waves-light">Enviar</div>
                                </div>
                            </form>
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