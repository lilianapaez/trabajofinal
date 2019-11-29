<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Crear Pedido';
?>
<div class="pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model1'=> $model1,
        'model'=>$model,
    ]) ?>

</div>
