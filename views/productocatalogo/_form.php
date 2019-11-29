<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Marca;

/* @var $this yii\web\View */
/* @var $model app\models\Productocatalogo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productocatalogo-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php

echo $form->field($model, 'idmarca')->dropDownList(
    $model->marcadescripcion,
    [
        'prompt'=>'Secceciona',
        'onchange'=>'
                        $.get( "'.Url::toRoute('catalogo/catalogos').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'idcatalogo').'" ).html( data );
                            }
                        );
                    '
    ]
);
?>
 
<?php echo $form->field($model, 'idcatalogo')->dropDownList($model->catalogodescripcion,
    [
        'prompt'=>'Por favor elija uno',
        'onchange'=>'
                        $.get( "'.Url::toRoute('catalogo/').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'idproveedor').'" ).html( data );
                            }
                        );
                    '
    ]
); ?>;
<?php echo $form->field($model, 'idproveedor')->dropDownList($model->proveedordescripcion,
    [
        'prompt'=>'Por favor elija uno',
        'onchange'=>'
                        $.get( "'.Url::toRoute('proveedor/').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'idproducto').'" ).html( data );
                            }
                        );
                    '
    ]
); ?>;
 
<?php
if ($model->isNewRecord)
    echo $form->field($model, 'idproducto')->dropDownList($model->productodescripcion,['prompt'=>'Por favor elija una']);
else
{
    
    echo $form->field($model, 'idproducto')->dropDownList($model->productodescripcion);
}
?>
   
    <!--<?= $form->field($model, 'idcatalogo')->textInput() ?>-->
    



    <?= $form->field($model, 'preciopublico')->textInput() ?>

    <?= $form->field($model, 'cantidadacumulado')->textInput() ?>

    <?= $form->field($model, 'cantidadrecibido')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
