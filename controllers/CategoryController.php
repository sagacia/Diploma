<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use app\models\Brand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\ProductController;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AppController {

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
        $this->setMeta('Космо');

        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id = null, $brandid = null) {

        // $id = Yii::$app->request->get('id'); //для функции без параметра
        $category = Category::findOne($id);
        $brandd = Brand::findOne($brandid);

        if (empty($category)) {
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }

        // $products = Product::find()->where(['category_id' => $id ])->all();
        if ($brandid == null) {
            $query = Product::find()->where(['category_id' => $id]);
            $this->setMeta('Космо | ' . $category->cat_name, $category->cat_name, $category->cat_description);
        } else {
            $query = Product::find()->where(['category_id' => $id, 'brand_id' => $brandid]);
            $this->setMeta('Космо | ' . $category->cat_name . ' | ' . $brandd->brand_name, $category->cat_name . ' | ' . $brandd->brand_name, $category->cat_description);
        }
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 12,
            'defaultPageSize' => 12,
                //'forcePageParam' => false,
                //'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $brands = Brand::find()//->select('product.*')
                ->leftJoin('product', 'brand.brand_id = product.brand_id')
                ->where('product.category_id =' . $id)
                ->all();

        /* $dataProvider = new ActiveDataProvider([
          'query' => Product::find()->where(['category_id' => $id]),
          'pagination' => ['pageSize' => 2],
          ]); */


        return $this->render('view', compact('products', 'category', 'pages', 'brands', 'brandd'));
    }

    public function actionSearch() {
        $srch = Yii::$app->request->get('srch');
        $query = Product::find()->where(['like', 'name', $srch])->orWhere(['id' => $srch]);
        //$query = Product::find()->where(['id' => $srch]);

        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 12,
            'defaultPageSize' => 12,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'srch'));
    }

    public function actionLiveSearch($srch = 'no res') {
        //$srch = '<div>'.'smth'.'</div>'; 
        $srch = Yii::$app->request->get('search');

        //return $srch;
        //$query = Product::find()->where(['like', 'product_name', $srch])->orWhere(['id' => $srch])->all();
        $products = Product::find()->where(['like', 'name', $srch])->orWhere(['id' => $srch])->limit(10)->all();
//        if ($query) {
//            
//            foreach ($query as $q) {
//                echo "<div>" . $q->product_name . "</div>";
//            }
//        } else {
//            echo "Нет результатов";
//        }
              //  return $srchRes;
       // return;
        $this->layout=false;
         return $this->render('livesearch', compact('products'));
    }

    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
