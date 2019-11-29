<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Productocatalogo */

$this->title = 'Crear Producto catalogo';
$this->params['breadcrumbs'][] = ['label' => 'Productocatalogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productocatalogo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
