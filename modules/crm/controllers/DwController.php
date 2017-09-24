<?php

namespace app\modules\crm\controllers;

use Yii;
use app\modules\crm\models\Dw;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use app\modules\crm\models\Proposal;

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

    public function actionCalcseg() {
        $start = Yii::$app->request->get('datestart');
        $end = Yii::$app->request->get('dateend');
        $interval = Yii::$app->request->get('interval');
//        debug($start);
//        debug($end);
        //  debug($interval);
        if ($start > $end) {
            Yii::$app->session->setFlash('notification', 'Конечная дата не может быть больше начальной');
            return $this->render('calcform', compact('start', 'end', 'interval'));
        }
        if (!isset($start) || !isset($end) || !isset($interval)) {
            return $this->render('calcform', compact('start', 'end', 'interval'));
            //  return $this->render('calcform', ['start'=>$start, 'end'=>$end, 'interval'=>$interval]);
        }

        $exists = Dw::find()
                ->select(['segment'])
                ->where('periodstart = ' . $start . ' and periodend = ' . $end)
                ->count();
        if ($exists != 0) {

            Yii::$app->session->setFlash('notification', 'За этот период сегменты уже расчитаны');
            return $this->render('calcform', compact('start', 'end', 'interval'));
        }

        $query = \Yii::$app->db->createCommand("CALL calculateSegments('" . $start . "','" . $end . "'," . $interval . ")")
                ->execute();

        Yii::$app->session->setFlash('notification', 'Сегменты готовы');
        return $this->render('calcform', compact('start', 'end', 'interval'));
    }

    public function actionViewseg() {
        $maxend = DW::find()->orderBy('periodend desc')->one();

        $segments = Dw::find()
                        ->select(['segment', 'count(email) as cnt'])
                        ->where('periodend ="' . $maxend['periodend'] . '"')
                        ->groupBy(['segment'])
                        ->createCommand()->queryAll();



        $totalemails = Dw::find()->where('periodend ="' . $maxend['periodend'] . '"')->count();
        return $this->render('viewseg', compact('segments', 'totalemails'));
    }

    public function actionCommunication() {

        $maxend = DW::find()->orderBy('periodend desc')->one();

        $segments = Dw::find()
                        ->select(['segment'])
                        ->distinct()
                        ->where('periodend ="' . $maxend['periodend'] . '"')
                        // ->groupBy(['segment'])
                        ->createCommand()->queryAll();

        $categories = Product::find()
                ->select(['category_id', 'category.cat_name'])
                ->leftJoin('category', '`product`.`category_id` = `category`.`cat_id`')
                ->distinct()
                ->where('category.cat_name is not null')
                ->orderBy('category.cat_name ASC')
                ->createCommand()
                ->queryAll();

        // debug($categories);
        //return;



        $totalemails = Dw::find()->where('periodend ="' . $maxend['periodend'] . '"')->count();
        return $this->render('communication', compact('segments', 'categories', 'totalemails'));
    }

    public function actionPreproposal($segstr, $catstr) {
        //$selectedCategoriess = Yii::$app->request->get('catstr');
        //echo 'ok'; return;
        $segstr = substr($segstr, 0, -1);
        $catstr = substr($catstr, 0, -1);
        $maxend = DW::find()->orderBy('periodend desc')->one();
        $where = 'periodend ="' . $maxend['periodend'] . '"';
        if (!empty($segstr)) {
            $segin = '';
            $segarr = explode(',', $segstr);
            foreach ($segarr as $seg) {
                $segin .= '"' . $seg . '",';
            }
            $segin = substr($segin, 0, -1);
            $where .= ' and dw.segment in (' . $segin . ')';
        }

        if (!empty($catstr))
            $where .= ' and category.cat_id in ("' . $catstr . '")';

        $query = Dw::find()
                        ->select(['dw.segment, count(distinct dw.email) as cnt'])
                        ->distinct()
                        ->leftJoin('order', '`dw`.`email` = `order`.`email`')
                        ->leftJoin('order_items', '`order`.`id` = `order_items`.`order_id`')
                        ->leftJoin('product', '`order_items`.`product_id` = `product`.`id`')
                        ->leftJoin('category', '`product`.`category_id` = `category`.`cat_id`')
                        ->where($where)
                        ->groupBy('dw.segment')
                        ->createCommand()->queryAll();
        $emails = Dw::find()
                        ->select(['dw.email', 'dw.segment'])
                        ->distinct()
                        ->leftJoin('order', '`dw`.`email` = `order`.`email`')
                        ->leftJoin('order_items', '`order`.`id` = `order_items`.`order_id`')
                        ->leftJoin('product', '`order_items`.`product_id` = `product`.`id`')
                        ->leftJoin('category', '`product`.`category_id` = `category`.`cat_id`')
                        ->where($where)
                        //->groupBy('dw.segment')
                        ->createCommand()->queryAll();
        //  debug($emails);
        //  debug($query);
        //  return;

        $proposals = Proposal::find()->all();


        $totalemails = Dw::find()->where('periodend ="' . $maxend['periodend'] . '"')->count();
        //$this->layout = null; //а я его тут убираю...
        // die(var_dump($this));
        return $this->renderPartial('preproposal', compact('query', 'emails', 'totalemails', 'proposals'));
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Dw::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSendemails($emails, $proposalid) {
        echo 'пришли emails';
        $qproposal = Proposal::find($proposalid)->one();
        $emails = substr($emails, 0, -1);
        $emailss = explode(',', $emails);
        echo $qproposal->message;
        foreach ($emailss as $em) {
             Yii::$app->mailer->compose('proposal', compact('qproposal'))
                        ->setFrom(['test@mail.tt'=>'Предложение от Космо'])
                        ->setTo($em) //продублировать для администратора Yii::$app->params['adminEmail']
                        ->setSubject('Предложение от Космо')
                        ->send();
            
        }
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
