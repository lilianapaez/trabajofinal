<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telefono".
 *
 * @property int $idtelefono
 * @property string $telefono1
 * @property string $telefono2
 * @property int $interno1
 * @property int $interno2
 *
 * @property Proveedor[] $proveedors
 * @property Usuario[] $usuarios
 */
class Telefono extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telefono';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interno1', 'interno2'], 'integer'],
            [['telefono1', 'telefono2'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtelefono' => 'Idtelefono',
            'telefono1' => 'Telefono1',
            'telefono2' => 'Telefono2',
            'interno1' => 'Interno1',
            'interno2' => 'Interno2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedors()
    {
        return $this->hasMany(Proveedor::className(), ['idtelefono' => 'idtelefono']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idtelefono' => 'idtelefono']);
    }
}
