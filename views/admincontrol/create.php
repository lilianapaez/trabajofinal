<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Admincontrol */

$this->title = 'Create Admincontrol';
$this->params['breadcrumbs'][] = ['label' => 'Admincontrols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admincontrol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
