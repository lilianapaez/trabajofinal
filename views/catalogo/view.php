<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Catalogo */

$this->title = $model->idcatalogo;
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idcatalogo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idcatalogo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
       <div class="col-md-6">
        <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            'idcatalogo',
            
            'campania',
            [ 'attribute' => 'fechadesde',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],          
            [ 'attribute' => 'fechahasta',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],    
            'numeropagecat',
            ['attribute'=>'vigente',
             'hAlign' => 'center',
             'value'=>function($model){
                 return ($model->vigente==0)?'si':'no';
             },
               'filter'=>array('0'=>'si','1'=>'no'),
               'filterInputOptions' => ['prompt' => 'Elije ...', 'class' => 'form-control', 'id' => null]
            ],
            [
                'attribute' => 'idmarca',
                 'value' => function($model) {
                     return ($model->marca->nombremarca);
                 }
               ],
            [
                'attribute' => 'idcategoria',
                 'value' => function($model) {
                     return ($model->categoria->descripcioncategoria);
                 }
               ],
        ],
    ]) ?>
    </div>
    <div class="col-md-6">
    <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
            ['label'=>'Imagen catalogo',
            'attribute'=>'imagencatalogo',
            'format'=>'html',
            'value'=>function($model){
                return yii\bootstrap\Html::img($model->imagencatalogo,['width'=>'200']); 
            },
           ],
          ],
    ]) ?>
    </div>
   </div>
</div>
