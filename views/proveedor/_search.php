<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproveedor') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'claveunica') ?>

    <?= $form->field($model, 'numeroclave') ?>

    <?= $form->field($model, 'mailproveedor') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'idprovincia') ?>

    <?php // echo $form->field($model, 'idciudad') ?>

    <?php // echo $form->field($model, 'idtelefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
