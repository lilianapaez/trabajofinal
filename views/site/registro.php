<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;
use app\models\Usuario;
use app\models\Rol;
use app\models\Ciudad;
use app\models\Provincia;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\RegistroForm */

$this->title = 'Registrate ';
?>
<section id="registro" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
<div class="registro-container">
   <div class="box-bd2 " align="center"> 
     <img class="center" src="assets/img/directsale.png" alt="logo empresa">
     <h4><strong><?= Html::encode($this->title) ?></strong></h4>
        </div>
        <br>
     
        <?php $form = ActiveForm::begin([
        'id' => 'registro-form',
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data']
         ]); ?>
        <div class=" row si-label">
            <div class="col-md-6 col-xs-12">

                <?= $form->field($model, 'nombre')->textInput(['placeholder'=>'Nombre','autofocus' => true]) ?>
                <?= $form->field($model, 'apellido')->textInput(['placeholder'=>'Apellido','autofocus' => true]) ?>
                <?= $form->field($model, 'dni')->textInput(['placeholder'=>'DNI solo números','autofocus' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email','autofocus' => true]) ?>
                <?= $form->field($model, 'direccion')->textInput(['placeholder'=>'Direccion','autofocus' => true]) ?>

                <?= $form->field($model, 'idprovincia')->widget(Select2::classname(), [
                    'data' => $model->provinciadescripcion,
                    'id'=>'idprovincia',
                    'options' => [
                    'value' => '25',
                    'placeholder' => 'Selecciona una provincia...',
                    'id'=>'idprovincia']
                     ])->label('Provincia '); ?>

                <?= $form->field($model, 'idciudad')->widget(DepDrop::classname(), [
                     'type' => DepDrop::TYPE_SELECT2,
                     'value' => '4634',
                     'pluginOptions'=>[
                     'initialize' => true,
                     'placeholder' => 'Selecciona una ciudad...',
                     'depends'=>['idprovincia'],
                     'url'=>Url::to(['ciudad/ciudad']),
                     'loadingText' => 'Cargando ciudad...']
                    ])->label('Ciudad ');?>

                <?= $form->field($model, 'nick')->textInput(['placeholder'=>'Tu nick','autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Contraseña']) ?>

                <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repetir contraseña']) ?>
                <?php
            if ($model->isNewRecord){ 
               echo $form->field($model, 'idgenero')->inline()->radioList(['1'=>'Femenino','2'=>'Masculino','3'=>'Otro'],
                      ['separator' => '   ', 'tabindex' => 3])->label('Genero');
            }else{
              echo $form->field($model, 'idgenero')->inline()->radioList(['1'=>'Femenino','2'=>'Masculino','3'=>'Otro'],
                    ['value' => !empty($model->idgenero) ? $model->idgenero :['prompt'=>'Selecciona uno...']],
                    ['separator' => ' ', 'tabindex' => 5])->label('Genero');
            }
          ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="col-md-12">
                    <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
                     'options' => ['accept' => 'image/*'],
                     'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png','jpeg'],'showUpload' => false],
                     'class'=>'custom-file-input', 
                   ]);   ?>
                </div>


                <?= $form->field($model, 'telefono1')->textInput(['placeholder'=>'Celular','autofocus' => true]) ?>
                <?= $form->field($model, 'telefono2')->textInput(['placeholder'=>'Telefono','autofocus' => true]) ?>
                <div class="col-md-4 col-md-push-2">
                    <?= $form->field($model, 'interno1')->textInput(['placeholder'=>'Interno 1','autofocus' => true]) ?>
                </div>
                <div class="col-md-4 col-md-push-1">
                    <?= $form->field($model, 'interno2')->textInput(['placeholder'=>'Interno 2','autofocus' => true]) ?>
                </div>
                <?php
                 if ($model->isNewRecord)
                   echo $form->field($model, 'fechaalta')->textInput(['value'=>date("Y-m-d"),'style'=>'display:none'])->label(false); 
                 else 
                   echo $form->field($model, 'fechaalta')->textInput(['placeholder'=>'Formato aaaa-mm-dd']);
                 ?>

                <?= $form->field($model, 'comentario')->textarea(['rows' => 2]) ?>

            </div>
       
      </div>
        <div class="form-group text-center">

            <?= Html::submitButton('Registrate', ['class' => 'btn btn-rounded btn-lg btn-success', 'name' => 'registro-button']) ?>

            <?php ActiveForm::end(); ?>
        </div>
        <?php if (Yii::$app->session->hasFlash('registroFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
            Enviamos un email de verificación a tu correo, hay indicaciones de procedimientos en la inscripción"
        </div>
        <?php endif; ?>
     </div>
        
  </div>
</section>
<?php

?>