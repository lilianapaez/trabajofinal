<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productocatalogo */

$this->title = 'Update Productocatalogo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Productocatalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproducto, 'url' => ['view', 'idproducto' => $model->idproducto, 'idcatalogo' => $model->idcatalogo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productocatalogo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
