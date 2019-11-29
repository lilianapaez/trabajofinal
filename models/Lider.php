<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lider".
 *
 * @property int $idlider
 * @property int $idadmin
 *
 * @property Usuario $lider
 * @property Admincontrol $admin
 * @property Vendedor[] $vendedors
 */
class Lider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlider', 'idadmin'], 'required'],
            [['idlider', 'idadmin'], 'integer'],
            [['idlider'], 'unique'],
            [['idlider'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idlider' => 'idusuario']],
            [['idadmin'], 'exist', 'skipOnError' => true, 'targetClass' => Admincontrol::className(), 'targetAttribute' => ['idadmin' => 'idadmin']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlider' => 'Idlider',
            'idadmin' => 'Idadmin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLider()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'idlider']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admincontrol::className(), ['idadmin' => 'idadmin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedors()
    {
        return $this->hasMany(Vendedor::className(), ['idlider' => 'idlider']);
    }
}
