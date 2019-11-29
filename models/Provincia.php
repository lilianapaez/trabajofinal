<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $idprovincia
 * @property string $nombreprovincia
 *
 * @property Ciudad[] $ciudads
 * @property Proveedor[] $proveedors
 * @property Usuario[] $usuarios
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreprovincia'], 'required'],
            [['nombreprovincia'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idprovincia' => 'Idprovincia',
            'nombreprovincia' => 'Nombreprovincia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudads()
    {
        return $this->hasMany(Ciudad::className(), ['idprovincia' => 'idprovincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedors()
    {
        return $this->hasMany(Proveedor::className(), ['idprovincia' => 'idprovincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idprovincia' => 'idprovincia']);
    }
}
