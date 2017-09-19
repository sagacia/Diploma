<?php

namespace app\modules\crm\controllers;

use Yii;
use app\modules\crm\models\Dw;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DwController implements the CRUD actions for Dw model.
 */
class DwController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Dw models.
     * @return mixed
     */
    public function actionCalcseg() {
        $start = Yii::$app->request->get('datestart');
        $end = Yii::$app->request->get('dateend');
        $interval = Yii::$app->request->get('interval');
//        debug($start);
//        debug($end);
//        debug($interval);
        if(!isset($start)||!isset($end)||!isset($interval))
        return $this->render('calcform');
        
        $query = \Yii::$app->db->createCommand("CALL calculateSegments('".$start."','".$end."',".$interval.")")
              ->execute();

        return $this->render('calc', compact('res'));
    }

    public function actionViewseg() {

        $segments = Dw::find()
                        ->select(['segment', 'count(email) as cnt'])
                        //->where('approved = 1')
                        ->groupBy(['segment'])
                        ->createCommand()->queryAll();

        $totalemails = Dw::find()->count();



        return $this->render('viewseg', compact('segments', 'totalemails'));
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Dw::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dw model.
     * @param string $email
     * @param string $periodstart
     * @param string $periodend
     * @return mixed
     */
    public function actionView($email, $periodstart, $periodend) {
        return $this->render('view', [
                    'model' => $this->findModel($email, $periodstart, $periodend),
        ]);
    }

    /**
     * Creates a new Dw model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $res = 'here';
        return $this->render('calc', compact('res'));
        $model = new Dw();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'email' => $model->email, 'periodstart' => $model->periodstart, 'periodend' => $model->periodend]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dw model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $email
     * @param string $periodstart
     * @param string $periodend
     * @return mixed
     */
    public function actionUpdate($email, $periodstart, $periodend) {
        $model = $this->findModel($email, $periodstart, $periodend);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'email' => $model->email, 'periodstart' => $model->periodstart, 'periodend' => $model->periodend]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dw model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $email
     * @param string $periodstart
     * @param string $periodend
     * @return mixed
     */
    public function actionDelete($email, $periodstart, $periodend) {
        $this->findModel($email, $periodstart, $periodend)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dw model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $email
     * @param string $periodstart
     * @param string $periodend
     * @return Dw the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($email, $periodstart, $periodend) {
        if (($model = Dw::findOne(['email' => $email, 'periodstart' => $periodstart, 'periodend' => $periodend])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
