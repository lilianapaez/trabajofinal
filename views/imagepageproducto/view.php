<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Imagepageproducto */

$this->title = $model->idimagepage;
$this->params['breadcrumbs'][] = ['label' => 'Imagepageproductos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagepageproducto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idimagepage' => $model->idimagepage, 'idproducto' => $model->idproducto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idimagepage' => $model->idimagepage, 'idproducto' => $model->idproducto], [
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
            'idimagepage',
            'idproducto',
            'preciopublico',
        ],
    ]) ?>

</div>
