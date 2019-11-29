<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admincontrol".
 *
 * @property int $idadmin
 *
 * @property Usuario $admin
 * @property Lider[] $liders
 */
class Admincontrol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admincontrol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idadmin'], 'required'],
            [['idadmin'], 'integer'],
            [['idadmin'], 'unique'],
            [['idadmin'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idadmin' => 'idusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idadmin' => 'Idadmin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'idadmin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiders()
    {
        return $this->hasMany(Lider::className(), ['idadmin' => 'idadmin']);
    }
}
