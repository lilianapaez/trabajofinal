<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Oferta */

$this->title = 'Update Oferta: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ofertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idoferta, 'url' => ['view', 'id' => $model->idoferta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oferta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
