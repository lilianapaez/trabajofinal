<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lider */

$this->title = 'Create Lider';
$this->params['breadcrumbs'][] = ['label' => 'Liders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
