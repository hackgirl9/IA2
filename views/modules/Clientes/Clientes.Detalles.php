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
                <a href="<?php echo Helpers::url('Cliente','index'); ?>" class="breadcrumb">Gestionar Clientes</a>
                <a href="<?php echo Helpers::url('Cliente','getAll'); ?>" class="breadcrumb">Consultar Cliente</a>
                <a href="<?php echo Helpers::url('Cliente','details'); ?>" class="breadcrumb">Detalles</a>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="" method="post" id="form-details-client">
            <div class="card">
                <div class="card-header center-align">
                    <h4>Detalles del Cliente</h4>
                </div>
                <div class="card-content row">
                    <div class="input-field col s3 m2 xl2">
                        <i class="icon-folder_shared prefix"></i>
                        <select name="" id="" disabled>
                            <option value="" disabled>Elegir</option>
                            <option value="" <?php if($cliente->tipo_documento_cliente=='V') echo "selected";?>>V</option>
                            <option value=""  <?php if($cliente->tipo_documento_cliente=='R') echo "selected"?>>R</option>
                            <option value=""  <?php if($cliente->tipo_documento_cliente=='J') echo "selected"?>>J</option>
                        </select>
                    </div>
                    <div class="input-field col s9 m4 xl4">
                        <input type="text" name="documento_identidad" id="documento_identidad" class="validate number-date" value="<?php echo $cliente->cedula_cliente; ?>" disabled>
                        <label for="documento_identidad">Documento de Identidad</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-account_circle prefix"></i>
                        <input type="text" name="nombre_cliente" id="nombre_cliente" class="validate text-validate" value="<?php echo Helpers::aesDecrypt($cliente->nombre_cliente); ?>" disabled>
                        <label for="nombre_cliente">Nombre del Cliente <?php  echo Helpers::aesDecrypt($cliente->nombre_cliente);?></label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-description prefix"></i>
                        <textarea name="descripcion" id="descripcion_cliente" cols="30" rows="10" class="materialize-textarea" disabled><?php echo Helpers::aesDecrypt($cliente->descripcion_cliente); ?></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-room prefix"></i>
                        <textarea name="direccion_cliente" id="direccion_cliente" cols="30" rows="10" class="materialize-textarea" disabled><?php echo Helpers::aesDecrypt($cliente->direccion_cliente); ?></textarea>
                        <label for="direccion_cliente">Dirección del Cliente</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-contact_phone prefix"></i>
                        <input type="text" name="telefono_cliente" id="telefono_cliente" class="validate number-date" maxlength="11" value="<?php echo Helpers::aesDecrypt($cliente->telefono_cliente); ?>" disabled>
                        <label for="telefono_cliente">Teléfono del Cliente</label>
                    </div>
                    <div class="input-field col s12 m6 xl6">
                        <i class="icon-person prefix"></i>
                        <input type="text" name="representante_cliente" id="representante_cliente" class="validate text-validate" value="<?php echo $cliente->representante_cliente; ?>" disabled required>
                        <label for="representante_cliente">Representante</label>
                    </div>
                </div>
                <div class="card-footer center-align">
                    <div class="row" style="margin-bottom: 0">
                        <div class="col s12 m6 center-align">
                            <button type="submit" href="#!" class="btn btn-large btn-rounded blue-gradient waves-effect waves-light col s12" id="modify">
                                <i class="icon-update right"></i>
                                Modificar
                                <i class="icon-update left"></i>

                            </button>
                        </div>
                        <div class="col s12 m6 center-align">
                            <a href="#!" class="btn btn-large btn-rounded red-gradient waves-effect waves-light col s12" id="delete">
                                <i class="icon-delete right"></i>
                                Eliminar
                                <i class="icon-delete left"></i>
                            </a>
                        </div>
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
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Cliente.js"></script>
</body>
</html>
