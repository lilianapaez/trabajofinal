<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CambiapassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar Contraseña';

$usu=Yii::$app->user->identity->dni;
?>
<div class="site-cambiapass">
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd1 si-label" align="center">
      <img class="center" src="assets/img/directsale.png" alt="logo color">
        <h4><strong><?= Html::encode($this->title) ?></strong></h4>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'cambiapass-form',
                    'layout' => 'horizontal',
                    
        ]);
        ?>
     
     <?= $form->field($model, 'dni')->textInput(['value'=>$usu,'readonly'=> true]) ?>
     <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Contraseña']) ?>
     <?= $form->field($model, 'nuevo_password')->passwordInput(['placeholder'=>'Nueva contraseña']) ?>
     <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repite la nueva contraseña']) ?>
    <div class="form-group">
        <div class="col-lg-12">
           <?= Html::submitButton('Cambiar', ['class' => 'btn btn-grande btn-rounded btn-primary submitbutton width-100', 'name' => 'cambiarpass-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
  </div>
</div>
<?php

//js que controla la visualizacion del pass

/*$this->registerJs("$('.toggle-password').click(function() {

    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));
    if (input.attr('type') == 'password') {
      input.attr('type', 'text');
    } else {
      input.attr('type', 'password');
    }
  });");*/

?>
