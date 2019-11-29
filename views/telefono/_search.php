<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TelefonoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telefono-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtelefono') ?>

    <?= $form->field($model, 'telefono1') ?>

    <?= $form->field($model, 'telefono2') ?>

    <?= $form->field($model, 'interno1') ?>

    <?= $form->field($model, 'interno2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
