<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admincontrol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admincontrol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idadmin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
