<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductocatalogoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productocatalogo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproducto') ?>

    <?= $form->field($model, 'idcatalogo') ?>

    <?= $form->field($model, 'preciopublico') ?>

    <?= $form->field($model, 'cantidadacumulado') ?>

    <?= $form->field($model, 'cantidadrecibido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
