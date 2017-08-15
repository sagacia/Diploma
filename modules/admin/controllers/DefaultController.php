<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Category;
use app\modules\admin\models\Brand;
use app\modules\admin\models\Product;
use app\modules\admin\models\UploadForm;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $model = new UploadForm();
        return $this->render('index', compact('model'));
    }

    public function actionCatload() {
        //Yii::$app->controller->enableCsrfValidation = false;
        //вместо добавления в форму <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()!>" />
       
        $url = '/admin/default/catload';
        $model = new UploadForm();
        $title = 'Загрузка категорий';
        //return $this->render('catload', compact('model', 'title'));
        // ob_start();
        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], "r");
        
        if ($handle) {

            $res = true;
            $buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode("\t", $buffer);
                    $category = Category::findOne($row[0]);
                    if (isset($category)) {
                        $description = $row[3] == "NULL" ? NULL : $row[3];
                        \Yii::$app->db->createCommand('UPDATE category SET '
                                        . ' parent_id= ' . $row[1]
                                        . ', cat_name="' . $row[2]
                                        . '", cat_description="' . $row[3] . '"' . " WHERE cat_id=" . $row[0])
                                ->bindValue(':cat_id', $row[0])
                                ->execute();
                    } else {
//                        var_dump($row[0]);return;
                        $category = new Category();
                        $category->cat_id = $row[0];
                        $category->parent_id = $row[1];
                        $category->cat_name = $row[2];
                        $category->cat_description = $row[3] == "NULL" ? NULL : $row[3];
                        $category->save();
                    }
                }
            }
            \Yii::$app->db->createCommand('UPDATE category SET '
                            . ' parent_id= 0 WHERE cat_id=1')
                    ->bindValue(':cat_id', 1)
                    ->execute();
            echo "<br>Категории загрузились";

            //$req = ob_get_contents();
            //  ob_end_clean();
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url'));
        }
    }

    public function actionBrandload() {
        //Yii::$app->controller->enableCsrfValidation = false;
        //вместо добавления в форму <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()!>" />

        $url = '/admin/default/brandload';
        $model = new UploadForm();
        $title = 'Загрузка брендов';
        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], "r");
        if ($handle) {

            $res = true;
            $buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode("\t", $buffer);
                    $brand = Brand::findOne($row[0]);
                    if (isset($brand)) {
                        \Yii::$app->db->createCommand('UPDATE brand SET '
                                        . ' parent_id = ' . $row[1]
                                        . ', brand_name ="' . $row[2]
                                        . '" WHERE brand_id =' . $row[0])
                                ->bindValue(':brand_id', $row[0])
                                ->execute();
                    } else {
                        $brand = new Brand();
                        $brand->brand_id = $row[0];
                        $brand->parent_id = $row[1];
                        $brand->brand_name = $row[2];
                        $brand->save();
                    }
                }
            }
            echo "<br>Бренды загрузились";
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url'));
        }
    }

    public function actionProductload() {

        $url = '/admin/default/productload';
        $model = new UploadForm();
        $title = 'Загрузка товаров';

        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], "r");
        if ($handle) {
            $res = true;
            $buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode("\t", $buffer);
                    $product = Product::findOne($row[0]);
                    if (isset($product)) {
                        \Yii::$app->db->createCommand('UPDATE product SET '
                                        . ' category_id= ' . $row[1]
                                        . ',brand_id= ' . $row[2]
                                        . ', product_name="' . $row[3]
                                        . '", img="no-img.png"'
                                        . " WHERE product_id=" . $row[0])
                                ->bindValue(':product_id', 5106)
                                ->execute();
                    } else {
                        $product = new Product();
                        $product->product_id = $row[0];
                        $product->category_id = $row[1];
                        $product->brand_id = $row[2];
                        $product->product_name = $row[3];
                        $product->img = "no-img.png";
                        $product->description = "нет описания";
                        $product->save();
                    }
                }
            }
            echo "<br>Товары загрузились";

            //$req = ob_get_contents();
            //  ob_end_clean();
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url'));
        }
    }

    public function actionProductsdel() {
        Product::deleteAll();
        return "Товары удалены";
        //return $this->redirect ('/admin/product/index');
    }

}
