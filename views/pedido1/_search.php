<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idpedido') ?>

    <?= $form->field($model, 'nombrecomprador') ?>

    <?= $form->field($model, 'telcelcomprador') ?>

    <?= $form->field($model, 'fechapedido') ?>

    <?= $form->field($model, 'idvendedor') ?>

    <?php // echo $form->field($model, 'idcatalogo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
