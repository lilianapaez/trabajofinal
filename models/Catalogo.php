<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use app\models\Marca;
use app\models\Categoria;

use Yii;

/**
 * This is the model class for table "catalogo".
 *
 * @property int $idcatalogo
 * @property string $imagencatalogo
 * @property string $campania
 * @property string $fechadesde
 * @property string $fechahasta
 * @property int $numeropagecat
 * @property int $vigente
 * @property int $idmarca
 * @property int $idcategoria
 *
 * @property Marca $marca
 * @property Categoria $categoria
 * @property Imagepage[] $imagepages
 * @property Pedido[] $pedidos
 * @property Productocatalogo[] $productocatalogos
 * @property Producto[] $productos
 */
class Catalogo extends \yii\db\ActiveRecord
{
    public $imagen;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imagen', 'campania', 'fechadesde', 'fechahasta', 'numeropagecat', 'idmarca', 'idcategoria'], 'required'],
            [['fechadesde', 'fechahasta'], 'safe'],
            [['numeropagecat', 'idmarca', 'idcategoria'], 'integer'],
            ['imagen','safe'],
            [['imagen'], 'file',
                'maxSize' => 20 * 1024 * 1024, //20MB
                'tooBig' => 'El tamaño máximo permitido es 20MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'jpg, jpeg, png, bmp, jpe',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
            [['imagencatalogo'], 'string', 'max' => 80],
            [['campania'], 'string', 'max' => 20],
            [['vigente'], 'string', 'max' => 1],
            [['idmarca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['idmarca' => 'idmarca']],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idcategoria' => 'idcategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcatalogo' => 'Referencia catálogo',
            'imagencatalogo' => 'Imagen catálogo',
            'campania' => 'Campaña',
            'fechadesde' => 'Fecha desde',
            'fechahasta' => 'Fecha hasta',
            'numeropagecat' => 'Total páginas del catálogo',
            'vigente' => 'Vigente',
            'idmarca' => 'Marca',
            'idcategoria' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['idmarca' => 'idmarca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'idcategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagepages()
    {
        return $this->hasMany(Imagepage::className(), ['idcatalogo' => 'idcatalogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idcatalogo' => 'idcatalogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductocatalogos()
    {
        return $this->hasMany(Productocatalogo::className(), ['idcatalogo' => 'idcatalogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['idproducto' => 'idproducto'])->viaTable('productocatalogo', ['idcatalogo' => 'idcatalogo']);
    }

    public function getCategoriadescripcion(){
        $dropciones=Categoria::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idcategoria','descripcioncategoria');
    }

    public function getMarcadescripcion(){
        $dropciones=Marca::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idmarca','nombremarca');
    }

    /**
     * Funcion que devuelve una lista de las catalogos con el idmarca
     * $idprovincia int
     * return array
     */
    public static function getListCatalogo($idmarca) 
    {
        $catalogoLista = Catalogo::find()
        ->where(['idmarca'=>$idmarca])
        ->asArray()
        ->all();
        foreach ($catalogoLista as $i => $catalogo) {
            $out[] = ['id' => $catalogo['idcatalogo'], 'name' => $catalogo['campania']];
        }          
        return $out;
    }
    
}
