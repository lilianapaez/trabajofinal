<?php

namespace app\controllers;

use Yii;
use app\models\Productocatalogo;
use app\models\ProductocatalogoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductocatalogoController implements the CRUD actions for Productocatalogo model.
 */
class ProductocatalogoController extends Controller
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
     * Lists all Productocatalogo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductocatalogoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productocatalogo model.
     * @param integer $idproducto
     * @param integer $idcatalogo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idproducto, $idcatalogo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idproducto, $idcatalogo),
        ]);
    }

    /**
     * Creates a new Productocatalogo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productocatalogo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idproducto' => $model->idproducto, 'idcatalogo' => $model->idcatalogo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Productocatalogo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idproducto
     * @param integer $idcatalogo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idproducto, $idcatalogo)
    {
        $model = $this->findModel($idproducto, $idcatalogo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idproducto' => $model->idproducto, 'idcatalogo' => $model->idcatalogo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Productocatalogo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idproducto
     * @param integer $idcatalogo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idproducto, $idcatalogo)
    {
        $this->findModel($idproducto, $idcatalogo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productocatalogo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idproducto
     * @param integer $idcatalogo
     * @return Productocatalogo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproducto, $idcatalogo)
    {
        if (($model = Productocatalogo::findOne(['idproducto' => $idproducto, 'idcatalogo' => $idcatalogo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
