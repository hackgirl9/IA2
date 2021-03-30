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
    <title>Inversiones A2 - Iniciar Sesión</title>
</head>
<body class="login-view login-background">

    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2 animated bounceInDown">
                    <form action="<?php echo Helpers::url('Auth', 'login'); ?>" method="post" class="card bg-light-opacity-8">
                        <div class="card-header center-align">
                            <img src="<?php echo BASE_URL ?>assets/images/user-black.svg" style="width: 75px; height: 75px; margin-top: 1rem;" alt="" srcset="">
                            <h5>Iniciar Sesión</h5>
                        </div>
                        <div class="card-content row">
                            <?php if(isset($_SESSION["error"])&& $_SESSION["error"] ): ?>
                                <div class="col s12">
                                    <div class="message message-danger">
                                        <div class="message-body">
                                            <strong><?php echo $_SESSION['message']; ?></strong>

                                            <?php $_SESSION['message']='';
                                                  $_SESSION['error']=false;
                                             ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="input-field col s12">
                                <i class="icon-account_circle prefix"></i>
                                <input name="nick_usuario" class="validate" id="nick_usuario" type="text">
                                <label for="nick_usuario" required>Usuario</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="icon-lock prefix"></i>
                                <input type="password" name="contrasenia_usuario" id="contrasenia_usuario" class="validate" required>
                                <label for="contrasenia_usuario">Contraseña</label>
                            </div>
                            <div class="col s12">
                                <p class="center-align">
                                    <a href="<?php echo Helpers::url('Auth', 'recoverPasswordView'); ?>" class="secondary-dark-text" style="margin-left: 5px">¿Olvidó su Contraseña?</a>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer center-align">
                            <!-- <button id="ingresar" class="btn btn-large btn-rounded primary-gradient waves-effect effect-light">Entrar <i class="icon-send right"></i></button> -->
                            <button type="submit" id="ingresar" class="btn btn-large btn-rounded primary-gradient waves-effect effect-light">
                                Continuar
                                <i class="icon-send right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
</body>
</html>
