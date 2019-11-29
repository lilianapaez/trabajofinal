<?php
    $pedido= \app\models\Pedido::find()->where(['idpedido' => $model->idpedido])->one();

    $pedidoproducto = \app\models\PedidoProducto::find()->where(['idpedido' => $pedido->idpedido])->all();

    ?>

<div style="display: inline-block;
     width: 85%;
     margin: 10px;
     border: 1px solid #ccc;
     ">
    <div style="width: 100%;*zoom: 1;">
        <div style="padding: 15px 5px;height: 65px;width: auto;background-color: #3398d4;">

        </div>
    </div>
    <div style="margin: 5px;"></div>
    <div style="width: 100%;*zoom: 1;">
        <div style="margin:10px 0;padding: 5px;">
            <span style="margin-top:20px;margin-bottom:10px;font-family:inherit;font-weight:bold;line-height:1.1;color:#444;font-size: 18px;"> Request For Proposal</span><br><br>
        </div>
    </div>
    <div style="width: 100%;*zoom: 1;">
        <div style="padding: 5px;">
             <p  class="text-center" style="text-align:justify">Subject : <?php echo $model->nombrecomprador;
                                                ?></p>
                                                <br/>
            <p style="text-align:justify;">Dear <?php 
                                              foreach ($pedidoproducto as $key ) {
                                                 echo  $key ." ". "/" ;                                              }
                                                ?>,</p> <br/>
            <p style="text-align:justify;"> <?php echo $pedidoproducto->cantidadproducto ?><br>


          <table class="table table-hover table-striped table-bordered table-condensed">
            <thead>
                   <tr>
                    <th class="text-center">Item</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Unit</th>
                </tr>
            </thead>
            <?php
             foreach ($pedidoproducto as $each) {
                    $typ = $each->nrodetalle;
                   if ($typ == 1)
               {
               //$model = \app\models\RawMaster::findOne(['id'=>$each['item']])->raw_name;


               }
               elseif ($typ ==2)
               {
               //$model = \app\models\AssetMaster::findOne(['id'=>$each['item']])->asset_name;
               }
               elseif ($typ == 3) {
             //$model = \app\models\MachineMaster::findOne(['id'=>$each['item']])->name;
               }

                ?>
            <tbody>
              <tr>
                <td> <?= $model;?></td>
                <td><?= $each['cantidadproducto']?></td>
                <td><?= $each['preciopublico'] ?></td>
            </tr> 

        </tbody>
        <?php }
        ?>
    </table>

     <p style="text-align:justify;">
                Thank you.<br>
            </p>
        </div>
    </div>
    <div style="width: 100%;*zoom: 1;">
        <div style="padding: 5px;">
            <br>
            <p style="text-align:justify;color:#777">If you want to  unsubscribe <a href="">click here</a></p>
            <p style="font-size: x-small;text-align:justify;color:#777">
                This e-mail and any files transmitted with it may contain privileged or confidential information.
                It is solely for use by the individual for whom it is intended, even if addressed incorrectly. If you received this e-mail in error, please notify the sender; do not disclose, copy, distribute, or take any action in reliance on the contents of this information; and delete it from your system.
                Any other use of this e-mail is prohibited.

                Thank you for your compliance.

                Copyright © 2019 by All rights reserved.
            </p>

        </div>
    </div>

</div>
</div>