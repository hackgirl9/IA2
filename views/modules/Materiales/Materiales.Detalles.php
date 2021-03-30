<?php if($result): ?>

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
                    <a href="<?php echo Helpers::url('Material','index'); ?>" class="breadcrumb">Gestionar Materiales</a>
                    <a href="<?php echo Helpers::url('Material','getAll'); ?>" class="breadcrumb">Consultar Materiales</a>
                    <a href="<?php echo Helpers::url('Material','details')."/".$result->id_material?>" class="breadcrumb">Detalles <?php echo $result->nombre_material ?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card testimonial-card">
                <form action=" " method="post" id="update">
                    <div class="card-header center-align">
                        <h4>Detalles del Material</h4>
                    </div>
                    <div class="card-up primary-gradient"></div>
                    <div class="avatar avatar-centered">
                        <img src="<?php echo BASE_URL; ?>assets/images/creativity.png" alt="" srcset="">
                    </div>
                    <div class="card-content row">
                        <input type="hidden" name="id_material" id="id_material" value="<?php echo $result->id_material?>">

                        <div class="input-field col s12 m6">
                            <i class="icon-streetview prefix"></i>
                            <input type="text" name="nombre_material" id="nombre_material" value="<?php echo $result->nombre_material?>" required disabled>
                            <label for="nombre_material">Nombre del Material</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-exposure_plus_1 prefix"></i>
                            <input type="text" name="unidad_material" id="unidad_material" class="validate text-validate" value="<?php echo $result->unidad_material?>" required disabled>
                            <label for="unidad_material">Unidades</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-attach_money prefix"></i>
                            <input type="text" name="precio_material" id="precio_material" class="validate number-only-float" pattern="[0-9.]+" title="Solo puedes usar números y puntos." value="<?php echo $result->precio_material?>" required disabled>
                            <label for="precio_material">Precio del Material</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-description prefix"></i>
                            <textarea name="descripcion_material" id="descripcion_material" cols="30" rows="10" class="materialize-textarea" disabled><?php echo $result->descripcion_material?></textarea>
                            <label for="descripcion_material">Descripción</label>
                        </div>                                      
                    </div>
                    <div class="card-footer">
                        <div class="row" style="margin-bottom: 0">
                            <?php if (Helpers::hasPermissions('9','3')): ?>
                            <div class="col s12 m6 center-align">
                                <button type="button" class="btn btn-large btn-rounded blue-gradient waves-effect waves-light col s12" name="edit" id="edit">
                                    <i class="icon-redo right"></i>
                                    Editar
                                    <i class="icon-redo left"></i>
                                </button>
                            </div>
                            <?php endif; ?>
                            <?php if (Helpers::hasPermissions('9','4')): ?>
                            <div class="col s12 m6 center-align">
                                <button type="button" class="btn btn-large btn-rounded red-gradient waves-effect waves-light col s12" name="delete" id="delete">
                                    <i class="icon-remove right"></i>
                                    Eliminar
                                    <i class="icon-remove left"></i>
                                </button>
                            </div>
                            <?php endif; ?>
                            <div class="col s12 m6 center-aling">
                                <a href="<?php echo Helpers::url('Material','details')."/".$result->id_material?>" style="display: none" class="btn btn-large btn-rounded green-gradient waves-effect waves-light col s12" name="back" id="back">
                                    <i class="icon-arrow_back right"></i>
                                    Volver
                                    <i class="icon-arrow_back left"></i>
                                </a>
                            </div>
                            
                            <div class="col s12 m6 center-align">
                                <button type="submit" style="display: none" class="btn btn-large btn-rounded blue-gradient waves-effect waves-light col s12" name="update" id="update-btn">
                                    <i class="icon-update right"></i>
                                    Modificar
                                    <i class="icon-update left"></i>
                                </button>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Material.js"></script>
</body>

<?php else: $this->redirect('Material', 'index'); endif; ?>

</html>