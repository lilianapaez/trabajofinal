<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalogo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcatalogo') ?>

    <?= $form->field($model, 'imagencatalogo') ?>

    <?= $form->field($model, 'campania') ?>

    <?= $form->field($model, 'fechadesde') ?>

    <?= $form->field($model, 'fechahasta') ?>

    <?php // echo $form->field($model, 'numeropagecat') ?>

    <?php // echo $form->field($model, 'vigente') ?>

    <?php // echo $form->field($model, 'idmarca') ?>

    <?php // echo $form->field($model, 'idcategoria') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
