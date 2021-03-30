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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/datatables.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Auditoria - Inversiones A2</title>
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
                <a href="<?php echo Helpers::url('Seguridad','index'); ?>" class="breadcrumb">Seguridad</a>
                <a href="#" class="breadcrumb">Auditoría</a>
            </div>
            <div class="col s12">
                <div class="card">
                    <div class="card-header center-align">
                        <h4>Consultar Tablas Auditoría</h4>
                    </div>
                    <div class="card-content row">
                        <div class="col s12" style="padding:30px">
                            <table class="centered striped" id="audit" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Nombre de la Tabla</th>
                                    <th>Detalles</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($query != null): ?>
                                    <?php foreach($query as $query):?>
                                        <tr>
                                            <td><?php echo $query->tablename; ?></td>
                                            <td>
                                                <a href="<?php echo Helpers::url('Auditoria','getTable')."/".substr($query->tablename, 7 )?>" class="btn btn-floating pink-gradient waves-effect effect-light"><i class="icon-pageview"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php require_once "views/layouts/footer.php"; ?>


<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>

<script>
    $('#audit').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay registros",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "<i class='icon-navigate_next'></i>",
                "sPrevious": "<i class='icon-navigate_before'></i>"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
</script>

</body>
</html>