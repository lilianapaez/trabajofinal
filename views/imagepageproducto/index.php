<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagepageproductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagepageproductos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagepageproducto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Imagepageproducto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idimagepage',
            'idproducto',
            'preciopublico',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
