<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idproducto
 * @property string $codigo
 * @property string $descripcion
 * @property string $imagenproducto
 * @property double $preciocosto
 * @property int $activado
 * @property int $idproveedor
 *
 * @property Imagepageproducto[] $imagepageproductos
 * @property Imagepage[] $imagepages
 * @property Oferta[] $ofertas
 * @property Pedidoproducto[] $pedidoproductos
 * @property Proveedor $proveedor
 * @property Productocatalogo[] $productocatalogos
 * @property Catalogo[] $catalogos
 */
class Producto extends \yii\db\ActiveRecord
{
    public $imagen;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion', 'preciocosto', 'idproveedor'], 'required'],
            [['preciocosto'], 'number'],
            [['idproveedor'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 100],
            [['imagenproducto'], 'string', 'max' => 256],
            ['imagen','safe'],
            [['imagen'], 'file',
                'maxSize' => 20 * 1024 * 1024, //20MB
                'tooBig' => 'El tamaño máximo permitido es 20MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'jpg, jpeg, png, bmp, jpe',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
            [['activado'], 'string', 'max' => 1],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['idproveedor' => 'idproveedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => 'Referencia producto',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'imagenproducto' => 'Imagen producto',
            'preciocosto' => 'Precio de costo',
            'activado' => 'Activado',
            'idproveedor' => 'Proveedor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagepageproductos()
    {
        return $this->hasMany(Imagepageproducto::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagepages()
    {
        return $this->hasMany(Imagepage::className(), ['idimagepage' => 'idimagepage'])->viaTable('imagepageproducto', ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Oferta::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoproductos()
    {
        return $this->hasMany(Pedidoproducto::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'idproveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductocatalogos()
    {
        return $this->hasMany(Productocatalogo::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogos()
    {
        return $this->hasMany(Catalogo::className(), ['idcatalogo' => 'idcatalogo'])->viaTable('productocatalogo', ['idproducto' => 'idproducto']);
    }

    public function getProveedordescripcion(){
        $dropciones=Proveedor::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idproveedor','nombre');
    }
}
