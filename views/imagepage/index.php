<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagepageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagepages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagepage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Imagepage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idimagepage',
            'imagepage',
            'tieneproducto',
            'numeropage',
            'idcatalogo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
