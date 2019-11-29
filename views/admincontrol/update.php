<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admincontrol */

$this->title = 'Update Admincontrol: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Admincontrols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idadmin, 'url' => ['view', 'id' => $model->idadmin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admincontrol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
