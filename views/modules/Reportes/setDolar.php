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
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title>Consultar Pedidos - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Factura','FactuIndex'); ?>" class="breadcrumb">Facturación de Ventas</a>
                    <a href="<?php echo Helpers::url('Factura','setDolar'); ?>" class="breadcrumb">Facturación en Bolivares</a>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="card">
                    <form action="<?php echo Helpers::url('Reporte','facturaBolivares')."/".$id ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $id?>"> 
                        <div class="card-header">
                            <h4 class="center-align">Precio del Dolar</h4>          
                        </div>
                        <div class="card-content row">
                            <div class="input-field col s12">                     
                                <i class="icon-attach_money prefix"></i>
                                <input type="number" id="dolar" name="dolar" value="" class="validate" required>
                                <label for="dolar">Precio Dolar Actual en Bolivares</label>
                            </div>
                        </div>
                        <div class="card-footer center-align">
                            <button type="submit" class="btn-large waves-effect waves-light green-gradient btn-rounded"><i class="icon-money_off left"></i>Imprimir PDF</a></button>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Pedido.js"></script>
</body>
</html>
