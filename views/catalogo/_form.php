<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Catalogo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalogo-form catalogo-container">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
         <div class="col-md-5">
           <p><span> Aca se puede escribir un mansaje como: AL FIN SE PUEDE CARGAR LA IMAGEN.....</span></p>
         </div>
         <div class="col-md-2"> 
         </div>
         <div class="col-md-5">
          <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','jpeg'],'showUpload' => false],
          ]);   ?>
          </div>
    </div>
    <div class="row">
         <div class="col-md-5">
          <?= $form->field($model, 'numeropagecat')->textInput(['placeholder'=>'Solo números']) ?>

         </div>
         <div class="col-md-2"> 
         </div>
         <div class="col-md-5">
            <?= $form->field($model, 'campania')->textInput(['maxlength' => true,'placeholder'=>'Ej.:nn-nnnn']) ?>
         </div>
    </div>
    <div class="row">
        <div class="col-md-5">
         <?php
            echo $form->field($model, 'fechadesde')->widget(DatePicker::classname(), [
                  'options' => ['placeholder' => 'Fecha inicio campaña ...'],
                  'pluginOptions' => [
                  'autoclose'=>true,
                  'format' => 'yyyy-mm-dd'
                  ]
           ]);?>
        </div>
        <div class="col-md-2"> 
        </div>
        <div class="col-md-5">
          <?php
            echo $form->field($model, 'fechahasta')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha fin campaña  ...'],
            'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
           ]
         ]);?>
        </div>
    </div>
    <div class="row">
         <div class="col-md-5">
            <?= $form->field($model, 'idmarca')->dropDownList($model->marcadescripcion, 
             ['prompt'=>'- Selecciona uno...']); ?>
            </div>
         <div class="col-md-2"> 
         </div>
         <div class="col-md-5">
            <?= $form->field($model, 'idcategoria')->dropDownList($model->categoriadescripcion, 
             ['prompt'=>'- Selecciona uno...']); ?>
         </div>
    </div>
    <!--<?= $form->field($model, 'vigente')->textInput() ?>-->
    <div class="form-group text-center">
        <?= Html::submitButton('Ingresar catálogo', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
