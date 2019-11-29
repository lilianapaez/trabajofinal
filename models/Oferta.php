<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oferta".
 *
 * @property int $idoferta
 * @property double $preciooferta
 * @property string $fechadesde
 * @property string $fechahasta
 * @property int $idproducto
 *
 * @property Producto $producto
 * @property Pedidoproducto[] $pedidoproductos
 */
class Oferta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oferta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['preciooferta', 'fechadesde', 'fechahasta', 'idproducto'], 'required'],
            [['preciooferta'], 'number'],
            [['fechadesde', 'fechahasta'], 'safe'],
            [['idproducto'], 'integer'],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idoferta' => 'Idoferta',
            'preciooferta' => 'Preciooferta',
            'fechadesde' => 'Fechadesde',
            'fechahasta' => 'Fechahasta',
            'idproducto' => 'Idproducto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoproductos()
    {
        return $this->hasMany(Pedidoproducto::className(), ['idoferta' => 'idoferta']);
    }
}
