<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imagepageproducto */

$this->title = 'Update Imagepageproducto: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Imagepageproductos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idimagepage, 'url' => ['view', 'idimagepage' => $model->idimagepage, 'idproducto' => $model->idproducto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagepageproducto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
