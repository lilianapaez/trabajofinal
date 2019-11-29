<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoproductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidoproducto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nrodetalle') ?>

    <?= $form->field($model, 'idpedido') ?>

    <?= $form->field($model, 'preciopublico') ?>

    <?= $form->field($model, 'cantidadproducto') ?>

    <?= $form->field($model, 'idproducto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
