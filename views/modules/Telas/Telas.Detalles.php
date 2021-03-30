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
                    <a href="<?php echo Helpers::url('Tela','index'); ?>" class="breadcrumb">Gestionar Telas</a>
                    <a href="<?php echo Helpers::url('Tela','getAll'); ?>" class="breadcrumb">Consultar Telas</a>
                    <a href="<?php echo Helpers::url('Tela','details')."/".$result->id_tela?>" class="breadcrumb">Detalles <?php echo $result->nombre_tela ?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card testimonial-card">
                <div class="card-header center-align">
                    <h4>Detalles de la Tela</h4>
                </div>
                <div class="card-up primary-gradient">
                </div>
                <div class="avatar avatar-centered">
                    <img src="<?php echo BASE_URL; ?>assets/images/polo.png" alt="" srcset="">
                </div>
                <form action=" " method="post" id="update" >
                    <div class="card-content row">
                        <input type="hidden" name="id_tela" id="id_tela" value="<?php echo $result->id_tela?>">
                        <div class="input-field col s12 m6">
                            <i class="icon-rate_review prefix"></i>
                            <input type="text" name="nombre_tela" id="nombre_tela" value="<?php echo $result->nombre_tela?>" disabled >
                            <label for="nombre_tela">Nombre de Tela</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-straighten prefix"></i>
                            <input type="text" name="unidad_med_tela" id="unidad_med_tela" class="validate text-validate" value="<?php echo $result->unidad_med_tela?>" disabled >
                            <label for="unidad_med_tela">Unidad de Medida</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-texture prefix"></i>
                            <input type="text" name="tipo_tela" id="tipo_tela" value="<?php echo $result->tipo_tela?>" disabled >
                            <label for="tipo_tela">Tipo de Tela</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-description prefix"></i>
                            <textarea name="descripcion_tela" id="descripcion_tela" cols="30" rows="10" class="materialize-textarea" disabled ><?php echo $result->descripcion_tela?></textarea>
                            <label for="descripcion_tela">Descripción</label>
                        </div>                
                    </div>
                    <div class="card-footer center-align">
                        <div class="row" style="margin-bottom: 0">
                            <?php if (Helpers::hasPermissions('8','3')): ?>
                            <div class="col s12 m6 center-align">
                                <button type="button" class="btn btn-large blue-gradient waves-effect waves-light col s12" name="edit" id="edit">
                                    <i class="icon-redo right"></i>
                                        Editar
                                    <i class="icon-redo left"></i>
                                </button>
                            </div> 
                            <?php endif; ?>
                            <?php if (Helpers::hasPermissions('8','4')): ?>
                            <div class="col s12 m6 center-align">
                                <button type="button" class="btn btn-large red-gradient waves-effect waves-light col s12" name="delete" id="delete">
                                    <i class="icon-remove right"></i>
                                        Eliminar
                                    <i class="icon-remove left"></i>
                                </button>
                            </div> 
                            <?php endif; ?>

                            
                            <div class="col s12 m6 center-aling">
                                <a href="<?php echo Helpers::url('Tela','details')."/".$result->id_tela; ?>" style="display: none" class="btn btn-large green-gradient waves-effect waves-light col s12" name="back" id="back">
                                    <i class="icon-arrow_back right"></i>
                                    Volver
                                    <i class="icon-arrow_back left"></i>
                                </a>
                            </div>

                            <div class="col s12 m6 center-align">
                                <button type="submit" style="display: none" class="btn btn-large blue-gradient waves-effect waves-light col s12" name="update" id="update-btn">
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Tela.js"></script>
</body>

<?php else: $this->redirect('Tela', 'index');

endif;

?>
</html>

