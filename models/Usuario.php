<?php

namespace app\models;

use Yii;
use yii \ web \ IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idusuario
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $direccion
 * @property string $nick
 * @property string $contrasenia
 * @property string $mailusuario
 * @property int $activado
 * @property string $fechaalta
 * @property string $authkey
 * @property string $imagenperfil
 * @property int $idgenero
 * @property int $idtelefono
 * @property int $idprovincia
 * @property int $idciudad
 * @property int $idzona
 * @property int $idrol
 *
 * @property Admincontrol $admincontrol
 * @property Lider $lider
 * @property Genero $genero
 * @property Telefono $telefono
 * @property Provincia $provincia
 * @property Ciudad $ciudad
 * @property Zona $zona
 * @property Rol $rol
 * @property Vendedor $vendedor
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'dni', 'direccion', 'nick', 'contrasenia', 'mailusuario', 'authkey', 'idgenero', 'idtelefono', 'idprovincia', 'idciudad', 'idzona', 'idrol'], 'required'],
            [['fechaalta'], 'safe'],
            [['idgenero', 'idtelefono', 'idprovincia', 'idciudad', 'idzona', 'idrol'], 'integer'],
            [['nombre', 'apellido', 'contrasenia', 'mailusuario', 'authkey'], 'string', 'max' => 100],
            [['dni'], 'string', 'max' => 15],
            [['direccion'], 'string', 'max' => 150],
            [['nick'], 'string', 'max' => 16],
            [['activado'], 'string', 'max' => 1],
            [['imagenperfil'], 'string', 'max' => 80],
            [['idgenero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['idgenero' => 'idgenero']],
            [['idtelefono'], 'exist', 'skipOnError' => true, 'targetClass' => Telefono::className(), 'targetAttribute' => ['idtelefono' => 'idtelefono']],
            [['idprovincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idprovincia' => 'idprovincia']],
            [['idciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idciudad' => 'idciudad']],
            [['idzona'], 'exist', 'skipOnError' => true, 'targetClass' => Zona::className(), 'targetAttribute' => ['idzona' => 'idzona']],
            [['idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idrol' => 'idrol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => 'Referencia usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'dni' => 'Dni',
            'direccion' => 'Direccion',
            'nick' => 'Nick',
            'contrasenia' => 'Contraseña',
            'mailusuario' => 'Mail usuario',
            'activado' => 'Activado',
            'fechaalta' => 'Fecha alta',
            'authkey' => 'Authkey',
            'imagenperfil' => 'Imagen perfil',
            'idgenero' => 'Genero',
            'idtelefono' => 'Telefono',
            'idprovincia' => 'Provincia',
            'idciudad' => 'Ciudad',
            'idzona' => 'Zona',
            'idrol' => 'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmincontrol()
    {
        return $this->hasOne(Admincontrol::className(), ['idadmin' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLider()
    {
        return $this->hasOne(Lider::className(), ['idlider' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['idgenero' => 'idgenero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelefono()
    {
        return $this->hasOne(Telefono::className(), ['idtelefono' => 'idtelefono']);
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
    public function getZona()
    {
        return $this->hasOne(Zona::className(), ['idzona' => 'idzona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['idrol' => 'idrol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(Vendedor::className(), ['idvendedor' => 'idusuario']);
    }
	
	 public function getRoles(){
        return $this->idrol->Rol;
      }

      public static function roleInArray($arr_role){
        return in_array(Yii::$app->user->identity->idrol, $arr_role);
      }

      public function getRoldescripcion(){
          $dropciones=Rol::find()->asArray()->all();
          return ArrayHelper::map($dropciones,'idrol','descripcionrol');
      }
      public function getLosusuarios(){
        $lista= ArrayHelper::map(\app\models\Usuario::find()
              ->select('idusuario,dni')
              ->all(),'idusuario','dni');

        return $lista;
    }
    
    public function getUsuario($dni)
    {
        return self::find()
		     ->where(["dni" => $dni])->one();
		    
    }
    /*public function getVendedor($dni)
    {
        return self::find()
		     ->where(["dniUsuario" => $dni])->one();
		    
    }*/

    public function getElusuario($d,$c){
        return self::find()
		     ->where(["dni" => $d])
		    ->andWhere(["authkey" => $c])->one();
      
    }

    public function getAuthKey() {
        return $this->authkey;
    }

    public function getId() {
        return $this->idusuario;
    }

    public function validateAuthKey($authKey) {
        return $this->authkey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($dni) {
        return self::findOne(["dni" => $dni]);
    }

    public function validatePassword($password) {
        return $this->contrasenia ===crypt($password, Yii::$app->params["salt"]);//Encriptamos el password $password;
    }

    public function validateMail($email){
        return $this->mailusuario === $email;
    }

}
