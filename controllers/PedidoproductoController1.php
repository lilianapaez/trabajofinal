<?php

namespace app\controllers;

use Yii;
use app\models\Pedidoproducto;
use app\models\PedidoproductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Pedido;
use app\models\Productocatalogo;
use app\models\Permiso;

/**
 * PedidoproductoController implements the CRUD actions for Pedidoproducto model.
 */
class PedidoproductoController extends Controller
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
     * Lists all Pedidoproducto models.
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
        $searchModel = new PedidoproductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedidoproducto model.
     * @param integer $nrodetalle
     * @param integer $idpedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nrodetalle)
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
            'model' => $this->findModel($nrodetalle),
        ]);
    }

    /**
     * Creates a new Pedidoproducto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $model1 = new Pedidoproducto();
        $model=Pedido::findOne(['idpedido'=>$id]);
        $searchModel = new PedidoproductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['idpedido' =>$id]);

        if ($model1->load(Yii::$app->request->post()) && $model1->save()) {
            $procat=ProductoCatalogo::buscaProducto($model1->idproducto);
            $procat->cantidadacumulado=$procat->cantidadacumulado + $model1->cantidadproducto;
            if($procat->save()){
               //return $this->redirect(['view', 'nrodetalle' => $model1->nrodetalle]);
               $model1->nrodetalle="";$model1->idproducto="";$model1->cantidadproducto="";$model1->preciopublico="";$model1->idpedido="";
               //$model1 = new Pedidoproducto();
               return $this->render('create', [
                'model' => $model,
                'model1'=>$model1,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'model1'=>$model1,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Pedidoproducto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $nrodetalle
     * @param integer $idpedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nrodetalle)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $model = $this->findModel($nrodetalle);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'nrodetalle' => $model->nrodetalle]);
            return;
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedidoproducto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $nrodetalle
     * @param integer $idpedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nrodetalle)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
          if(Permiso::requerirRol('lider')){
            $this->layout='/main2';
          }elseif(Permiso::requerirRol('vendedor')){
            $this->layout='/main3';
          }
        $this->findModel($nrodetalle)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedidoproducto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $nrodetalle
     * @param integer $idpedido
     * @return Pedidoproducto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nrodetalle)
    {
        if (($model = Pedidoproducto::findOne(['nrodetalle' => $nrodetalle])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
