<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendedor".
 *
 * @property int $idvendedor
 * @property int $idlider
 *
 * @property Pedido[] $pedidos
 * @property Usuario $vendedor
 * @property Lider $lider
 */
class Vendedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvendedor', 'idlider'], 'required'],
            [['idvendedor', 'idlider'], 'integer'],
            [['idvendedor'], 'unique'],
            [['idvendedor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idvendedor' => 'idusuario']],
            [['idlider'], 'exist', 'skipOnError' => true, 'targetClass' => Lider::className(), 'targetAttribute' => ['idlider' => 'idlider']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvendedor' => 'Idvendedor',
            'idlider' => 'Idlider',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idvendedor' => 'idvendedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'idvendedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLider()
    {
        return $this->hasOne(Lider::className(), ['idlider' => 'idlider']);
    }
}
