<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Usuario;
use app\models\Provincia;
use app\models\Ciudad;
use app\models\Zona;
use app\models\Telefono;
use app\models\Genero;
use app\models\Rol;

    /**
     * Registro form
     */
    class RegistroForm extends Model
    {
        public $nombre;
        public $apellido;
        public $nick;
        public $dni;
        public $email;
        public $fechaalta;
        public $direccion;
        public $activado;
        public $idgenero;
        public $idtelefono;
        public $idprovincia;
        public $idzona;
        public $idrol;
        public $idciudad;
        public $password;
        public $telefono1;
        public $telefono2;
        public $interno1;
        public $interno2;
        public $repite_password;
        public $comentario;
        public $imagen;
        private $_user = false;
        public $isNewRecord =true;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
           // [['nombre', 'apellido','dni', 'email', 'password','repite_password','nick'], 'trim'],
            [['nombre', 'apellido','dni', 'email','direccion', 'password','repite_password','nick','fechaalta','telefono1','telefono2','idgenero','imagen','comentario'], 'required', 'message' => 'Campo requerido'],
            [['activado', 'idgenero', 'idprovincia', 'idciudad', 'idzona'], 'integer'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mínimo y máximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Sólo se aceptan números'],
            ['dni','validateDni'],
            [['nick'], 'string', 'max' => 16],
            ['email', 'email', 'message' => 'Formato no válido'],
            [['fechaalta','imagen','comentario'], 'safe'],
            [['comentario'], 'string'],
            [['imagen'], 'file',
                'maxSize' => 20 * 1024 * 1024, //20MB
                'tooBig' => 'El tamaño máximo permitido es 20MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'jpg, jpeg, png, bmp, jpe',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
            [['direccion'], 'string', 'max' => 150],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
            ['password','match','pattern'=> "/^[a-zA-Z0-9.]+$/", 'message'=>'Sólo letras y números'],
            ['repite_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            [['idgenero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['idgenero' => 'idgenero']],
            [['idprovincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idprovincia' => 'idprovincia']],
            [['idciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idciudad' => 'idciudad']],
            [['idzona'], 'exist', 'skipOnError' => true, 'targetClass' => Zona::className(), 'targetAttribute' => ['idzona' => 'idzona']],
           
            ];
        }

     
        /**
     * Validates the dni.
     * This method serves as the inline validation for dni.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateDni($attribute, $params){

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //echo '<pre>';echo print_r($user);echo '</pre>';die();
            if ($user) {
                $this->addError($attribute, 'DNI ingresado ya existe.');
            }
        }
    }

    /**
     * Finds user by [[dni]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::findOne(['dni'=>$this->dni]);
            echo '<pre>';print_r($this->_user)." ".$this->dni;echo '</pre>';die();
        }

        return $this->_user;
    }

   
        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function signup()
        {
           //if ($this->validate()) {
                //echo '<pre>'; print_r($this);echo '</pre>';die();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                  $tele=new Telefono(false);
                  $tele->telefono1=$this->telefono1;$tele->telefono2=$this->telefono2;
                      if($this->interno1===""){
                        $this->interno1=null;
                      }
                     if($this->interno2===""){
                        $this->interno2=null;
                      }
                   $tele->interno1=$this->interno1;$tele->interno2=$this->interno2;
                  
                   if($tele->save(false)){
                
                     $idtelefono = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo telefono ingresado
                   
                     $user = new Usuario();

                     $user->dni = $this->dni;
                     $user->imagenperfil = UploadedFile::getInstance($this, 'imagen');
                     $imagen_nombre='usu_'.$user->dni.'.'.$user->imagenperfil->extension;
                     $imagen_dir='archivo/perfil/'.$imagen_nombre;
                     $user->imagenperfil->saveAs($imagen_dir);
                     $user->imagenperfil=$imagen_dir;

                     $user->nombre=$this->nombre;$user->apellido=$this->apellido;
                     $user->nick=$this->nick;$user->direccion=$this->direccion;
                     $user->mailusuario = $this->email;$user->fechaalta=$this->fechaalta;$user->idtelefono=$idtelefono;
                     $user->idzona=$this->idzona;$user->idciudad=$this->idciudad;$user->idprovincia=$this->idprovincia;$user->idgenero=$this->idgenero;
                     $user->contrasenia=crypt($this->password, Yii::$app->params["salt"]);//Encriptamos el password
                     $user->authkey = $this->randKey("catalogo", 50);//clave será utilizada para activar el usuario
                     $user->activado=0;
                     $user->idrol=9;
                     $user->idzona=99;
                  
                     if ($user->save(false)) {
                       $idusuario = Yii::$app->db->getLastInsertID();
                     //$host=Yii::$app->request->hostInfo;
                       $comentario=new Comentario();
                       $comentario->comentario=$this->comentario;$comentario->idusuario=$idusuario;
                       if($comentario->save(false)){
                         $dni = urlencode($user->dni);
                         $nombre=$user->nombre;
                         $mailusuario = $user->mailusuario;
                         $authkey = urlencode($user->authkey);
                         $subject = "Validar direccion de correo";// Asunto del mail
                         $body = "
                         <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                                <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>
                                        <center>
                                        
                                        <h2 style='font-weight:100; color:black'>DIRECT SALE</h2>
                                        <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Hola ".$nombre." (DNI ".$dni.")</strong></h3><br>
                                        <hr style='border:1px solid #ccc; width:90%'>
                                        <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Tu registro se ingresó exitosamente. </strong></h3><br>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>Gracias por unirte a nuestro equipo</h4>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>Ahora procederemos a verificar tus datos y asignarte un lider y zona de acción de venta.</h4>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>En breve se te comunicarán los pasos a seguir para finalizr con tu incorporación.</h4>
                                       
                                        <br>
                                        <hr style='border:1px solid #ccc; width:90%'>
                                        
                                        <h5 style='font-weight:100; color:black'>Este mensaje de correo electrónico se envió a ".$mailusuario."</h5>
                                        </center>
                                </div>
                         </div>";

                        
                            $transaction->commit();
                            
                        
                        return Yii::$app->mailer->compose()
                           ->setFrom('directpresale@gmail.com')
                          //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                          ->setTo($mailusuario)
                          ->setSubject($subject)
                          ->setHTMLBody($body)
                          ->send();
                    }else{//fin sis salva comentario
                        $transaction->rollBack();
                        return null;
                    }    
                }else{//fin si salva usuario
                    $transaction->rollBack();
                    return null;
                }
              }else{//fin si salva telefono
                return null;
              }
            } catch (Exception $e) {
                $transaction->rollBack();
               
            }
         // }//fin si no valida el modelo
            //return null;
        }

        /**
     * funcion random para claves,long 50 hexa
     */
    private function randKey($str='', $long=0){//este
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }

    public function getZonadescripcion(){
        $dropciones
        =Zona::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idzona','numerozona');
    }

    public function getGenerodescripcion(){
        $dropciones=Genero::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idgenero','descripciongenero');
    }

   
    public function getCiudaddescripcion(){
        $dropciones=Ciudad::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idciudad','nombreciudad');
    }
    public function getProvinciadescripcion(){
        $dropciones=Provincia::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idprovincia','nombreprovincia');
    }
    }
