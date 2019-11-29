<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $idproveedor
 * @property string $nombre
 * @property string $claveunica
 * @property string $numeroclave
 * @property string $mailproveedor
 * @property string $direccion
 * @property int $idprovincia
 * @property int $idciudad
 * @property int $idtelefono
 *
 * @property Marca[] $marcas
 * @property Producto[] $productos
 * @property Provincia $provincia
 * @property Ciudad $ciudad
 * @property Telefono $telefono
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'claveunica', 'numeroclave', 'mailproveedor', 'direccion', 'idprovincia', 'idciudad', 'idtelefono'], 'required'],
            [['idprovincia', 'idciudad', 'idtelefono'], 'integer'],
            [['nombre', 'mailproveedor'], 'string', 'max' => 100],
            [['claveunica'], 'string', 'max' => 4],
            [['numeroclave'], 'string', 'max' => 15],
            [['direccion'], 'string', 'max' => 150],
            [['idprovincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idprovincia' => 'idprovincia']],
            [['idciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idciudad' => 'idciudad']],
            [['idtelefono'], 'exist', 'skipOnError' => true, 'targetClass' => Telefono::className(), 'targetAttribute' => ['idtelefono' => 'idtelefono']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproveedor' => 'Idproveedor',
            'nombre' => 'Nombre',
            'claveunica' => 'Claveunica',
            'numeroclave' => 'Numeroclave',
            'mailproveedor' => 'Mailproveedor',
            'direccion' => 'Direccion',
            'idprovincia' => 'Idprovincia',
            'idciudad' => 'Idciudad',
            'idtelefono' => 'Idtelefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasMany(Marca::className(), ['idproveedor' => 'idproveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['idproveedor' => 'idproveedor']);
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
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['idciudad' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelefono()
    {
        return $this->hasOne(Telefono::className(), ['idtelefono' => 'idtelefono']);
    }

    /**
     * Funcion que devuelve una lista de las catalogos con el idmarca
     * $idprovincia int
     * return array
     */
    public static function getListProveedor($idmarca) 
    {
        $proveedorLista = Proveedor::find()
        ->where(['idmarca'=>$idmarca])
        ->asArray()
        ->all();
        foreach ($proveedorLista as $i => $proveedor) {
            $out[] = ['id' => $proveedor['idproveedor'], 'name' => $proveedor['nombre']];
        }          
        return $out;
    }

   
}
