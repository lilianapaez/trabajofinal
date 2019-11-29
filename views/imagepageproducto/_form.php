<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagepageproducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagepageproducto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idimagepage')->textInput() ?>

    <?= $form->field($model, 'idproducto')->textInput() ?>

    <?= $form->field($model, 'preciopublico')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
