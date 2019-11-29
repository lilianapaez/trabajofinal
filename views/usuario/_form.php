<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasenia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailusuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activado')->textInput() ?>

    <?= $form->field($model, 'fechaalta')->textInput() ?>

    <?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagenperfil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idgenero')->textInput() ?>

    <?= $form->field($model, 'idtelefono')->textInput() ?>

    <?= $form->field($model, 'idprovincia')->textInput() ?>

    <?= $form->field($model, 'idciudad')->textInput() ?>

    <?= $form->field($model, 'idzona')->textInput() ?>

    <?= $form->field($model, 'idrol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
