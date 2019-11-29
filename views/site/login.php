<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesion';

?>
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd1 si-label text-center" >
      <img class="text-center" src="assets/img/directsale.png" alt="logo direct sale venta por catalogo">
      <h2><strong><?= Html::encode($this->title) ?></strong></h2>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    
        ]);
        ?>
       
        <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingresa tu DNI','autofocus' => true, 'class' => 'form-control']) ?>
        
         <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ingresa tu contraseña','class' => 'form-control '])?>
            <p class="text-center">
               <strong><?= Html::a('Olvidaste tu contraseña?', ['site/recupass']) ?></strong> 
            </p>

        <div class="form-group">
            <?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-grande btn-rounded btn-primary submitbutton width-100', 'name' => 'login-button']) ?>
        </div>
            <p class="text-center">
            <strong> <?= Html::a('No estas registrado? REGISTRATE!', ['site/registro']) ?> </strong>
            </p>
            <?php ActiveForm::end(); ?>
    </div>
</div>

