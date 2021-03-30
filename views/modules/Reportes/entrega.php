<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte Pedidos</title>
    
     <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
  </head>
  <body class="grey lighten-4">
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo BASE_URL; ?>assets/images/brand-logo.jpg">
      </div>
      <div id="company">
      <h1 class="name">Inversiones A2</h1>
        <div>Carrera 18 esp. Calle 36 C.C San Juan Local N°7 </div>
        <div>04145030244 - 04149517382</div>
        <div>@A2VZLA</div>
        <div>inversionesa2@gmail.com</div>

      </div>
      </div>
    </header>
    <main>
    <main>
     <div id="details" class="clearfix">
        <div id="client">
          <div class="to">REPORTE A FECHA:</div>
          <h2 class="name">
            <?php echo date('d/m/Y');?></h2>
        </div>
        <div id="invoice">
          <h1>Entregas Realizadas</h1>
        </div>
      </div>
      <?php if (empty($allPedido)){ ?>
      <h2 class="center-align">No Hay Ningún Pedido Registrado Aún.</h2>
        <?php }else ?>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">COD</th>
            <th class="desc">CLIENTE</th>
            <th class="unit">ENTREGA</th>
            <th class="qty">PEDIDO</th>
            <th class="total">STATUS</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($allPedido as $pedido): ?>
            <?php if(Helpers::aesDecrypt($pedido->status_pedido) == 'Entregado' || Helpers::aesDecrypt($pedido->status_pedido) == 'entregado'){?>
          <tr>
            <td class="no"><?php echo Helpers::aesDecrypt($pedido->codigo_pedido)?></td>
            <td class="desc">
              <h3><?php echo Helpers::aesDecrypt($pedido->nombre_cliente)?></h3>
            <?php echo Helpers::aesDecrypt($pedido->representante_cliente)?> - <?php echo Helpers::aesDecrypt($pedido->telefono_cliente)?></td>
            <td class="unit"><?php echo date("d/m/Y", strtotime($pedido->fecha_entrega_pedido))?></td>
            <td class="qty"><?php echo $pedido->descripcion_pedido?></td>
            <td class="total"><?php echo Helpers::aesDecrypt($pedido->status_pedido)?></td>
            
          </tr>
          <?php }else?>
            <h3 class="center-align">No Hay Ningún Pedido Entregado</h3>

          
          <?php endforeach;?>
          
        </tbody>
      </table>
      
    </main>
    
  </body>
</html>