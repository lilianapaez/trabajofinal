
<?php

use yii\helpers\Html;

    $pedido= \app\models\Pedido::find()->where(['idpedido' => $model->idpedido])->one();
    $vendedor= \app\models\Vendedor::find()->where(['idvendedor' => $model->idvendedor])->one();
    $usuario=\app\models\Usuario::find()->where(['idusuario' => $vendedor->idvendedor])->one();
    $telefono=\app\models\Telefono::find()->where(['idtelefono' => $usuario->idtelefono])->one();
    $pedidoproducto = \app\models\PedidoProducto::find()->where(['idpedido' => $pedido->idpedido])->all();

    
echo Html::a('Generado', ['/pedido/pdfremito','id' => $model->idpedido], [
    'class'=>'btn btn-danger', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Will open the generated PDF file in a new window'
]);
?><div class="row">

<div style="width: 100%;margin: 10px;">
    
        <div style="height: 115px;background-color: #DFDCDB;">
          
        <table class="table  table-condensed table-responsive">
              <tr>
                <td colspan="4" style="text-align:left;background-color: #DFDCDB;"><img src="assets/img/logo-direct-sale-140.png" style="padding: 5px 50px;"></td>
                         <td style="text-align:left;font-weight:bold;font-size: 20px;background-color: #DFDCDB;">Remito NRO: 0000<?php echo $model->idpedido; ?> <br>
                         <span style="font-weight:bold;font-size: 15px;">Direccion: Alderete 100 <br>
                                                                         Tel-Cel: 299-6222888 <br>
                                                                         Email: directpresale@gmail.com</span>   
                </td>
            </tr>
        </table> 
    
        <div style="margin: 5px;"></div>
    
        
    </div>
    <br><br>
    <div style="width: 100%;*zoom: 1;">
        <div style="padding: 5px;">
             <p  class="text-center" style="text-align:justify;font-weight:bold;font-size: 20px;">Comprador : <?php echo $model->nombrecomprador; ?></p>
             <p  class="text-center" style="text-align:justify;font-weight:bold;font-size: 20px;">Celular o telefono : <?php echo $model->telcelcomprador; ?></p>
            <br/><br/>
            <p style="text-align:justify;"> <?php echo '' ?>
            <br/>

          <table class="table table-hover table-striped table-bordered table-condensed table-responsive text-center" style="border-color:#71274a;">
            <thead>
                   <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Unitario</th>
                    <th class="text-center">Precio</th>
                </tr>
            </thead>
            <?php
             $suma=0;
             foreach ($pedidoproducto as $cada) {
                
               $producto = \app\models\Producto::findOne(['idproducto'=>$cada['idproducto']]);
              $suma=$suma + ($cada['preciopublico'] * $cada['cantidadproducto']);
            ?>
            <tbody>
              <tr>
                
                <td><?= $producto['codigo']?></td>
                <td><?= $producto['descripcion']?></td>
                <td><?= $cada['cantidadproducto']?></td>
                <td><?= $cada['preciopublico'] ?></td>
                <td><?= ($cada['preciopublico'] * $cada['cantidadproducto']) ?></td>
              </tr> 
              <tr>
                <td colspan="4" style="text-align:right;font-weight:bold;font-size: 18px;background-color: #DFDCDB;"><?= 'Total $' ?></td>
                <td style="text-align:center;font-weight:bold;font-size: 18px;background-color: #DFDCDB;"><?= $suma ?></td>
              </tr> 
            </tbody>
        <?php } ?>
        </table>
        <br/><br/><br/><br/>
       
          <div style="padding: 0px;">
             <p  style="text-align:justify;font-weight:bold;line-height:1.1;">Tu vendedor es: <?php echo $usuario->nombre; ?></p>
             <p  style="text-align:justify;font-weight:bold;line-height:1.1;">Celular o telefono : <?php echo $telefono->telefono1; ?></p>
             <p style="text-align:justify;font-weight:bold;line-height:1.1;font-size: 18px;">Gracias por tu compra.</p>
          </div>
       
    </div>
    
        <div style="padding: 5px;">
            <br>
            <p style="font-size: x-small;text-align:justify;color:#777">
                Comentarios de la condicion de pago dy entrega de los productos
                Copyright © 2019 by All rights reserved.
            </p>  
        </div>
   </div>
</div>