<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Marca;
use app\models\Usuario;
use app\models\Catalogo;

/* @var $this yii\web\View */
/* @var $model app\models\Pedidoproducto */
/* @var $form yii\widgets\ActiveForm */
$catalogo=Catalogo::findOne(['idcatalogo'=>$model->idcatalogo]);
$proveedor=Marca::buscaMarca($catalogo->idmarca);
$usuario=Usuario::findOne(['idusuario'=>$model->idvendedor]);
?>

<div class="pedidoproducto-form inscripcion-container">

<div class="col-md-7">
      <div class="row text-center">
        <h3><?= Html::encode('Pedido de referencia') ?></h3> 
         <?= DetailView::widget([
          'model' => $model,
          
          'attributes' => [
            
            'idpedido',
            'nombrecomprador',
            'telcelcomprador',
            [ 'attribute' => 'fechapedido',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:d-m-Y'],

            ],         
            
            'idcatalogo',
            ],
         ]) ?>
         <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
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
        <div class="row"><br></div>
    </div>
<?php $form = ActiveForm::begin(); ?>
 <div class="col-md-1"></div>
    <div class="container si-label">
      <div class="col-md-4">
                <div class="row">
                <h1 class="text-center"><?= Html::encode('Vendedor: '.$usuario->nombre) ?></h1>
                  <h3><?= Html::encode('Ingreso de productos') ?></h3>

                  <?= $form->field($model1, 'idproducto')->widget(Select2::classname(), [
                             'data' => $model1->productoDescripcion($proveedor->idproveedor),
                             'id'=>'idproducto',
                             'options' => [
                             'value' => '120',
                             'placeholder' => 'Selecciona un codigo...',
                             'multiple' => false],
							  'pluginOptions' => [
                                 'allowClear' => true,
                                'class'=>'form-control'],
                            ])->label('Codigo producto '); ?>
<?= $form->field($model1, 'descripcion')->widget(DepDrop::classname(), [
                             'type' => DepDrop::TYPE_SELECT2,
                             'disabled' => true,
                             'options' => [
                             'id' => 'idDescripcion',
                             'readonly' => true,
                             'showToggleAll' => false,
                             'multiple' => true,

                            ],
                             'pluginOptions'=>[
                             'initialize' => true,
                             'placeholder' => 'Descripcion...',
                             'depends'=>['idproducto'],
                             'url'=>Url::to(['producto/buscadescripcion']),
                             'loadingText' => 'Cargando producto...']
                             ])->label('Descripcion producto ');?>

    <?= $form->field($model1, 'idpedido')->textInput(['value'=>$model->idpedido,'style'=>'display:none'])->label(false); ?>
    <?= $form->field($model1, 'preciopublico')->textInput(['placeholder'=>'Precio solo números']) ?>

    <?= $form->field($model1, 'cantidadproducto')->textInput(['placeholder'=>'Cantidad solo números']) ?>

    <div class="form-group">
        <?= Html::submitButton('Ingresa producto', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
