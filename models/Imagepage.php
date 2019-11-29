<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use app\models\Catalogo;
use Yii;

/**
 * This is the model class for table "imagepage".
 *
 * @property int $idimagepage
 * @property string $imagepage
 * @property int $tieneproducto
 * @property int $numeropage
 * @property int $idcatalogo
 *
 * @property Catalogo $catalogo
 * @property Imagepageproducto[] $imagepageproductos
 * @property Producto[] $productos
 */
class Imagepage extends \yii\db\ActiveRecord
{
    public $imagen;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagepage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numeropage', 'idcatalogo','imagen','tieneproducto'], 'required','message'=>'Debes completar'],
            [['numeropage', 'idcatalogo'], 'integer'],
            [['imagepage'], 'string', 'max' => 80],
            [['imagen'],'safe'],
            [['imagen'], 'file',
                'maxSize' => 20 * 1024 * 1024, //10MB
                'tooBig' => 'El tamaño máximo permitido es 20MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'jpg, jpeg, png, bmp, jpe',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
            [['tieneproducto'], 'string', 'max' => 1],
            [['idcatalogo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogo::className(), 'targetAttribute' => ['idcatalogo' => 'idcatalogo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idimagepage' => 'Ref. imagen de página',
            'imagepage' => 'Imagen página',
            'tieneproducto' => 'Tiene producto?',
            'numeropage' => 'Número de página',
            'idcatalogo' => 'Catálogo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogo()
    {
        return $this->hasOne(Catalogo::className(), ['idcatalogo' => 'idcatalogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagepageproductos()
    {
        return $this->hasMany(Imagepageproducto::className(), ['idimagepage' => 'idimagepage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['idproducto' => 'idproducto'])->viaTable('imagepageproducto', ['idimagepage' => 'idimagepage']);
    }

    public function getImagendescripcion(){
        $dropciones=Imagepage::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idimagepage','imagepage');
    }

    public function getCatalogodescripcion(){
        $dropciones=Catalogo::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idcatalogo','campania');
    }
}
