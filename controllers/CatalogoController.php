<?php

namespace app\controllers;

use Yii;
use app\models\Catalogo;
use app\models\CatalogoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Permiso;

/**
 * CatalogoController implements the CRUD actions for Catalogo model.
 */
class CatalogoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Catalogo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('gestor')){
            $this->layout='/main1';
          }
        $searchModel = new CatalogoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['vigente' =>0]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Catalogo models.
     * @return mixed
     */
    public function actionIndex2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('gestor')){
            $this->layout='/main1';
          }
        $searchModel = new CatalogoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['vigente' =>1]);
                            
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Catalogo models.
     * @return mixed
     */
    public function actionIndex1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $searchModel = new CatalogoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['vigente' =>0]);
                            
        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalogo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Catalogo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $model = new Catalogo();

        if ($model->load(Yii::$app->request->post())){

            $model->imagencatalogo = UploadedFile::getInstance($model, 'imagen');
            $imagen_nombre=rand(0,4000).'cat_'.$model->campania.'.'.$model->imagencatalogo->extension;
           $imagen_dir='archivo/catalogo/'.$imagen_nombre;
           $model->imagencatalogo->saveAs($imagen_dir);
           $model->imagencatalogo=$imagen_dir;
           $model->vigente=0;

         if($model->save(false)) {
            //$idcatalogo = Yii::$app->db->getLastInsertID();
            return $this->redirect(['view', 'id' => $model->idcatalogo]);
        }
    }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Catalogo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcatalogo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Catalogo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Catalogo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catalogo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalogo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCatalogo() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idmarca = $parents[0];

                $out = Catalogo::getListCatalogo($idmarca); 
            
                return ['output'=>$out, 'selected'=>'100'];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionCatalogos($id){
        echo HtmlHelpers::dropDownList(Departamentos::className(), 'idmarca', $id, 'idcatalogo', 'campania');
    }
}
