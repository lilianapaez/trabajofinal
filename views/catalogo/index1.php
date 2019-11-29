<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Categoria;
use app\models\Marca;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalogos';

?>
<div class="catalogo-index registro-container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'idcatalogo',
            ['label'=>'Imagen catalogo',
            'attribute'=>'imagencatalogo',
            'format'=>'html',
            'value'=>function($model){
                return yii\bootstrap\Html::img($model->imagencatalogo,['width'=>'80']); 
            },
           ],
            'campania',
            [ 'attribute' => 'fechadesde',
            "filterInputOptions" => ['class'=>'form-control',
            //"disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],          
            [ 'attribute' => 'fechahasta',
            "filterInputOptions" => ['class'=>'form-control',
            //"disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],    
            //'numeropagecat',
            //'vigente',
            [
                'attribute' => 'idmarca',
                 'value' => function($model) {
                     return ($model->marca->nombremarca);
                 },
                 'filter' => Html::activeDropDownList($searchModel, 'idmarca', ArrayHelper::map(Marca::find()->asArray()->all(), 'idmarca', 'nombremarca'),
                 ['class'=>'form-control','prompt' => 'Elije.....................']),
               ],
            [
                'attribute' => 'idcategoria',
                 'value' => function($model) {
                     return ($model->categoria->descripcioncategoria);
                 },
                 'filter' => Html::activeDropDownList($searchModel, 'idcategoria', ArrayHelper::map(Categoria::find()->asArray()->all(), 'idcategoria', 'descripcioncategoria'),
                 ['class'=>'form-control','prompt' => 'Elije.....................']),
               ],
               ['label'=>'Pedidos',
            'attribute'=>'',
           'format'=>'raw',
           //'hAlign' => 'center',
           'contentOptions'=>['style'=>'width:100px;'],
           'value'=>function($model){
               return Html::a('<span class = " glyphicon glyphicon-th-list"></span>', 
                          [ 'pedido/create',
                           'id'=>$model->idcatalogo]);
               }
           ],
            
        ],
    ]); ?>
</div>
