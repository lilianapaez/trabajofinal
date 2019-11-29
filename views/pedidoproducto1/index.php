<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoproductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidoproductos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedidoproducto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pedidoproducto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nrodetalle',
            'idpedido',
            ['label'=>'$ público',
              'attribute'=>'preciopublico',
              "filterInputOptions" => ['class'=>'form-control','style'=>'width:80px;']
            ],
            ['label'=>'Cantidad',
              'attribute'=>'cantidadproducto',
              "filterInputOptions" => ['class'=>'form-control','style'=>'width:60px;']
            ],
            ['label'=>'Código',
              'attribute'=>'idproducto',
              "filterInputOptions" => ['class'=>'form-control','style'=>'width:80px;'],
              'value'=>function($model1){
                  return $model1->producto->codigo;
              },
            ],
            ['label'=>'Descripción',
              'attribute'=>'idproducto',
              'value'=>function($model1){
                  return $model1->producto->descripcion;
              },
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
