<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedidoproducto */

$this->title = 'Update Pedidoproducto: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Pedidoproductos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nrodetalle, 'url' => ['view', 'nrodetalle' => $model->nrodetalle]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedidoproducto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
