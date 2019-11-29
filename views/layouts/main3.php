<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Area Gestores</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Area gestión del vendedor',
        'brandUrl' => 'index.php?r=site%2Fgestor',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label'=>'Pedidos','items'=>[
                ['label' => 'Elige catalogo', 'url' => ['/catalogo/index1']],
               
            ]],

            ['label' => 'otro','items' => [
                ['label' => 'Ver Todos', 'url' => ['/pedido/index']],
                
			],
			],
			
          !Yii::$app->user->isGuest ?(
            ['label' =>"<i class='glyphicon glyphicon-user ml-30 ml-sm-0' aria-hidden='true'></i>",'items' => [
              ['label' => 'Cambiar contraseña', 'url' => 'index.php?r=site/cambiapass'],
              ['label' => 'Cerrar sesión', 'url' => 'index.php?r=site%2Flogout', 'linkOptions' => ['data-method' => 'post']],
            ],
         ]):'',
        ],
    ]);
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Direct sale <?= date('Y') ?></p>

        <p class="pull-right">Desarrollado por Nosotras </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
