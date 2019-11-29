<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagepageproducto".
 *
 * @property int $idimagepage
 * @property int $idproducto
 * @property double $preciopublico
 *
 * @property Imagepage $imagepage
 * @property Producto $producto
 */
class Imagepageproducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagepageproducto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idimagepage', 'idproducto', 'preciopublico'], 'required'],
            [['idimagepage', 'idproducto'], 'integer'],
            [['preciopublico'], 'number'],
            [['idimagepage', 'idproducto'], 'unique', 'targetAttribute' => ['idimagepage', 'idproducto']],
            [['idimagepage'], 'exist', 'skipOnError' => true, 'targetClass' => Imagepage::className(), 'targetAttribute' => ['idimagepage' => 'idimagepage']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idimagepage' => 'Idimagepage',
            'idproducto' => 'Idproducto',
            'preciopublico' => 'Preciopublico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagepage()
    {
        return $this->hasOne(Imagepage::className(), ['idimagepage' => 'idimagepage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }
}
