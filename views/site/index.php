<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Persona;
/*$userLogueado=Yii::$app->user; // Obtenemos el objeto del usuario logeado
$persona=new \app\models\Persona();
$inscrito=$persona->inscrito();*/
$this->title = 'Desafio X Bardas';

 ?>
<div id="not-full"></div>
<section id="inicio" class="contenedor-full p-0">
<?php
  /*$guardado=(isset($_REQUEST['guardado']) ? $_REQUEST['guardado']: false );
  if(isset($guardado)) {
      if(isset($_REQUEST['mensaje'])){
          if ($guardado==true) {
              ?>
              <div class="alert alert-index alert-success">
                <button type="button" class="close ml-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span><?php echo $_REQUEST['mensaje'];?></span>
              </div>
              <?php
          } else {
              ?>
              <div class="alert alert-index alert-danger">
                <button type="button" class="close ml-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span><?php echo $_REQUEST['mensaje'];?></span>
              </div>
              <?php
          }
      }

  }*/

  ?>

        <div class="overlay">

        </div>


          <?php if (Yii::$app->user->isGuest) {
            // code...
          echo '<div class="inicio-sesion">';
          echo '<a href="'.Url::to(["site/login"]).'" class="">¿Ya tenes usuario? Inicia sesión aquí</a>';
          echo '</div>';
        }
         ?>



        <div class="logo wow fadeIn">

          <img src="assets/img/logo-inicio.png" alt="logo inicio">

          <div class="wow fadeIn btn-dual text-center mt-ten relative">

            <?php if (Yii::$app->user->isGuest) {
              // code...

            echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-white btn-rounded no-margin-lr">Regístrate</a>';

          } else {
            /*if(!Persona::findOne(['idUsuario' => $_SESSION['__id']])){
              $idRol = $userLogueado->identity->idRol;
              if ($idRol == 1  || $idRol == 4 ){ // Si es gestora o administradora
                echo '<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-white btn-rounded no-margin-lr">Inscribíte</a>';
              }
            }*/
          }; ?>

            <a href="#catalogo" class="btn btn-transparent-white btn-rounded margin-20px-lr sm-margin-5px-top">Conocé más</a>
          </div>

        </div>

        </section>
        <section class="half-section cover-background" style="background-image:url('assets/img/fondo.jpg');">
            <!-- Seccion fecha -->
            <div class="container">

                <div class="jumbotron wow fadeIn">

                    

                </div>

            </div>

        </section>
        <!-- Seccion slogan -->
        <section class="half-section">

        <div class="container">

          <div class="slogan">

              <div class="jumbotron wow fadeIn">

                  

              </div>

          </div>

        </div>

        </section>

        <section id="catalogo" class="parallax cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">

        <div class="container">

          <div class="row">
              <div class="col-xs-12 col-md-6">
                  

                    <div class="row sm-center">

                      <?php if (Yii::$app->user->isGuest) {
                        // code...

                      echo '<a href="'.Url::to(["/site/registro"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Regístrate</a>';

                    } /*if($inscrito==2) {

                      echo'<a href="'.Url::to(["/inscripcion"]).'" class="btn btn-grande btn-rounded btn-carrera mt-20 mb-80">Inscribíte</a>';

                    }; */?>

                    </div>

              </div>
              <div class="col-xs-12 col-md-6 bardas-list">
                  
                 
              </div>
          </div>

        </div>

        </section>

        <section id="grupotrabajo" class="full-section">



          <div class="row ml-50 mr-50">

            <div class="col-xs-12 col-md-3 ">

              

            </div>


            <div class="col-xs-12 col-md-5  ">

              


            </div>

            <div class="col-xs-12 col-md-2 ">

              
            </div>

            <div class="col-xs-12 col-md-2 ">

              
            </div>

          </div>




        </section>

        <section id="visita" style="background-image:url('assets/img/fondo.jpg');" class="p-0 full-section">

          <div class="container-fluid mb-100">

           
          </div>
        </section>
        <!-- Seccion imagen/texto-->
        <section id="novedades" class="p-0">

        <div class="container-fluid height-100">

          <div class="row ">

              <div class="col-md-6 cover-background height-100vh sm-hidden" style="background-image:url('assets/img/mujer.jpg');">
              </div>

              <div class="col-md-6 pt-50 pb-0 full-section">

                

                <div class="row text-center">
                  
                </div>

              </div>

          </div>

        </div>

        </section>

        <section id="contacto" style="background-image:url('assets/img/fondo.jpg');" class="full-section">

        <div class="container">

          <div class="row">

            <div class="col-xs-12 col-md-5">
                



              <div class="clock-container mt-ten mb-50 color-black">

               

              </div>

            </div>
            <div class="site-contact"></div>
              <div class="col-xs-12 col-md-7 no-label">
                <h4 class="titulo-primario" id="contacto">Contactanos</h3>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="form-group">
                       <?= $form->field($model, 'email')->textInput(['class'=>'input-db','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp',' placeholder'=>'E-mail *']) ?>
                    </div>
                    <div class="form-group">
                       <?= $form->field($model, 'subject')->textInput(['class'=>'input-db','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp',' placeholder'=>'Asunto *']) ?>
                    </div>
                    <div class="form-group">
                       <?= $form->field($model, 'body')->textarea(['class'=>'input-db','id'=>'exampleInputComentario','placeholder'=>'Ingrese su mensaje... *','rows' => 3]) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-grande btn-rounded btn-carrera mt-10', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
              </div>
            </div>
          </div>

        </div>
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
        Gracias por contactarnos. Responderemos en breve :)
        </div>
        <?php endif; ?>
        </section>
        <section id="footer">
          <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                  <li class="list-inline-item"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><a href="#" target="_blank">Direct Sale</a></p>
              </div>
            </div>
          </div>
        </section>
