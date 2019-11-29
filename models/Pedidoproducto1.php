<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "pedidoproducto".
 *
 * @property int $nrodetalle
 * @property int $idpedido
 * @property double $preciopublico
 * @property int $cantidadproducto
 * @property int $idproducto
 * 
 *
 * @property Pedido $pedido
 * @property Producto $producto
 * 
 */
class Pedidoproducto extends \yii\db\ActiveRecord
{
    public $descripcion;
    public $codigo;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidoproducto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpedido', 'preciopublico', 'cantidadproducto', 'idproducto'], 'required'],
            [['idpedido', 'cantidadproducto', 'idproducto', ], 'integer'],
            [['preciopublico'], 'number'],
            ['descripcion','safe'],
            [['idpedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['idpedido' => 'idpedido']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nrodetalle' => 'Nro detalle',
            'idpedido' => 'Pedido numero',
            'preciopublico' => 'Precio publico',
            'cantidadproducto' => 'Cantidad producto',
            'idproducto' => 'Producto',
           
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['idpedido' => 'idpedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }

    

    public function productoDescripcion($id){
        $dropciones=Producto::find()->where(['idproveedor'=>$id])->asArray()->all();
        return ArrayHelper::map($dropciones,'idproducto','codigo');
    }
}
