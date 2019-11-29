<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Imagepageproducto */

$this->title = 'Create Imagepageproducto';
$this->params['breadcrumbs'][] = ['label' => 'Imagepageproductos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagepageproducto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
