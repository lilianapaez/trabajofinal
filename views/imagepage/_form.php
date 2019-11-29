<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Imagepage */
/* @var $form yii\widgets\ActiveForm */
$var = [ 0 => 'si', 1 => 'no'];
?>

<div class="imagepage-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'idcatalogo')->dropDownList($model->catalogodescripcion, 
             ['prompt'=>'- Selecciona uno...']); ?>
  </div>

<div class="col-md-6">
    <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','jpeg'],'showUpload' => false],
               'class'=>'custom-file-input', 
          ]);   ?>
    <!--<?= $form->field($model, 'tieneproducto')->dropDownList($var, ['prompt' => 'Selecciona uno...' ]) ?>-->
    
    <?= $form->field($model, 'numeropage')->textInput(['placeholder'=>'Solo números']) ?>
<hr style="height: 1px;background-color: red;">
    
   <div class="row">
        <div class="col-md-12 text-center">
             <?= $form->field($model, 'tieneproducto')->radioList([0 => 'SI', 1 => 'NO'], 
             ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-danger']]])?>
       </div>  
    </div>    
    <hr style="height: 1px;background-color: red;">
     <div class="form-group text-center">
        
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success']) ?>
        
     </div>
     
    <?php ActiveForm::end(); ?>

   </div>
  </div>
</div>
<?php
//js que controla la visualizacion del pass
/*$this->registerJs("$('#radiolist input').change(function() {
    var valorestrella = $('#radiosel input').val();
    alert(valorestrella);
    if(valorestrella){
        $('#radio1').css('display','block');
        
    }else{
        $('#radio2').css('display','block');
    }
  });");

  $this->registerJs("$('input[name='Imagepage[tieneproducto]']').on('click', function() {
     if ($(this).val() == 0) {
        $('#radio1').css('display','block');
        
    }
    if ($(this).val() == 1) {
       
            $('#radio2').css('display','block');
        
        
    }
});");*/

 
?>
