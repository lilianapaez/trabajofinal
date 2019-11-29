<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use app\models\Pedido;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Pedidoproducto;
use app\models\Productocatalogo;
use app\models\Catalogo;
use app\models\Permiso;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
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
     * Lists all Pedido models.
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
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
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
     * Creates a new Pedido model.
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
        $model1 = new Pedido();
        $model=Catalogo::findOne(['idcatalogo'=>$id]);
        
        //print '<pre>';print_r($catalogo);print '</pre>';exit;
       
            if ($model1->load(Yii::$app->request->post())){
                $model1->fechapedido = date("Y-m-d", strtotime($model1->fechapedido));//de d-m-Y a Y-m-d
                if($model1->save()){
                    $idpedido = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo pedido ingresado
                        return $this->redirect(['pedidoproducto/create', 
                            'id' => $idpedido,
                        ]);
                    }
             }
            
        return $this->render('create', [
            'model1' => $model1,
            'model'=>$model,
        ]);
    }

    /**
     * Updates an existing Pedido model.
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
            return $this->redirect(['view', 'id' => $model->idpedido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedido model.
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
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPdfremito1($id){
        $model = $this->findModel($id);

        return $this->render('pdfremitos', [
            'model' => $model,
        ]);
    }

    
    
        public function actionPdfremito($id) {

            $data = $this->findModel($id);
            // get your HTML raw content without any layouts or scripts
            $content = $this->renderPartial('_pdfremito',['model' => $data]);
            
            // setup kartik\mpdf\Pdf component
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                 // set mPDF properties on the fly
                'options' => ['title' => 'Remito de pedidos'],
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>['Remito pedidos'], 
                    'SetFooter'=>['{PAGENO}'],
                ]
            ]);
            
            // return the pdf output as per the destination setting
            return $pdf->render(); 
        }




public function actionPdfremito2($id) {

    $data = $this->findModel($id);

    // get your HTML raw content without any layouts or scripts
    $content = $this->renderPartial('pdfremitos', ['model' => $data]);

    $destination = Pdf::DEST_BROWSER;
    //$destination = Pdf::DEST_DOWNLOAD;

    $filename = $data->file_name . ".pdf";

    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_UTF8,
        // A4 paper format
        'format' => Pdf::FORMAT_A4,
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT,
        // stream to browser inline
        'destination' => $destination,
        'filename' => $filename,
        // your html content input
        'content' => $content,
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => 'p, td,div { font-family: freeserif; }; body, p { font-family: irannastaliq; font-size: 15pt; }; .kv-heading-1{font-size:18px}table{width: 100%;line-height: inherit;text-align: left; border-collapse: collapse;}table, td, th {border: 1px solid black;}',
        'marginFooter' => 5,
        // call mPDF methods on the fly
        'methods' => [
            'SetTitle' => ['SAMPLE PDF'],
            //'SetHeader' => ['SAMPLE'],
            'SetFooter' => ['Page {PAGENO}'],
        ]
    ]);

    // return the pdf output as per the destination setting
    return $pdf->render();
}
}
