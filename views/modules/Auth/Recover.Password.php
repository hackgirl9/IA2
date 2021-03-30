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
    <title>Inversiones A2 - Recuperar Contraseña</title>
</head>
<body class="login-view login-background">

<main>
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 animated bounceInDown">
                <form action="<?php echo Helpers::url('Auth', 'recoverPassword'); ?>" method="post" class="card bg-light-opacity-8">
                    <?php
                    $message = null;
                    if($message):
                        ?>
                        <div class="col s12">
                            <div class="message message-danger">
                                <div class="message-body">
                                    <strong><?php $message ?></strong>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card-header center-align">
                        <h5>Recuperar Contraseña</h5>
                    </div>
                    <div class="card-content row">
                        <div class="input-field col s12">
                            <i class="icon-account_circle prefix"></i>
                            <input name="email" class="validate" id="email" type="text">
                            <label for="email" required>Email</label>
                        </div>
                    </div>
                    <div class="card-footer center-align">
                        <button type="submit" id="enviar" class="btn btn-large btn-rounded primary-gradient waves-effect effect-light" disabled>
                            Recuperar Contraseña
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
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Auth.js"></script>

</body>
</html>
