<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Catalogo */

$this->title = 'Crear Catalogo';

?>
<div class="catalogo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
