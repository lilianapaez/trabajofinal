<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Catalogo */

$this->title = 'Update Catalogo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcatalogo, 'url' => ['view', 'id' => $model->idcatalogo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="catalogo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
