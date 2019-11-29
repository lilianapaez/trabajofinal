<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property int $idmarca
 * @property string $nombremarca
 * @property int $idproveedor
 *
 * @property Catalogo[] $catalogos
 * @property Proveedor $proveedor
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombremarca', 'idproveedor'], 'required'],
            [['idproveedor'], 'integer'],
            [['nombremarca'], 'string', 'max' => 64],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['idproveedor' => 'idproveedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmarca' => 'Idmarca',
            'nombremarca' => 'Nombremarca',
            'idproveedor' => 'Idproveedor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogos()
    {
        return $this->hasMany(Catalogo::className(), ['idmarca' => 'idmarca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'idproveedor']);
    }

    public function buscaMarca($id){
        return self::findOne(['idmarca'=>$id]);
    }
}
