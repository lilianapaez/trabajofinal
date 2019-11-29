<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImagepageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagepage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idimagepage') ?>

    <?= $form->field($model, 'imagepage') ?>

    <?= $form->field($model, 'tieneproducto') ?>

    <?= $form->field($model, 'numeropage') ?>

    <?= $form->field($model, 'idcatalogo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
