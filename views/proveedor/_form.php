<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'claveunica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeroclave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailproveedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idprovincia')->textInput() ?>

    <?= $form->field($model, 'idciudad')->textInput() ?>

    <?= $form->field($model, 'idtelefono')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
