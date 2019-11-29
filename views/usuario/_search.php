<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idusuario') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'dni') ?>

    <?= $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'nick') ?>

    <?php // echo $form->field($model, 'contrasenia') ?>

    <?php // echo $form->field($model, 'mailusuario') ?>

    <?php // echo $form->field($model, 'activado') ?>

    <?php // echo $form->field($model, 'fechaalta') ?>

    <?php // echo $form->field($model, 'authkey') ?>

    <?php // echo $form->field($model, 'imagenperfil') ?>

    <?php // echo $form->field($model, 'idgenero') ?>

    <?php // echo $form->field($model, 'idtelefono') ?>

    <?php // echo $form->field($model, 'idprovincia') ?>

    <?php // echo $form->field($model, 'idciudad') ?>

    <?php // echo $form->field($model, 'idzona') ?>

    <?php // echo $form->field($model, 'idrol') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
