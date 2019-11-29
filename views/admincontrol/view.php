<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admincontrol */

$this->title = $model->idadmin;
$this->params['breadcrumbs'][] = ['label' => 'Admincontrols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admincontrol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idadmin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idadmin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idadmin',
        ],
    ]) ?>

</div>
