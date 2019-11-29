<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imagepage */

$this->title = 'Update Imagepage: ' . $model->idimagepage;
$this->params['breadcrumbs'][] = ['label' => 'Imagepages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idimagepage, 'url' => ['view', 'id' => $model->idimagepage]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagepage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
