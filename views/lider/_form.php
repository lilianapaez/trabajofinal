<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idlider')->textInput() ?>

    <?= $form->field($model, 'idadmin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
