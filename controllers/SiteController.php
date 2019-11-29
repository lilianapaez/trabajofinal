<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Usuario;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistroForm;
use app\models\RecupassForm;
use app\models\CambiapassForm;
use app\models\Permiso;

class SiteController extends Controller
{
    public $usuario_log;
    /**
     * {@inheritdoc}
     */

     public function init() {
        $this->usuario_log = (!empty($_SESSION['__id'])) ? $_SESSION['__id'] : 0;
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index,view,create,update,delete,recupass,cambiapass'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login','registro','recupass'],
                        'roles' => ['?'],
                    ],

                    [
                        'actions' => ['index,view,create,update,delete,logout, admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo(1);
                        }
                    ],
                    [
                        'actions' => ['index,view,create,delete,logout,gestor'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('gestor') && Permiso::requerirActivo(1);
                        }
                    ],
					[
                        'actions' => ['index,view,create,update,delete,logout, lider'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('lider') && Permiso::requerirActivo(1);
                        }
                    ],
					[
                        'actions' => ['index,view,create,update,delete,logout,vendedor'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('vendedor') && Permiso::requerirActivo(1);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
        //return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $mensaje="";
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Permiso::requerirActivo(0)){// activado=1,desactivado=0
                Yii::$app->user->logout();
                if (Yii::$app->user->isGuest) {
                   $mensaje="Tu cuenta no ha sido activada.";
                   $mensaje.= "Por favor haz clic en el enlace para la verificación y/o activación, abre tu correo para activar tu cuenta";
                   return $this->render('correo', [
                      'mensaje' => $mensaje,
                      'model'=>$model,
                    ]);
                }
            }else{
                if (Permiso::requerirRol('administrador')){
                    return $this->redirect(["site/admin"]);
                }elseif(Permiso::requerirRol('gestor')){
                    return $this->redirect(["site/gestor"]); 
                }elseif(Permiso::requerirRol('lider')){
                    return $this->redirect(["site/lider"]); 
                }elseif(Permiso::requerirRol('vendedor')){
                    return $this->redirect(["site/vendedor"]); 
                }      
            }
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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

    /**
     * funcion registro de usuarios
     */
    public function actionRegistro()
    {
       
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $mensaje='';
        $model = new RegistroForm();
        if ($model->load(Yii::$app->request->post())) {
            //echo '<pre>';echo print_r($model);echo '</pre>';die();
            if ($model->signup()) {
                    //vaciamos valores
						   $model->dni = ''; $model->password = ''; $model->email = '';
                        Yii::$app->session->setFlash('registroFormSubmitted');
                        return $this->refresh();
                }else{
                    $mensaje="Este mensaje es para avisarte que tu DNI ya existe en nuestro registro o falló el envio del email.";
                     $mensaje.="Te reenviaremos un email para verificar y activar tu cuenta.";
                     $mensaje.="De persistir este mensaje por favor comunícate con el administrador.";
                     $mensaje.="Utiliza nuestro formulario contactos al pie de la página principal.";
                     return $this->render('correo', [
                        'model' => $model,
                        'mensaje'=>$mensaje,
                     ]);
                }
            }
        $model->dni = '';$model->password = '';$model->idciudad = '';$model->idprovincia = '';$model->email = '';
        return $this->render('registro', [
            'model' => $model,
        ]);
    }

public function actionEnviomail(){
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }
    $mensaje='';
    if (Yii::$app->request->get()) {
      $d = Html::encode($_GET["1"]);
      if($user=Usuario::findOne(['dni'=>$d])){//verificamos que exista el usuario
        $dni = urlencode($user->dni);
        $mailusuario = $user->mailusuario;
        $authkey = urlencode($user->authkey);
        $subject = "Validar direccion de correo";// Asunto del mail
       // $host=Yii::$app->request->hostInfo;
        $body = "
            <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                    <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>
                            <center>
                                                            
                            <h2 style='font-weight:100; color:black'>DIRECT SALE</h2>
                            <hr style='border:1px solid #ccc; width:90%'>
                            <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Reenviamos el email para validacion y/o activacion de tu cuenta. </strong></h3><br>
                            <h4 style='font-weight:100; color:black; padding:0 20px'>Gracias por ser parte de nuestro equipo</h4>
                            <h4 style='font-weight:100; color:black; padding:0 20px'>Para finalizar su registro por favor valide su cuenta ingresando al siguiente enlace</h4>
                            <a href='http://localhost/basic/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."' style='text-decoration:none'>
                            <div style='line-height:60px; background:#ff8f04; width:60%; color:white'>Validar cuenta</div>
                            </a>
                            <br>
                            <hr style='border:1px solid #ccc; width:90%'>
                            
                            <h5 style='font-weight:100; color:black'>Este mensaje de correo electrónico se envió a ".$mailusuario."</h5>    
                            
                            </center>
                    </div>
            </div>";   
            Yii::$app->mailer->compose()
            //->setFrom('directpresale@gmail.com')
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
            ->setTo($mailusuario)
            ->setSubject($subject)
            ->setHTMLBody($body)
            ->send();
           $mensaje="Reenviamos un email de verificación y/o activación a tu correo, ábrelo para activar tu cuenta";
           return $this->render('aviso',[
               'mensaje'=>$mensaje
               ]);
        }else{
            $mensaje="Este mensaje es para avisarte que tu DNI no existe en nuestro registro.";
            $mensaje.="Por favor ingresa nuevamente al formulario para registrarte.";
            $mensaje.="De persistir este mensaje, comunícate con el administrador.";
            $mensaje.="Utiliza nuestro formulario contactos al pie de la página principal.";
            return $this->render('error', [
               'mensaje'=>$mensaje,
            ]);
        }
     }
}
    /**
     * Displays activa cuenta.
     *
     * @return string
     */
     public function actionActivarcuenta() {
     if (Yii::$app->request->get()){
         //si ya activo la cuenta
         if(Usuario::findOne(['dni'=>$_GET['d']])!=null && Usuario::findOne(['dni'=>$_GET['d']])->activado==1){
             $mensaje="El usuario ya se encuentra activado!! Inicia sesión. ";
             return $this->render('error', ['mensaje' => $mensaje]);

         }
        $dni = Html::encode($_GET["d"]);
        $authkey =Html::encode($_GET["c"]);
        $usuActivar = Usuario::getElusuario($dni,$authkey);

       if (!empty($usuActivar)) {
            $activar = Usuario::findOne($usuActivar->idusuario);
            $activar->activado = 1;
            $activar->authkey = $this->randKey("AxWb98760z", 50);//nueva clave será utilizada para activar el usuario
            if ($activar->save()){
                        echo "Registro llevado a cabo correctamente. Serás  redirigido ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/login")."'>";
           } else {
               $mensaje="No se pudo activar la cuenta, comunicate con el administrador";
               return $this->render('error', ['mensaje' => $mensaje]);
            }
       }else{
             $mensaje="No existe usuario registrado con ese numero de documento, vuelva a intentarlo";
             return $this->render('error', ['mensaje' => $mensaje]);
       }
     }else{
      $mensaje="Ups!! hubo un inconveniente, vuelve a intentarlo";
      return $this->render('error', ['mensaje' => $mensaje]);
     }
}

     /**
     * funcion recuperar password.
     *
     *  @return string
     */
    public function actionRecupass(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RecupassForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('registroFormSubmitted');
                //return $this->refresh();

                echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                //return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Hubo un problema, vuelve a intentarlo.');
            }
        }
        $model->dni='';$model->email='';
        return $this->render('recupass', [
            'model' => $model,
        ]);
    }
    /**
     * Displays cambia password.
     *
     * @return string
     */
    public function actionCambiapass(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        $model = new CambiaPassForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->validaCambio()) {
                Yii::$app->user->logout();//se cierra la sesion
                if (Yii::$app->user->isGuest) {
                    return $this->redirect(["site/login"]); //se redirige a iniciar sesion
                }
            } else {
                Yii::$app->getSession()->setFlash('error', 'Hubo un problema, vuelve a intentarlo.');
            }
        }
        return $this->render('cambiapass', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays admin page.
     *
     * @return string
     */
    public function actionAdmin(){
        $this->layout = '/main2';
        return $this->render('administrar');
}
/**
 * Displays admin page.
 *
 * @return string
 */
    public function actionGestor(){
        $this->layout = '/main1';
        return $this->render('gestionar');
}

/**
 * Displays admin page.
 *
 * @return string
 */
public function actionLider(){
    $this->layout = '/main2';
    return $this->render('liderar');
}
/**
 * Displays admin page.
 *
 * @return string
 */
public function actionVendedor(){
    $this->layout = '/main3';
    return $this->render('vender');
}

}
