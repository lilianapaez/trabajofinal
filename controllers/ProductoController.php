<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Permiso;
use yii\helpers\Json;
/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
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
     * Creates a new Producto model.
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
        $model = new Producto();

        
        if ($model->load(Yii::$app->request->post())){ 
            
              $model->imagenproducto = UploadedFile::getInstance($model, 'imagen');
              if(isset($model->imagenproducto)){
              $imagen_nombre=rand(0,4000).'image_'.$model->idproveedor.'.'.$model->imagenproducto->extension;
              $imagen_dir='archivo/catalogo/'.$imagen_nombre;
           //print '<pre>';print_r ($model);print $imagen_nombre;print '</pre>';exit;
              $model->imagenproducto->saveAs($imagen_dir);
              $model->imagenproducto=$imagen_dir;
            }
           if($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->idproducto]);
           }
                
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    /**
     * Updates an existing Producto model.
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
            return $this->redirect(['view', 'id' => $model->idproducto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
public function actionGetbuscadescrip($prod){
  $producto=Producto::findOne(['idproducto'=>$prod]);
   echo Json::encode($producto);
  

}


    /**
     * Deletes an existing Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Mostramos la descripcion del codigo de producto ingresado
     * @return array
     */

    public function actionBuscadescripcion()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        print '<pre>';print_r($_POST);print '</pre>';exit;
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
           
            if ($parents != null) {
                $idproducto = $parents[0]; //Obtenemos el ID del producto

                // Buscamos el producto
                $objProducto = Producto::findOne(['idproducto'=>$idproducto]);
                $descripcion=$objProducto['descripcion'];  //Obtenemos la descripcion del producto

                $out = [
                    ['id' => $idproducto, 'name' => $descripcion]
                ];

                return ['output'=>$out, 'selected'=>$idproducto];
            }
        }
        return ['output'=>'', 'selected'=>''];

    }
}
