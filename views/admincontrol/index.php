<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdmincontrolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admincontrols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admincontrol-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admincontrol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idadmin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
