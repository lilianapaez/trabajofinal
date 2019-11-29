<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Telefono */

$this->title = 'Update Telefono: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Telefonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtelefono, 'url' => ['view', 'id' => $model->idtelefono]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="telefono-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
