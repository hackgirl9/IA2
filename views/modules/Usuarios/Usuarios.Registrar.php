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
    <title>Registrar Usuario - Inversiones A2</title>
</head>
<body class="grey lighten-4">
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">
            <div class="col s12 breadcrumb-nav left-align">
                <a href="<?php echo Helpers::url('Home','index'); ?>" class="breadcrumb">Inicio</a>
                <a href="<?php echo Helpers::url('Usuario','index'); ?>" class="breadcrumb">Gestionar Usuarios</a>
                <a href="<?php echo Helpers::url('Usuario','create'); ?>" class="breadcrumb">Registrar Usuarios</a>
            </div>
            <!-- <div class="row">
            </div> -->
        </div>
        <div class="container">
            <form action="<?php echo Helpers::url('Usuario','register'); ?>" method="post" class="row" id="register">
                <div class="card">
                    <div class="card-header center-align">
                        <h4>Registrar Usuario</h4>
                    </div>
                    <div class="card-content row">
                        <!-- <div class="input-field col s12 m6 xl4">
                        <i class="icon-contact_mail prefix"></i>
                        <input id="cedula_usuario" type="text" name="cedulaUcedula_usuarioscedula_usuariouario" class="validate" minlength="5" maxlength="8" pattern="[0-9]+"  title="Solo puedes usar números." required>
                        <label for="cedula_usuario">Cedula del Usuario</label>
                    </div> -->
                    <div class="input-field col s12 m6">
                        <i class="icon-person_pin prefix"></i>
                        <input id="nombre_usuario" type="text" name="nombre_usuario"  class="validate text-validate" minlength="3" maxlength="20"  pattern="[A-Za-z ]+" title="Solo puedes usar letras." required>
                        <label for="nombre_usuario" >Nombre del Usuario</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-person_pin prefix"></i>

                        <input id="apellido_usuario" type="text" name="apellido_usuario" class="validate text-validate"  minlength="3" maxlength="20"  pattern="[A-Za-z ]+" title="Solo puedes usar letras." required>
                        <label for="apellido_usuario">Apellido del Usuario</label>
                    </div>
                    <!-- <div class="input-field col s12 m6 xl4">
                        <i class="icon-phone_android prefix"></i>
                        <input id="telefono_usuario" type="text" name="telefono_usuario" class="validate" minlength="11" maxlength="11" pattern="[0-9]+"  title="Solo puedes usar numeros." required>
                        <label for="telefono_usuario">Teléfono del Usuario</label>
                    </div> -->
                    <div class="input-field col s12 m6">
                        <i class="icon-markunread prefix"></i>
                        <input type="email" name="email_usuario" id="email_usuario" class="validate">
                        <label for="email_usuario">E-mail del Usuario</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-person_pin prefix"></i>
                        <input type="text" name="nick_usuario" id="nick_usuario" class="validate code-only">
                        <label for="nick_usuario">Nick del Usuario</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="icon-beenhere prefix"></i>
                        <input type="password" name="contrasenia_usuario" id="contrasenia_usuario" pattern='[A-Za-z0-9]+{5,20}' minlength="8" title="La contraseña debe tener una logitud mínima de 8 caracteres y contener al menos un letra en mayuscula y un número."  class="validate">
                        <label for="contrasenia_usuario">Password del Usuario</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="icon-beenhere prefix"></i>
                        <input type="password" name="repeat_contrasenia_usuario" id="repeat_contrasenia_usuario"  pattern='[A-Za-z0-9]+{5,20}' minlength="8" title="La contraseña debe tener una logitud mínima de 8 caracteres y contener al menos un letra en mayuscula y un número." class="validate">
                        <label for="repeat_contrasenia_usuario">Repetir Password del Usuario</label>
                    </div>
                    <!-- <div class="file-field input-field col s12">
                        <div class="btn purple">
                            <span><i class="icon-photo_size_select_actual right"></i>Imagen</span>
                            <input type="file" name="url_imagen" id="url_imagen">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Elige una imagen">
                        </div>
                    </div> -->
                        <div class="input-field col s12">
                            <i class="icon-assistant prefix"></i>
                            <select name="id_pregunta" id="id_pregunta">

                                <option value="null" disabled selected>Elige una pregunta</option>

                                <?php if(!is_null($allPreguntas)):?>
                                    <?php foreach ($allPreguntas as $pregunta):?>
                                        <option value="<?php echo $pregunta->pregunta;?>">¿<?php echo $pregunta->pregunta;?>?</option>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <option value="null" disabled selected>Sin preguntas aún registrados.</option>
                                <?php endif?>
                            </select>
                            <label for="id_rol">Pregunta de seguridad</label>
                        </div>

                        <div class="input-field col s12 m12">
                            <i class="icon-person_pin prefix"></i>
                            <input type="text" name="respuesta" id="respuesta" class="validate code-only" minlength="3"  maxlength="100">
                            <label for="respuesta">Repuesta secreta</label>
                        </div>


                        <div class="col s12 m12">
                            <h4 class="center-align">Elige una imagen de seguridad</h4>
                        </div>
                        <?php foreach ($allImageSeguridad as $image):?>

                            <div class="col s12 m6 payment-form">
                                <input type="radio" id="image_<?php echo $image->id_imagen_seguridad ?>" name="image" value="storage/image-seguridad/<?php echo $image->imagen; ?>" id-imagen="<?php echo $image->id_imagen_seguridad ?>" class="type_payment_event">
                                <label class="btn-radio white lighten-4" for="image_<?php echo $image->id_imagen_seguridad ?>">
                                    <i class="">
                                        <img src="<?php echo BASE_URL; ?>storage/image-seguridad/<?php echo $image->imagen; ?>"
                                             style="height: 100px!important;width: 100px!important;"
                                             alt="Smartphone Image" width="100%" height="100%">
                                    </i>
                                </label>
                            </div>

                        <?php endforeach;?>


                        <div class="input-field col s12">
                            <i class="icon-beenhere prefix"></i>
                            <input type="password" name="contrasenia_especial" id="contrasenia_especial" pattern='[A-Za-z0-9]+{5,20}' minlength="4" title="La clave especial debe tener una logitud maxima de 4 caracteres."  class="validate">
                            <label for="contrasenia_especial">Clave Especial</label>
                        </div>


                    <div class="input-field col s12">
                        <i class="icon-assistant prefix"></i>
                        <select name="id_rol" id="id_rol">

                            <option value="null" disabled selected>Elige un rol</option>

                            <?php if(!is_null($roles)):?>
                                <?php foreach ($roles as $rol):?>
                                    <option value="<?php echo $rol->id_rol;?>"><?php echo $rol->nombre_rol;?></option>
                                <?php endforeach;?>
                            <?php else:?>
                                <option value="null" disabled selected>Sin roles aún registrados.</option>
                            <?php endif?>
                        </select>
                        <label for="id_rol">Rol</label>
                    </div>
                    </div>
                    <div class="card-footer center-align">
                        <button type="submit" class="btn btn-large btn-rounded green-gradient waves-effect waves-light">
                            <i class="icon-add left"></i>
                            Registrar
                            <i class="icon-add right"></i>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Usuario.js"></script>
</body>
</html>
