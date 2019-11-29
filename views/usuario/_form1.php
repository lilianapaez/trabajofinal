

<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
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
             <p  class="text-center" style="text-align:justify">Subject : </p>
                                                <br/>
           


          
            
            <?php
             foreach ($dataProvider as $key=> $dato) {
                    $zona = $dato->idzona;
              if ($zona == 1) {
                 if($dato->idrol==4){
                     $lider=$dato->imagenperfil;
                     $nombrelider=$dato->nombre;
                     $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                     $cellider=$cel->telefono1;?>
                     <table class="table table-hover table-striped table-bordered table-condensed">
                     <thead>
                     <tr>
                    <th style="width: 10%;" class="text-center"> <?= Html::img('@web/'.$dato->imagenperfil, ['alt' => 'My perfil','style'=>'width:80px;border-radius:100%;']); ?>
                                    </th>
                   </tr>
                  </thead>
                  <tbody>
                    <tr>
            <?php }elseif($dato->idrol==1){
                    $vendedor=$dato->imagenperfil;
                    $nombrevendedor=$dato->nombre;
                    $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                    $celvendedor=$cel->telefono1;?>
                    <td style="width: 10%;" class="text-center"> <?= Html::img('@web/'.$dato->imagenperfil, ['alt' => 'My perfil','style'=>'width:80px;border-radius:100%;']);?></td>
               <?php }?>
                 
                 <?php }elseif ($zona ==2){
                if($dato->idrol==4){
                    $lider=$dato->imagenperfil;
                    $nombrelider=$dato->nombre;
                    $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                    $cellider=$cel->telefono1;
                }elseif($dato->idrol==1){
                   $vendedor=$dato->imagenperfil;
                   $nombrevendedor=$dato->nombre;
                   $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                   $celvendedor=$cel->telefono1;
                }
               }elseif ($zona == 3) {
                if($dato->idrol==4){
                    $lider=$dato->imagenperfil;
                    $nombrelider=$dato->nombre;
                    $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                    $cellider=$cel->telefono1;
                }elseif($dato->idrol==1){
                   $vendedor=$dato->imagenperfil;
                   $nombrevendedor=$dato->nombre;
                   $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                   $celvendedor=$cel->telefono1;
                }
               }elseif ($zona == 4) {
                if($dato->idrol==4){
                    $lider=$dato->imagenperfil;
                    $nombrelider=$dato->nombre;
                    $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                    $cellider=$cel->telefono1;
                }elseif($dato->idrol==1){
                   $vendedor=$dato->imagenperfil;
                   $nombrevendedor=$dato->nombre;
                   $cel=\app\models\Telefono::findOne(['idtelefono'=>$dato->idtelefono]);
                   $celvendedor=$cel->telefono1;
                }
                  }
                ?>
        
        <?php }
        ?>
   

     <p style="text-align:justify;">
                Thank you.<br>
            </p>
        </div>
    </div>
    
    </div>

</div>
</div>