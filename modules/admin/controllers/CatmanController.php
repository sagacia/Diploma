<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Product;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\modules\admin\models\WatsonsProduct;

class CatmanController extends AppAdminController {

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

    public function actionIndex() {
        $products = Product::find()->with('watsons')->asArray()->limit(10)->all();
        $query = Product::find()->with('watsons');
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 20,
            'defaultPageSize' => 3,
                //'forcePageParam' => false,
                //'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->layout='catman';
        return $this->render('index', compact('products', 'category', 'pages'));
    }

    public function actionLiveSearch($srch = 'no res') {

        $srch = Yii::$app->request->get('wsearch');

        $wproducts = WatsonsProduct::find()
                ->where(['like', 'name', $srch])
                ->orWhere(['id' => $srch])
                ->limit(50)
                ->all();

        $this->layout = false;
        return $this->render('livesearch', compact('wproducts'));
    }

    public function actionAddwkey($id, $wid) {
       
        $id = Yii::$app->request->get('id');
        $wid = Yii::$app->request->get('wid');

        $product = Product::findOne($id);
        $product->watsons_id = $wid;
        $product->update();
        
        return $product->watsons['reg_price'];
    }

}
