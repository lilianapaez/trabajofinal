<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Usuario;
use kartik\widgets\TypeaheadBasic;


/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
$usuario=Usuario::find(['idusuario'=>$_SESSION['__id']])->one();
//$idvendedor=$usuario->idusuario;
$idvendedor=$usuario->nombre;
$idcatalogo=$model->idcatalogo;
?>

<div class="pedido-form pedido-container">
 
     <div class="col-md-5">
      <div class="row text-center">
        <h3><?= Html::encode('Catálogo de referencia') ?></h3> 
         <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            'idcatalogo',
            ['label'=>'Imagen catalogo',
            'attribute'=>'imagencatalogo',
            'format'=>'html',
            'value'=>function($model){
                return yii\bootstrap\Html::img($model->imagencatalogo,['width'=>'200']); 
            },
           ],
            'campania',
            [ 'attribute' => 'fechadesde',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],          
            [ 'attribute' => 'fechahasta',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],    
            'numeropagecat',
            
            [
                'attribute' => 'idmarca',
                 'value' => function($model) {
                     return ($model->marca->nombremarca);
                 }
               ],
            [
                'attribute' => 'idcategoria',
                 'value' => function($model) {
                     return ($model->categoria->descripcioncategoria);
                 }
               ],
            ],
         ]) ?>
        </div>
        <div class="row"><br></div>
    </div>
<?php $form = ActiveForm::begin(); ?>
 <div class="col-md-1"></div>
    <div class="container si-label">
      <div class="col-md-6">
                <div class="row">
                <h1 class="text-center"><?= Html::encode('Vendedor: '.$idvendedor) ?></h1>
                  <h3><?= Html::encode('Tu pedido') ?></h3>
                     <?= $form->field($model1, 'nombrecomprador')->textInput(['maxlength' => true,'placeholder'=>'Nombre completo del comprador']) ?>

                     <?= $form->field($model1, 'telcelcomprador')->textInput(['maxlength' => true,'placeholder'=>'Cel o telefono del comprador']) ?>

                     <?php
                      echo $form->field($model1, 'fechapedido')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Fecha pedido ...'],
                        'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-mm-yyyy'
                        ]
                 ]);
                     if (!$model1->isNewRecord)
                           echo $form->field($model1, 'fechapedido')->textInput(['placeholder'=>'Formato dd-mm-aaaa']);
                     ?>
                
                </div>
                    <?= $form->field($model1, 'idvendedor')->textInput(['value'=>$usuario->idusuario,'style'=>'display:none'])->label(false); ?>
                    <?= $form->field($model1, 'idcatalogo')->textInput(['value'=>$idcatalogo,'style'=>'display:none'])->label(false); ?>


    
                <hr style="height: 2px;background-color: grey;">

                <div class="form-group text-center">
                        <?= Html::submitButton($model1->isNewRecord ? 'Ingresar productos' : 'Actualizar', ['class' => 'btn btn-success btn-grande']) ?>
                </div>
                     
<?php ActiveForm::end(); ?>
                           
      </div>
    </div>
         
       
 
</div>
