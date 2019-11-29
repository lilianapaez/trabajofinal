<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Productocatalogo */

$this->title = $model->idproducto;
$this->params['breadcrumbs'][] = ['label' => 'Productocatalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productocatalogo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idproducto' => $model->idproducto, 'idcatalogo' => $model->idcatalogo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idproducto' => $model->idproducto, 'idcatalogo' => $model->idcatalogo], [
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
            'idproducto',
            'idcatalogo',
            'preciopublico',
            'cantidadacumulado',
            'cantidadrecibido',
        ],
    ]) ?>

</div>
