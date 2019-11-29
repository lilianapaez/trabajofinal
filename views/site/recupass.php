<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Recuperar Contraseña';

?>
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd1 si-label" align="center">
      <img class="center" src="assets/img/directsale.png" alt="logo color">
        <h4><strong><?= Html::encode($this->title) ?></strong></h4>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'recupass-form',
                    'layout' => 'horizontal',
                    
        ]);
        ?>
         
         <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Tu dni, solo números','autofocus' => true, 'class' => 'form-control']) ?>
         
         <?= $form->field($model, 'email',['inputOptions' => ['class' => 'form-control']])
            ->textinput(['placeholder'=>'Ingresa tu email'])?>
            
             
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-10">
               <?= Html::submitButton('Recuperar', ['class' => 'btn btn-grande btn-rounded btn-primary submitbutton width-100', 'name' => 'recupass-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->session->hasFlash('registroFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
           Enviamos un mensaje a tu correo, ábrelo y encontrarás una contraseña temporal."
        </div>
        <?php endif; ?>
    </div>
    
</div>
  
