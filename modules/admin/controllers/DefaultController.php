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
        //вместо добавления в форму <input type='hidden' name='_csrf' value='<?=Yii::$app->request->getCsrfToken()!>' />

        $url = '/admin/default/catload';
        $model = new UploadForm();
        $title = 'Загрузка категорий';
        $tablestructure = '
                    <th> ID категории </th>
                    <th> ID родительской категории</th>
                    <th> Название категории </th>
                    <th> Описание категории </th>
               ';
         
         
        //return $this->render('catload', compact('model', 'title'));
        // ob_start();
        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], 'r');

        if ($handle) {

            $res = true;
            $buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode('\t', $buffer);
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
                        $category->cat_description = $row[3] == 'NULL' ? NULL : $row[3];
                        $category->save();
                    }
                }
            }
//            \Yii::$app->db->createCommand('UPDATE category SET '
//                            . ' parent_id= 0 WHERE cat_id=1')
//                    ->bindValue(':cat_id', 1)
//                    ->execute();
              \Yii::$app->db->createCommand()
                     ->delete('category','cat_id = 1')                    
                    ->execute();
        
            
            \Yii::$app->db->createCommand('UPDATE category SET '
                            . ' parent_id= 0 WHERE parent_id=1')
                    ->bindValue(':parent_id', 0)
                    ->execute();          
            
            
            echo '<br>Категории загрузились';

            //$req = ob_get_contents();
            //  ob_end_clean();
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url', 'tablestructure'));
        }
    }

    public function actionBrandload() {
        //Yii::$app->controller->enableCsrfValidation = false;
        //вместо добавления в форму <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()!>" />

        $url = '/admin/default/brandload';
        $model = new UploadForm();
        $title = 'Загрузка брендов';
        $tablestructure = '
                    <th> ID бренда </th>
                    <th> ID родительского бренда </th>
                    <th> Название бренда </th>
                 ';
        
        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], "r");
        if ($handle) {

            $res = true;
            $buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode('\t', $buffer);
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
            echo '<br>Бренды загрузились';
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url','tablestructure'));
        }
    }

    public function actionProductload() {

        $url = '/admin/default/productload';
        $model = new UploadForm();
        $title = 'Загрузка товаров';
        $tablestructure = '
                    <th> ID товара </th>
                    <th> ID категории </th>
                    <th> ID бренда </th>
                    <th> Название товара </th>
                    <th> Цена </th>
                    <th> Цена со скидкой </th>
               ';

        $handle = @fopen($_FILES['myfile']['tmp_name']['0'], "r");
        if ($handle) {
            $res = true;
            //$buffer = fgets($handle);
            while ($res) {
                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    $row = explode("\t", $buffer);
                    debug($row);
                    $product = Product::findOne($row[0]); 
                    //echo 'prod'; debug($product); 
                    $price = isset($row[4]) ? str_replace(',', '.', $row[4]) : 'NULL';
                    $discount_price = isset($row[5]) ? str_replace(',', '.', $row[5]) : 'NULL';
                    $name = str_replace('"', "'", $row[3]);

                    if (isset($product)) { 

                        $com = \Yii::$app->db->createCommand('UPDATE product SET '
                                        . ' category_id= ' . $row[1]
                                        . ',brand_id= ' . $row[2]
                                        . ', name="' . $name . '"' 
                                        . ', price=' . $price
                                        . ', discount_price=' . $discount_price
                                        //. ', price=' . (float) str_replace(',', '.', $row[4])
                                        // . '', img='no-img.png''
                                        . ' WHERE id=' . $row[0])
                                ->bindValue(':id', 5106)//;
                                ->execute();
                    } else {
                        $product = new Product();
                        $product->id = $row[0];
                        $product->category_id = $row[1];
                        $product->brand_id = $row[2];
                        $product->name = $name;
                        $product->price = $price;
                        $product->discount_price = $discount_price; 
                        //$product->img = 'no-img.png';
                        $product->description = 'нет описания';
                        $product->save();
                        
                    }
                }
            }
            // echo '<br>Товары загрузились <br>';
            //$req = ob_get_contents();
            //  ob_end_clean();
            unset($handle);
        } else {
            unset($handle);
            return $this->render('upload', compact('model', 'title', 'url', 'tablestructure'));
        }
    }

    public function actionProductsdel() {
        Product::deleteAll();
        return 'Товары удалены';
        //return $this->redirect ('/admin/product/index');
    }

}
