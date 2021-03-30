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
                <a href="<?php echo Helpers::url('Home', 'index'); ?>" class="breadcrumb">Inicio</a>
                <a href="<?php echo Helpers::url('Configuracion', 'index'); ?>" class="breadcrumb">Configuración</a>
                <a href="<?php echo Helpers::url('Servicio', 'index'); ?>" class="breadcrumb">Gestionar Servicios</a>
                <a href="<?php echo Helpers::url('Servicio', 'create'); ?>" class="breadcrumb">Consultar Servicios</a>
                <!--<a href="<?php echo Helpers::url('Servicio', 'create'); ?>" class="breadcrumb">Detalles</a>-->
            </div>
            <div class="col s12 m10 offset-m1">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header center-align">
                            <h4>Detalles del Servicio</h4>
                        </div>
                        <div class="card-content row" style="margin-bottom: 0">
                            <?php foreach ($detalles as $value): ?>
                                <div class="input-field col s12 m6 xl6">
                                    <i class="icon-stars prefix"></i>
                                    <input type="hidden" name="id_servicio" id="id_servicio"
                                           value="<?php echo $value['id_servicio'] ?>" disabled>
                                    <input type="text" name="nombre_servicio" id="nombre_servicio"
                                           value="<?php echo $value['nombre_servicio'] ?>" disabled>
                                    <label for="nombre_servicio">Nombre Del Servicio</label>
                                </div>
                                <div class="input-field col s12 m6 xl6">
                                    <i class="icon-attach_money prefix"></i>
                                    <input type="text" name="precio_servicio" id="precio_servicio"
                                           class="validate number-only-float"
                                           value="<?php echo $value['precio_servicio'] ?>" disabled>
                                    <label for="precio_servicio">Precio del Servicio</label>
                                </div>
                                <div class="input-field col s12 m6 xl6">
                                    <i class="icon-monetization_on prefix"></i>
                                    <input type="text" name="costo_servicio" id="costo_servicio"
                                           class="validate number-only-float"
                                           value="<?php echo $value['costo_servicio'] ?>" disabled>
                                    <label for="costo_servicio">Costo del Servicio</label>
                                </div>
                                <div class="input-field col s12 m6 xl6">
                                    <i class="icon-open_with prefix"></i>
                                    <input type="text" name="unidad_medida" id="unidad_medida"
                                           value="<?php echo $value['unidad_medida'] ?>" disabled>
                                    <label for="unidad_medida">Unidad de Medida</label>
                                </div>

                                <div class="input-field col s12 m12 xl12">
                                    <i class="icon-description prefix"></i>
                                    <textarea name="descripcion" id="descripcion_servicio" cols="30" rows="10"
                                              class="materialize-textarea"
                                              disabled><?php echo $value['descripcion_servicio'] ?></textarea>
                                    <label for="descripcion">Descripción</label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-header center-align">
                            <h4>Materiales</h4>
                        </div>
                        <div class="card-content row" style="margin-bottom: 0">
                            <?php if (!empty($materiales)):
                                foreach ($materiales as $resul):?>
                                    <div class="input-field col s12 m6 xl6">
                                        <i class="icon-map prefix"></i>
                                        <input type="text" name="unidad_medida" id="unidad_medida"
                                               value="<?php echo $resul->nombre_material ?>" disabled>
                                        <label for="unidad_medida">Material</label>
                                    </div>
                                    <div class="input-field col s12 m4 xl4 ">
                                        <i class="icon-open_with prefix"></i>
                                        <input type="text" name="unidad_medida" id="unidad_medida"
                                               value="<?php echo $resul->cant_mat_servicio ?>" disabled>
                                        <label for="unidad_medida">Cantidad</label>
                                    </div>
                                    <!--                                     href="--><?php //echo Helpers::url('Servicio','deleteMaterial');
                                    ?><!--/--><?php //echo $resul->id_material
                                    ?><!--"-->
                                    <div class="input-field col s12 m2 l2 ">
                                        <a data-id="<?php echo $resul->id_material ?>"
                                           class="btn red waves-effect waves-light col s12 materiales" disabled>
                                            <i class="icon-delete right"></i>
                                        </a>
                                    </div>
                                <?php endforeach; endif; ?>
                        </div>
                        <div class="card-footer">
                            <div class="row" style="margin-bottom: 0">
                                <?php if (Helpers::hasPermissions('5', '3')): ?>
                                    <div class="col s12 m6 center-align" style="margin-bottom: 1rem">
                                        <a href="#"
                                           class="btn blue-gradient waves-effect waves-light col s12"
                                           id="modify">
                                            <i class="icon-update right"></i>
                                            Modificar
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (Helpers::hasPermissions('5', '4')): ?>
                                    <div class="col s12 m6 center-align" style="margin-bottom: 1rem">
                                        <a href="#" class="btn red-gradient waves-effect waves-light col s12"
                                           id="delete">
                                            <i class="icon-delete right"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (Helpers::hasPermissions('9', '1')): ?>
                                    <div class="col s12 m6 center-align">
                                        <a href="<?php echo Helpers::url('Servicio', 'getMateriales'); ?>/<?php echo $value['id_servicio'] ?>"
                                           class="btn green-gradient waves-effect waves-light col s12" id="addMaterial">
                                            <i class="icon-add right"></i>
                                            Añadir Material
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (Helpers::hasPermissions('9', '4')): ?>
                                    <div class="col s12 m6 center-align">
                                        <a href="#" class="btn red-gradient waves-effect waves-light col s12"
                                           id="deleteMaterial">
                                            <i class="icon-delete right"></i>
                                            Eliminar Material
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
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
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/servicio.js"></script>
<script type="application/javascript">
    localStorage.setItem('id_servicio', document.getElementById('id_servicio').value);
    $(document).ready(function () {
        var url = localStorage.getItem('url');
        $('.materiales').on('click', function (e) {
            var id = $(this).attr('data-id');
            swal({
                title: "¿Eliminar Material ?",
                text: "¿Esta seguro que desea eliminar este material Si lo hace, no podrá revertir los cambios.",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Eliminar",
                        value: true,
                        visible: true,
                        className: "red"

                    },
                    cancel: {
                        text: "Cancelar",
                        value: false,
                        visible: true,
                        className: "grey lighten-2"
                    }
                }
            }).then(function (terminar) {
                if (terminar) {
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        url: url + "Servicio/deleteMaterial",
                        data: {
                            id_material: id,
                        },
                        beforeSend: function () {
                            console.log("Sending data...");
                        },
                        success: function (data) {
                            if (data == true) {
                                swal({
                                    title: "¡Bien hecho!",
                                    text: "Se ha eliminado el material al servicio exitosamente.",
                                    icon: "success",
                                    button: {
                                        text: "Aceptar",
                                        visible: true,
                                        value: true,
                                        className: "green",
                                        closeModal: true
                                    },
                                    timer: 3000
                                }).then(redirect => {
                                    location.reload();
                                });

                            }
                        },
                        error: function (err) {
                            console.log(err);
                            swal({
                                title: "¡Oh no!",
                                text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                                icon: "error",
                                button: {
                                    text: "Aceptar",
                                    visible: true,
                                    value: true,
                                    className: "green",
                                    closeModal: true
                                }
                            });
                        }});
                } else {
                    swal({
                        text: "Acción cancelada.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            className: "blue-45deg-gradient-1"
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>