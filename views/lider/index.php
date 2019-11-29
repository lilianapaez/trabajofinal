<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LiderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lider', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlider',
            'idadmin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
