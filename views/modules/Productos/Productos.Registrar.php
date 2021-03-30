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
    <title>Registrar Producto - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Producto','index'); ?>" class="breadcrumb">Gestionar Productos</a>
                    <a href="<?php echo Helpers::url('Producto','create'); ?>" class="breadcrumb">Registrar Producto</a>

                </div>
            </div>
        </div>
        <div class="container">
            <form action="" method="post" class="row" id="register" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header center-align">
                        <h4>Registrar Producto</h4>
                    </div>
                    <div class="card-content row">
                        <div class="input-field col s12 m6">
                        <i class="icon-label prefix"></i>
                        <input id="codigo_producto" type="text" name="codigo_producto" class="validate code-only" minlength="5" maxlength="30" pattern="[A-Za-z0-9 ]+" title="Escribe el codigo del producto. max(30)" required>
                        <label for="codigo_producto">Código del Producto</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-label prefix"></i>
                        <input id="nombre_producto" type="text" name="nombre_producto" class="validate" minlength="5" maxlength="30" pattern="[A-Za-z0-9 ]+" title="Escribe el nombre del producto. max(30)" disabled required>
                        <label for="nombre_producto">Nombre del Producto</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="icon-description prefix"></i>
                        <textarea name="descripcion_producto" id="descripcion_producto" cols="30" rows="10" class="materialize-textarea" disabled></textarea>
                        <label for="descripcion_producto">Descripción</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-wc prefix"></i>
                        <select name="tipo_producto" id="tipo_producto" disabled required>
                            <option value="null" disabled selected>Elije la categoría</option>
                            <option value="ma">Masculino</option>
                            <option value="fe">Femenino</option>
                            <option value="ux">Unisex</option>
                        </select>
                        <label for="tipo_producto">Categoría del Producto</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-compare prefix"></i>
                        <input type="text" name="modelo_producto" id="modelo_producto" disabled>
                        <label for="modelo_producto">Modelo del Producto</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="costo_producto" id="costo_producto" class="validate number-only-float" min="0" pattern="[0-9]+" title="Solo puede usar números." min="0" disabled required>
                        <label for="costo_producto">Costo</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-monetization_on prefix"></i>
                        <input type="text" name="precio_producto" id="precio_producto" class="validate number-only-float" min="0" pattern="[0-9]+" title="Solo puede usar números." min="0" disabled required>
                        <label for="precio_producto">Precio</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-call_received prefix"></i>
                        <input type="number" name="stock_min_producto" id="stock_min_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números. Mínimo 24" disabled required>
                        <label for="stock_min_producto">Stock Mínimo</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-call_made prefix"></i>
                        <input type="number" name="stock_max_producto" id="stock_max_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números." disabled required>
                        <label for="stock_max_producto">Stock Máximo</label>
                    </div>
                    <div class="input-field col s12 m6 xl4">
                        <i class="icon-call_made prefix"></i>
                        <input type="number" name="stock_producto" id="stock_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números." disabled required>
                        <label for="stock_producto">Stock Disponible</label>
                    </div>
                    <div class="file-field input-field col s12 m6 xl8">
                        <div class="btn btn-rounded purple-gradient">
                            <span><i class="icon-photo_size_select_actual right"></i>Imagen</span>
                            <input type="file" name="img_producto" id="img_producto" disabled>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Elige una imagen">
                        </div>
                    </div>
                    <div class="input-field col s12 m5" id="">
                        <i class="icon-straighten prefix"></i>
                        <select name="list_id_talla" id="list_id_talla" class="list_id_talla" disabled required>

                        </select>
                        <label for="list_id_talla">Talla</label>
                    </div>
                    <div class="input-field col s10 m5">
                        <i class="icon-call_made prefix"></i>
                        <input type="number" name="list_stock_pro_talla" id="list_stock_pro_talla" class="validate" pattern="[0-9]+" title="Solo puede usar números." min="1" disabled required>
                        <label for="list_stock_pro_talla">Cantidad por Talla</label>
                    </div>
                    <div class="input-field col s2 center-align" id="add-talla">
                        <button type="button" class="btn btn-floating green-gradient waves-effect waves-light" id="btn-add-talla" disabled><i class="icon-add"></i></button>
                    </div>
                    <div id="list_tallas">
                        
                    </div>
                    </div>
                    <div class="card-footer center-align">
                        <button type="submit" class="btn btn-large btn-rounded waves-effect waves-light green-gradient">
                            Registrar 
                            <i class="icon-save right"></i>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Producto.js"></script>
</body>
</html>