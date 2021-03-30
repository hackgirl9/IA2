<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
                <a href="<?php echo Helpers::url('Pedido', 'index'); ?>" class="breadcrumb">Gestionar Pedidos</a>
                <a href="<?php echo Helpers::url('Pedido', 'getAll'); ?>" class="breadcrumb">Consultar Pedidos</a>
                <a href="<?php echo Helpers::url('Pedido', 'details'); ?>" class="breadcrumb">Detalles</a>
            </div>
        </div>
    </div>
    <div class="container">
    
        <div class="card">
            <div class="card-header">
                <h5 class="center-align">Detalles del Pedido</h5>

            </div>
            <div class="card-content row">
                <div class="input-field col s12 m6">
                    <i class="icon-person prefix"></i>
                    <input type="text" name="cedula_cliente" id="cedula_cliente" class="validate" minlength="5"
                            maxlength="15" pattern="[VvJjEe0-9]+"
                            title="Solo puede usar números del 0-9 y V, J ó E"
                            value="<?php echo $pedido->cedula_cliente; ?>" required readonly>
                    <label for="cedula_cliente">Cedula o RIF del Cliente</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="icon-person prefix"></i>
                    <input type="text" name="nombre_cliente" id="nombre_cliente" class="validate" minlength="5"
                            maxlength="15" pattern="[VvJjEe0-9]+" title="Solo puede usar números del 0-9 y V, J ó E" required disabled
                            value="<?php echo Helpers::aesDecrypt($pedido->nombre_cliente); ?>">
                    <label for="nombre_cliente">Nombre</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="icon-person prefix"></i>
                    <input type="text" name="representante_cliente" id="representante_cliente" class="validate"
                            minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                            title="Solo puede usar números del 0-9 y V, J ó E" required
                            value="<?php echo $pedido->representante_cliente; ?>" disabled>
                    <label for="representante_cliente" >Representante</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="icon-phone prefix"></i>
                    <input type="text" name="phone" id="phone" class="validate"  pattern="[VvJjEe0-9]+"
                        title="Solo puede usar números del 0-9 y V, J ó E" required
                        value="<?php echo Helpers::aesDecrypt($pedido->telefono_cliente); ?>" disabled>
                    <label for="phone" >Teléfono</label>
                </div>
            </div>
            <div class="card-content row">
                <div class="input-field col s12 m4">
                        <i class="icon-person prefix"></i>
                        <input type="text" name="codigo_pedido" id="codigo_pedido" class="validate"
                               minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                               title="Solo puede usar números del 0-9 y V, J ó E" required readonly
                               value="<?php echo $pedido->codigo_pedido; ?>">
                        <label for="codigo_pedido" >Codigo Pedido</label>
                    </div>

                    <div class="input-field col s12 m4">
                        <i class="icon-insert_invitation prefix"></i>
                        <input type="text" name="fecha_pedido" id="fecha_pedido" readonly
                               value="<?php echo $pedido->fecha_pedido; ?>">
                        <label for="fecha_pedido">Fecha del Pedido</label>
                    </div>

                    <div class="input-field col s12 m4">
                        <i class="icon-event_available prefix"></i>
                        <input type="text" name="fecha_entrega_pedido" id="fecha_entrega_pedido" class="datepicker"
                               value="<?php echo $pedido->fecha_entrega_pedido; ?>">
                        <label for="fecha_entrega_pedido">Fecha de Entrega</label>
                    </div>
                <div class="input-field col s12 m6">
                    <i class="icon-message prefix"></i>
                    <select name="status_pedido" id="status_pedido">
                        <option value="null" selected>Selecione una opción</option>
                        <option value="En Proceso" <?php if(Helpers::aesDecrypt($pedido->status_pedido)==='En Proceso'): echo "selected"; endif; ?> >En Proceso</option>
                        <option value="Cancelado"  <?php if(Helpers::aesDecrypt($pedido->status_pedido)==='Cancelado'): echo "selected"; endif; ?> >Cancelado</option>
                        <option value="Facturado"  <?php if(Helpers::aesDecrypt($pedido->status_pedido)==='Facturado'): echo "selected"; endif; ?> >Facturado</option>
                        <option value="Entregado"  <?php if(Helpers::aesDecrypt($pedido->status_pedido)==='Entregado'): echo "selected"; endif; ?> >Entregado</option>
                    </select>
                    <label for="id_tela">Estado del pedido</label>
                </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-description prefix"></i>
                        <textarea name="descripcion_pedido" id="descripcion_pedido"
                                  class="materialize-textarea"><?php echo $pedido->descripcion_pedido; ?></textarea>
                        <label for="descripcion_pedido">Descripción</label>
                    </div>
            </div>
            <?php if($servicios!=null):?>
            <div class="card-header">
                <h5 class="center-align">SERVICIOS</h5>
            </div>
            <div class="card-content row">
                <?php foreach ($servicios as $servicio): ?>
                        <input type="hidden" name="id_servicio[]" value="<?php echo $servicio->id_servicio; ?>">
                        <div class="input-field col s12 m4">
                            <i class="icon-plus_one prefix"></i>
                            <input type="text" name="nombre_servicio" id="nombre_servicio"
                                   class="validate" pattern="" title=""
                                   value="<?php echo $servicio->nombre_servicio; ?>" disabled>
                            <label for="nombre_servicio">Nombre Servicio</label>
                        </div>


                        <div class="input-field col s12 m4">
                            <i class="icon-plus_one prefix"></i>
                            <input type="number" name="cantidad_prenda[]" id="cantidad_prenda"
                                   class="validate" pattern="[0-9]+" min="1" title="Solo puede usar números."
                                   value="<?php echo $servicio->cantidad_prenda; ?>">
                            <label for="cantidad_prenda">Cantidad de Prendas</label>
                        </div>

                        <div class="input-field col s12 m4">
                            <i class="icon-star_border prefix"></i>
                            <input type="number" name="cantidad_medida[]" id="cantidad_medida"
                                   class="validate" pattern="[0-9]+" min="1" title="Solo puede usar números."
                                   value="<?php echo $servicio->cantidad_medida; ?>">
                            <label for="cantidad_prenda">Cantidad de Medida</label>
                        </div>

                        <div class="input-field col s12 m6">
                            <i class="icon-star_border prefix"></i>
                            <input type="number" name="precio_servicio_${name_str}" id="precio_servicio"
                                   class="validate" pattern="[0-9]+" title="Solo puede usar números."
                                   value="<?php echo $servicio->precio_servicio; ?>" disabled>
                            <label for="cantidad_prenda">Precio Servicio</label>
                        </div>


                        <div class="input-field col s12 m6">
                            <select name="id_tela[]" id="tela">
                                <?php foreach ($telas as $tela): ?>
                                    <?php if($tela->id_tela===$servicio->id_tela):?>
                                    <option value="<?php echo $tela->id_tela; ?>" selected><?php echo $tela->nombre_tela; ?></option>
                                    <?php else:?>
                                        <option value="<?php echo $tela->id_tela; ?>" ><?php echo $tela->nombre_tela; ?></option>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_tela">Telas</label>
                        </div>
                    <?php endforeach; ?>
            </div>
            <?php endif;?>
            <?php if($productos!=null):?>
            <div class="card-header">
                <h5 class="center-align">PRODUCTOS</h5>
            </div>
            <div class="card-content row">
                <table class="centered highlight responsive-table">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Talla</th>
                        <th>Precio</th>

                        <th>Cantidad Pedida</th>
                    </tr>
                    </thead>
                    <tbody id="productos_select" class="center-align" >
                    <?php foreach ($productos as $producto): ?>
                        <input type="hidden" name="codigo_producto[]" value="<?php echo $producto->codigo_producto;?>">
                        <tr>
                            <th><?php echo $producto->codigo_producto; ?></th>
                            <th><?php echo $producto->nombre_producto; ?></th>
                            <th><?php echo $producto->nombre_talla; ?></th>
                            <th><?php echo $producto->precio_producto; ?></th>
                            <th><input type="number" name="cant_producto_pedido[]" class="col center-align cant_producto_pedido"  min="1"  readonly value="<?php echo $producto->cant_pro_pedido; ?>"></th>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif;?>
            <div class="card-footer row">
                <div class="input-field col s12 m6 center-align">
                        <button type="submit" href="#!" class="btn blue waves-effect waves-light col s12" id="modify">
                            <i class="icon-update right"></i>
                            Modificar
                        </button>
                    </div>
                    <div class="input-field col s12 m6 center-align">
                        <a href="#" class="btn red waves-effect waves-light col s12" id="delete">
                            <i class="icon-delete right"></i>
                            Eliminar
                        </a>
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
<?php if(isset($_SESSION['message'])&&$_SESSION['message']===true):?>
    <script>
        swal({
            title: "¡Bien hecho!",
            text: "Pedido actualizado con éxito.",
            icon: "success",
            button: {
                text: "Aceptar",
                visible: true,
                value: true,
                className: "green",
                closeModal: true
            },
            timer: 3000
        });
    </script>
    <?php Helpers::messageError('message');endif; ?>


<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Pedido.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/validations.js"></script>
</body>
</html>
