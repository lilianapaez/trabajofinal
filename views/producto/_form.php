<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">  
          <?= $form->field($model, 'idproveedor')->dropDownList($model->proveedordescripcion, 
             ['prompt'=>'- Selecciona uno...']); ?>
    </div>
    <hr style="height: 2px;background-color: grey;">
    <div class="row">
     <div class="col-md-6">
          <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'preciocosto')->textInput() ?>
      <hr style="height: 2px;background-color: grey;">
      <div>
          <p><strong>La imagen puede ser opcional</strong></p>
      </div>
      <hr style="height: 1px;background-color: grey;">
     </div>
   
    
      <div class="col-md-6">
          <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','jpeg'],'showUpload' => false],
               'class'=>'custom-file-input', 
          ]);   ?>
    
      </div>
    </div>  
    <!--<?= $form->field($model, 'activado')->textInput() ?>-->
</div>
           
    
<div class="row">
    <div class="col-md-">
       <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar producto' : 'Actualizar producto', ['class' => 'btn btn-success']) ?>
       </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
    