<?php

namespace app\controllers;

use Yii;
use app\models\Imagepageproducto;
use app\models\ImagepageproductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImagepageproductoController implements the CRUD actions for Imagepageproducto model.
 */
class ImagepageproductoController extends Controller
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
     * Lists all Imagepageproducto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagepageproductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagepageproducto model.
     * @param integer $idimagepage
     * @param integer $idproducto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idimagepage, $idproducto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idimagepage, $idproducto),
        ]);
    }

    /**
     * Creates a new Imagepageproducto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imagepageproducto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idimagepage' => $model->idimagepage, 'idproducto' => $model->idproducto]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Imagepageproducto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idimagepage
     * @param integer $idproducto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idimagepage, $idproducto)
    {
        $model = $this->findModel($idimagepage, $idproducto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idimagepage' => $model->idimagepage, 'idproducto' => $model->idproducto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Imagepageproducto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idimagepage
     * @param integer $idproducto
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idimagepage, $idproducto)
    {
        $this->findModel($idimagepage, $idproducto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Imagepageproducto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idimagepage
     * @param integer $idproducto
     * @return Imagepageproducto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idimagepage, $idproducto)
    {
        if (($model = Imagepageproducto::findOne(['idimagepage' => $idimagepage, 'idproducto' => $idproducto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
