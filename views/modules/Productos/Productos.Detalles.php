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
    <title>Detalles de Producto - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Producto','getAll'); ?>" class="breadcrumb">Consultar Productos</a>
                    <a href="<?php echo Helpers::url('Producto','details'); ?>" class="breadcrumb">Detalles</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card testimonial-card">
                <div class="card-header center-align">
                    <h4>Detalles del Producto</h4>
                </div>
                <div class="card-up primary-gradient"></div>
                <div class="avatar avatar-centered">
                    <?php if($producto->img_producto != null || $producto->img_producto != ""): ?>
                    <img src="<?php echo BASE_URL; ?>storage/productos/<?php echo $producto->img_producto; ?>" alt="" srcset="">
                    <?php else: ?>
                    <img src="<?php echo BASE_URL; ?>assets/images/cancel.png" alt="" srcset="">
                    <?php endif; ?>
                </div>
                <form action="<?php echo Helpers::url('Producto', 'update'); ?>" method="post" id="update">
                    <div class="card-content row">
                        <div class="input-field col s12 m6">
                            <i class="icon-label prefix"></i>
                            <input id="codigo_producto" type="text" name="codigo_producto" class="validate code-only" minlength="5" maxlength="30" pattern="[A-Za-z0-9 ]+" title="Escribe el codigo del producto. max(30)" value="<?php echo $producto->codigo_producto; ?>" required disabled>
                            <label for="codigo_producto">Código del Producto</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-label prefix"></i>
                            <input id="nombre_producto" type="text" name="nombre_producto" class="validate" minlength="5" maxlength="30" pattern="[A-Za-z0-9 ]+" title="Escribe el nombre del producto. max(30)" value="<?php echo Helpers::aesDecrypt($producto->nombre_producto); ?>" required disabled>
                            <label for="nombre_producto">Nombre del Producto</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="icon-description prefix"></i>
                            <textarea name="descripcion_producto" id="descripcion_producto" cols="30" rows="10" class="materialize-textarea" disabled><?php echo Helpers::aesDecrypt($producto->descripcion_producto); ?></textarea>
                            <label for="descripcion_producto">Descripción</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-wc prefix"></i>
                            <select name="tipo_producto" id="tipo_producto" required disabled>
                                <option value="null" disabled selected>Elije el tipo</option>
                                <option value="ma" <?= $producto->tipo_producto == "ma" ? 'selected' : '' ?>>Masculino</option>
                                <option value="fe" <?= $producto->tipo_producto == "fe" ? 'selected' : '' ?>>Femenino</option>
                                <option value="ux" <?= $producto->tipo_producto == "ux" ? 'selected' : '' ?>>Unisex</option>
                            </select>
                            <label for="tipo_producto">Tipo del Producto</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-compare prefix"></i>
                            <input type="text" name="modelo_producto" id="modelo_producto" value="<?= $producto->modelo_producto ?>" required disabled>
                            <label for="modelo_producto">Modelo del Producto</label>
                            
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-monetization_on prefix"></i>
                            <input type="text" name="costo_producto" id="costo_producto" class="validate number-only-float" min="0" pattern="[0-9]+" title="Solo puede usar números." value="<?php echo $producto->costo_producto; ?>" required disabled>
                            <label for="costo_producto">Costo</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-monetization_on prefix"></i>
                            <input type="text" name="precio_producto" id="precio_producto" class="validate number-only-float" min="0" pattern="[0-9]+" title="Solo puede usar números." value="<?php echo $producto->precio_producto; ?>" required disabled>
                            <label for="precio_producto">Precio</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-call_received prefix"></i>
                            <input type="number" name="stock_min_producto" id="stock_min_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números. Mínimo 24" value="<?php echo $producto->stock_min_producto; ?>" required disabled>
                            <label for="stock_min_producto">Stock Mínimo</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-call_made prefix"></i>
                            <input type="number" name="stock_max_producto" id="stock_max_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números." value="<?php echo $producto->stock_max_producto; ?>"required disabled>
                            <label for="stock_max_producto">Stock Máximo</label>
                        </div>
                        <div class="input-field col s12 m6 xl4">
                            <i class="icon-call_made prefix"></i>
                            <input type="number" name="stock_producto" id="stock_producto" class="validate" min="24" pattern="[0-9]+" title="Solo puede usar números." value="<?php echo $producto->stock_producto; ?>" required disabled>
                            <label for="stock_producto">Stock Disponible</label>
                        </div>
                        <div class="file-field input-field col s12 m6 xl8">
                            <div class="btn btn-rounded purple disabled">
                                <span><i class="icon-photo_size_select_actual right"></i>Imagen</span>
                                <input type="file" name="img_producto" id="img_producto" disabled>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Elige una imagen" value="<?php echo $producto->img_producto; ?>" disabled>
                            </div>
                            <input type="hidden" name="img_producto_name" id="img_producto_name" value="<?php echo $producto->img_producto; ?>" disabled>

                        </div>
                        <?php $valor = 0; ?>
                        <?php foreach ($pro_tallas as $key => $talla): ?>
                        <div class="input-field col s12 m6">
                            <i class="icon-straighten prefix"></i>
                            <?php $_tallas = Helpers::getTallas(); ?>
                            <select name="id_talla[]" id="talla-<?php echo $key ?>" required disabled>
                                <option value="null" disabled selected>Elije la talla</option>
                                <?php foreach ($_tallas as $_talla) : ?> 
                                <option value="<?php echo $_talla->id_talla; ?>" <?php echo $_talla->id_talla == $talla->id_talla ? 'selected' : 'disabled'; ?>><?php echo $_talla->nombre_talla; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="talla">Talla</label>
                               
                            <?php $valor += $key; ?>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-call_made prefix"></i>
                            <input type="number" name="stock_pro_talla[]" id="stock_pro_talla" class="validate" min="1" pattern="[0-9]+" title="Solo puede usar números. Mínimo 24" value="<?php echo $talla->stock_pro_talla; ?>" required disabled>
                            <label for="stock_pro_talla">Cantidad por Talla</label>
                        </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="key" id="key" value="<?php echo $key; ?>">
                    </div>
                    <div class="card-footer">
                        <div class="row" style="margin-bottom: 0">
                            <?php if (Helpers::hasPermissions('2','3')): ?>
                            <div class="col s12 m6 center-align" id="modify-btn">
                                <a id="modify" class="btn btn-large btn-rounded blue-gradient waves-effect waves-light col s12">
                                    <i class="icon-update left"></i>                        
                                    Modificar
                                    <i class="icon-update right"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <!-- <br class="show-on-down-only"> -->
                            <?php if (Helpers::hasPermissions('2','4')): ?>
                            <div class="col s12 m6 center-align" id="delete-btn">
                                <a id="delete" class="btn btn-large btn-rounded red-gradient waves-effect waves-light col s12">
                                    <i class="icon-remove left"></i>                        
                                    Eliminar
                                    <i class="icon-remove right"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="col s12 center-align" style="display: none" id="update-btn">
                                <button type="submit" class="btn btn-large btn-rounded green-gradient waves-effect waves-light col s12">
                                    <i class="icon-save left"></i>
                                    Actualizar
                                    <i class="icon-save right"></i>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Producto.js"></script>
</body>
</html>