<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use app\models\Marca;
use app\models\Producto;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $idpedido
 * @property string $nombrecomprador
 * @property string $telcelcomprador
 * @property string $fechapedido
 * @property int $idvendedor
 * @property int $idcatalogo
 *
 * @property Vendedor $vendedor
 * @property Catalogo $catalogo
 * @property Pedidoproducto[] $pedidoproductos
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $idmarca;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechapedido', 'idvendedor', 'idcatalogo','nombrecomprador','telcelcomprador'], 'required'],
            [['fechapedido'], 'safe'],
            [['idvendedor', 'idcatalogo'], 'integer'],
            [['nombrecomprador'], 'string', 'max' => 50],
            [['telcelcomprador'], 'string', 'max' => 20],
            [['idvendedor'], 'exist', 'skipOnError' => true, 'targetClass' => Vendedor::className(), 'targetAttribute' => ['idvendedor' => 'idvendedor']],
            [['idcatalogo'], 'exist', 'skipOnError' => true, 'targetClass' => Catalogo::className(), 'targetAttribute' => ['idcatalogo' => 'idcatalogo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpedido' => 'Referencia pedido',
            'nombrecomprador' => 'Nombre comprador',
            'telcelcomprador' => 'Celular o telefono comprador',
            'fechapedido' => 'Fecha pedido',
            'idvendedor' => 'Vendedor',
            'idcatalogo' => 'Catalogo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(Vendedor::className(), ['idvendedor' => 'idvendedor']);
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
    public function getPedidoproductos()
    {
        return $this->hasMany(Pedidoproducto::className(), ['idpedido' => 'idpedido']);
    }

    public function getVendedordescripcion(){
        $dropciones=Usuario::find()->where(['idrol'=>1])->asArray()->all();
        return ArrayHelper::map($dropciones,'idusuario','nombre');
    }

    public function getCatalogodescripcion(){
        $dropciones=Catalogo::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idcatalogo','campania');
    }

    public function getMarcadescripcion(){
        $dropciones=Marca::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idmarca','nombremarca');
    }

    public function getProductodescripcion(){
        $dropciones=Producto::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idproducto','codigo');
    }
}
