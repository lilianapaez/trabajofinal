<?php

namespace app\models;
use app\models\Marca;
use app\models\Proveedor;
use yii\helpers\ArrayHelper;


use Yii;

/**
 * This is the model class for table "productocatalogo".
 *
 * @property int $idproducto
 * @property int $idcatalogo
 * @property double $preciopublico
 * @property int $cantidadacumulado
 * @property int $cantidadrecibido
 *
 * @property Producto $producto
 * @property Catalogo $catalogo
 */
class Productocatalogo extends \yii\db\ActiveRecord
{
    public $idproveedor;
    public $idmarca;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productocatalogo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproducto', 'idcatalogo', 'preciopublico'], 'required'],
            [['idproducto', 'idcatalogo', 'cantidadacumulado', 'cantidadrecibido','idproveedor','idmarca'], 'integer'],
            [['idproveedor','idmarca'],'safe'],
            [['preciopublico'], 'number'],
            [['idproducto', 'idcatalogo'], 'unique', 'targetAttribute' => ['idproducto', 'idcatalogo']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            [['idcatalogo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogo::className(), 'targetAttribute' => ['idcatalogo' => 'idcatalogo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => 'Referencia producto',
            'idcatalogo' => 'Referencia catalogo',
            'preciopublico' => 'Precio publico',
            'cantidadacumulado' => 'Cantidad acumulado',
            'cantidadrecibido' => 'Cantidad recibido',
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
    public function getCatalogo()
    {
        return $this->hasOne(Catalogo::className(), ['idcatalogo' => 'idcatalogo']);
    }

    public function getCatalogodescripcion(){
        $dropciones=Catalogo::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idcatalogo','campania');
    }

    public function getProductodescripcion(){
        $dropciones=Producto::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idproducto','codigo');
    }
    public function getMarcadescripcion(){
        $dropciones=Marca::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idmarca','nombremarca');
    }
    public function getProveedordescripcion(){
        $dropciones=Proveedor::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idproveedor','nombre');
    }

    public function buscaproducto($id){
        return self::find(['idproducto'=>$id])->One();
    }
}
