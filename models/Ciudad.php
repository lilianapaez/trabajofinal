<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property int $idciudad
 * @property int $idprovincia
 * @property string $nombreciudad
 * @property int $codigo
 *
 * @property Provincia $provincia
 * @property Proveedor[] $proveedors
 * @property Usuario[] $usuarios
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprovincia', 'nombreciudad', 'codigo'], 'required'],
            [['idprovincia', 'codigo'], 'integer'],
            [['nombreciudad'], 'string', 'max' => 64],
            [['idprovincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idprovincia' => 'idprovincia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idciudad' => 'Idciudad',
            'idprovincia' => 'Idprovincia',
            'nombreciudad' => 'Nombreciudad',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['idprovincia' => 'idprovincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedors()
    {
        return $this->hasMany(Proveedor::className(), ['idciudad' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idciudad' => 'idciudad']);
    }
	
	/**
     * Funcion que devuelve una lista de las ciudades con el idprovincia
     * $idprovincia int
     * return array
     */
    public static function getListCiudad($idprovincia) 
    {
        $ciudadControl = new \app\models\Ciudad();
        $ciudadLista = $ciudadControl::find()
        ->where(['idprovincia'=>$idprovincia])
        ->asArray()
        ->all();
        foreach ($ciudadLista as $i => $ciudad) {
            $out[] = ['id' => $ciudad['idciudad'], 'name' => $ciudad['nombreciudad']];
        }          
        return $out;
    }
}
