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
    <title>Detalles - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Usuario','index'); ?>" class="breadcrumb">Gestionar Usuarios</a>
                    <a href="<?php echo Helpers::url('Usuario','getAll'); ?>" class="breadcrumb">Consultar Usuarios</a>
                    <a href="<?php echo Helpers::url('Usuario','details'); ?>" class="breadcrumb">Detalles</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card testimonial-card">
                <div class="card-header center-align">
                    <h4>Detalles del Usuario</h4>
                </div>
                <div class="card-up primary-gradient">
                </div>
                <div class="avatar avatar-centered">
                    <img src="<?php echo BASE_URL; ?>assets/images/matthew.png" alt="" srcset="">
                </div>
                <form action="#" method="post" id="update">
                    <div class="card-content row">
                        <!-- <div class="input-field col s12 m6 xl4">
                            <i class="icon-contact_mail prefix"></i>
                            <input id="cedula_usuario" type="text" name="cedulaUcedula_usuarioscedula_usuariouario" class="validate" minlength="5" maxlength="8" pattern="[0-9]+"  title="Solo puedes usar números." required>
                            <label for="cedula_usuario">Cedula del Usuario</label>
                        </div> -->
                        <div id="form-user">
                            <div class="input-field col s12 m6">
                                <i class="icon-person_pin prefix"></i>
                                <input id="nombre_usuario" type="text" name="nombre_usuario"  class="validate text-validate" minlength="3" maxlength="20"  pattern="[A-Za-z]+" title="Solo puedes usar letras." value="<?php echo $usuario->nombre_usuario; ?>" required disabled>
                                <label for="nombre_usuario" >Nombre del Usuario</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="icon-person_pin prefix"></i>
                                <input id="apellido_usuario" type="text" name="apellido_usuario" class="validate text-validate"  minlength="3" maxlength="20"  pattern="[A-Za-z]+" title="Solo puedes usar letras." value="<?php echo $usuario->apellido_usuario; ?>" required disabled>
                                <label for="apellido_usuario">Apellido del Usuario</label>
                            </div>
                            <!-- <div class="input-field col s12 m6 xl4">
                                <i class="icon-phone_android prefix"></i>
                                <input id="telefono_usuario" type="text" name="telefono_usuario" class="validate" minlength="11" maxlength="11" pattern="[0-9]+"  title="Solo puedes usar numeros." required disabled>
                                <label for="telefono_usuario">Teléfono del Usuario</label>
                            </div> -->
                            <div class="input-field col s12 m6">
                                <i class="icon-markunread prefix"></i>
                                <input type="email" name="email_usuario" id="email_usuario" class="validate" value="<?php echo $usuario->email_usuario; ?>" required disabled>
                                <label for="email_usuario">E-mail del Usuario</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="icon-person_pin prefix"></i>
                                <input type="text" name="nick_usuario" id="nick_usuario" class="validate code-only" value="<?php echo $usuario->nick_usuario; ?>" required disabled>
                                <label for="nick_usuario">Nick del Usuario</label>
                            </div>
                            <!--
                            <div class="file-field input-field col s12">
                                <div class="btn purple">
                                    <span><i class="icon-photo_size_select_actual right"></i>Imagen</span>
                                    <input type="file" name="url_imagen" id="url_imagen">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Elige una imagen">
                                </div>
                            </div> -->
                            <div class="input-field col s12" id="last-input">
                                <i class="icon-assistant prefix"></i>
                                <select name="id_rol" id="id_rol" disabled>
                                    <option value="" disabled>Elige un rol</option>
                                    <?php foreach ($roles as $rol):?>
                                        <?php if($usuario->id_rol==$rol->id_rol):?>
                                            <option value="<?php echo $rol->id_rol;?>" selected> <?php echo $rol->nombre_rol;?></option>
                                            <?php else:?>
                                            <option value="<?php echo $rol->id_rol;?>"> <?php echo $rol->nombre_rol;?></option>
                                            <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                                <label for="id_rol">Rol</label>
                            </div>





                            <div class="input-field col s12" id="last-input">
                                <i class="icon-assistant prefix"></i>
                                <select name="status" id="status" disabled>
                                        <?php if($usuario->status==0):?>
                                            <option value="0" selected> Activo</option>
                                             <option value="1">Bloqueado</option>
                                        <?php else:?>
                                            <option value="0" > Activo</option>
                                            <option value="1" selected>Bloqueado</option>
                                        <?php endif;?>
                                </select>
                                <label for="id_rol">Status del Usuario</label>
                            </div>




                        </div>

                        <div id="form-password" style="display: none;">
                            <input type="hidden" name="nick_usuario" id="nick_usuario" value="<?php echo $usuario->nick_usuario; ?>">
                            <div class="input-field col s12">
                                <i class="icon-beenhere prefix"></i>
                                <input type="password" name="contrasenia_usuario" id="contrasenia_usuario" class="validate"  disabled>
                                <label for="contrasenia_usuario">Password del Usuario</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="icon-beenhere prefix"></i>
                                <input type="password" name="repeat_contrasenia_usuario" id="repeat_contrasenia_usuario" class="validate"  disabled>
                                <label for="repeat_contrasenia_usuario">Repetir Password del Usuario</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row" style="margin-bottom: 0">
                            <div class="col s12 m6 center-align" id="modify-btn">
                                <a id="modify" class="btn btn-large blue-gradient btn-rounded waves-effect waves-light col s12">
                                    <i class="icon-update left"></i>
                                    Modificar
                                    <i class="icon-update right"></i>
                                </a>
                            </div>
                            <!-- <br class="show-on-down-only"> -->
                            <div class="col s12 m6 center-align" id="delete-btn">
                                <a id="delete" class="btn btn-large btn-rounded red-gradient waves-effect waves-light col s12">
                                    <i class="icon-remove left"></i>
                                    Eliminar
                                    <i class="icon-remove right"></i>
                                </a>
                            </div>
                            <div class="col s12 m6 center-align" style="display: none" id="update-btn">
                                <button type="submit" class="btn btn-large btn-rounded green-gradient waves-effect waves-light col s12">
                                    <i class="icon-save left"></i>
                                    Actualizar
                                    <i class="icon-save right"></i>
                                </button>
                            </div>
                            <div class="col s12 m6 center-align" id="change-password" style="margin-top: 1rem;">
                                <a  class="btn btn-large btn-rounded indigo-gradient waves-effect waves-light col s12" id="change-password-btn">
                                    <i class="icon-lock left"></i>
                                    Cambiar Contraseña
                                </a>
                            </div>
                            <div class="col s12 m6 center-align" style="display: none; margin-top: 1rem;" id="update-password">
                                <a  class="btn btn-large btn-rounded blue-gradient waves-effect waves-light col s12" id="update-password-btn">
                                    <i class="icon-update left"></i>
                                    Actualizar Contraseña
                                    <i class="icon-update right"></i>
                                </a>
                            </div>
                            <div class="col s12 m6 center-align" style="display: none; margin-top: 1rem;" id="reset-buttons">
                                <a  class="btn btn-large btn-rounded red-gradient waves-effect waves-light col s12" id="reset-btn">
                                    <i class="icon-cancel left"></i>
                                    Atras
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
