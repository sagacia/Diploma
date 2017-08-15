<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Brand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\admin\models\WatsonsProduct;

//use Faker\Provider\tr_TR\DateTime;

include "simple_html_dom.php";

class WatsonsController extends Controller {

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

    public function actionDownloadproducts() {
        //echo date('H\hi l d F', time());
        //return;

        $source = "http://www.watsons.ua";

        $html = file_get_html($source);
        //  debug('старт');
        // return;

        $count = 0;
        $total = 0;
        //родительская категория
        foreach ($html->find('#mainNavHolder li[class="dropdown-col-text"]') as $element) {
            if ($count !== 0) {
                //подкатегория
                foreach ($element->find('li') as $el) {
                    if ($el->class == 'top-level') {
                        foreach ($subcatlink = $el->find('a') as $sclink) {
                            //$page = 1;
                            $subcathtml = file_get_html($source . $sclink->href);  // получаем ссылку субкатегории
                            $pages = count($subcathtml->find('#pagerDown a')) - 2; //получаем количество страниц в подкатегории
                            echo 'до корректировки ' . $pages . '<br>'; //
                            if ((int) $pages < 1)
                                $pages = 1;
                            //echo 'pages== ' . $pages . '<br>'; //
                            debug($sclink->href); //

                            $link = $subcathtml->find('#pagerDown a ', 1);
                            //$paginationPage = $link->{'data-href'}; //$currentPage = $link->getAttribute('data-href');
                            //проходимся по каждой странице
                            for ($i = 0; $i < $pages; $i++) {
                                $currentPage = $source . $sclink->href . '?q=:ranking&page=' . $i . '&resultsForPage=27&text=&sort=ranking';
                                $currentHtml = file_get_html($currentPage);
                                // $new = 0;
                                //$old = 0;
                                //$subtotal=0;
                                //  debug($currentHtml->innertext);
                                foreach ($currentHtml->find('.product-panel') as $product) {
                                    //debug('================product=================');
                                    $hrefId = $product->find('.variantsOverlay a', 0)->href;
                                    $id = trim(substr(strrchr($hrefId, 'BP_'), 3));
                                    $name = trim($product->find('.brand-ellipsis', 0)->innertext);
                                    $_price = $product->find('.main-price', 0)->innertext;
                                    $price = str_replace(',', '.', trim(substr($_price, 0, stripos($_price, 'грн'))));
                                    $_discount_price = $product->find('.memberPriceOverlay span', 0)->innertext;
                                    $discount_price = str_replace(',', '.', trim(substr($_discount_price, 0, stripos($_discount_price, 'грн'))));
                                    ($discount_price < 0) ? 'NULL' : $discount_price;
                                    $total++;

                                    $wproduct = WatsonsProduct::findOne($id);
                                    if (!isset($wproduct)) {
                                        debug('================ новый продукт =================');
                                        debug($total);
                                        $wproduct = new WatsonsProduct();
                                        $wproduct->id = $id;
                                        $wproduct->name = $name;
                                        $wproduct->reg_price = $price;
                                        $wproduct->discount_price = $discount_price;
                                        // $wproduct->updated_at = getdate(time());
                                        $wproduct->save();
                                        //  $new++;
                                        // debug($id);
                                        // debug($name);
                                        // debug($price);
                                        //  debug($discount_price);
                                        //debug(($discount_price)<2);
                                    } else {
                                        debug('================ старый обновленный =================');
                                        debug($total);
                                      //  $wproduct->id = $id;
                                        $wproduct->name = $name;
                                        $wproduct->reg_price = $price;
                                        $wproduct->discount_price = $discount_price;
                                        //$wproduct->updated_at = getdate(time());
                                        $wproduct->save();
//                                        $wproduct->update();
                                        // $old++;
//                                        \Yii::$app->db->createCommand('UPDATE watsonsproduct SET '
//                                                        . ' id= ' . $id
//                                                        . ', name="' . $name
//                                                        . '", reg_price="' . $price
//                                                        . '", discount_price="' . $discount_price
//                                                        . '"' . " WHERE id=" . $id)
//                                                ->bindValue(':id', $id)
//                                                ->execute();
                                    }
                                    // debug($total);
                                    //return;
                                }
                                //  debug('новых ' + $new);
                                //  debug('старых ' + $old);
                                // debug('итого ' + $new + $old);
                                //sleep(10);


                                unset($currentHtml);
                                //return;
                            }
                            $subcathtml->clear();
                            unset($subcathtml);
                        }
                    }
                }
                // debug($count . '============================');
            }
            $count++;
            //if ($count == 5)
            //  break;
        }
        $html->clear();
        unset($html);
    }

    public function actionLoad() {
        return $this->render('load');
    }

    public function actionDownloadbylink($inputurl) {

//        $p = Watsonsproduct::findOne(1054541);
//        debug($p);
//        $p->name = 'jfdfjdhfjdf';
//        $p->updated_at = date('Y-m-d H:i:s');
//        $p->update();
//        $p = Watsonsproduct::findOne(1054541);
//        debug($p);
//        return;
        //debug(date('Y-m-d H:i:s'));
        $subcathtml = file_get_html($inputurl);  // получаем ссылку субкатегории
        $pages = count($subcathtml->find('#pagerDown a')) - 2; //получаем количество страниц в подкатегории
        if ((int) $pages < 1)
            $pages = 1;
        //echo 'pages== ' . $pages . '<br>'; //
        // debug($sclink->href); //
        $total = 0;
        $link = $subcathtml->find('#pagerDown a ', 1);
        for ($i = 0; $i < $pages; $i++) {
            $currentPage = $inputurl . '?q=:ranking&page=' . $i . '&resultsForPage=27&text=&sort=ranking';
            $currentHtml = file_get_html($currentPage);
            foreach ($currentHtml->find('.product-panel') as $product) {
                //debug('================product=================');
                $hrefId = $product->find('.variantsOverlay a', 0)->href;
                $id = trim(substr(strrchr($hrefId, 'BP_'), 3));
                $name = trim($product->find('.brand-ellipsis', 0)->innertext);
                $_price = $product->find('.main-price', 0)->innertext;
                $price = str_replace(',', '.', trim(substr($_price, 0, stripos($_price, 'грн'))));
                $_discount_price = $product->find('.memberPriceOverlay span', 0)->innertext;
                $discount_price = str_replace(',', '.', trim(substr($_discount_price, 0, stripos($_discount_price, 'грн'))));
                ($discount_price < 0) ? 'NULL' : $discount_price;
                $total++;


                $wproduct = WatsonsProduct::findOne($id);
                if (!isset($wproduct)) {
                    // debug('================ новый продукт =================');
                    //debug($total);
                    $wproduct = new WatsonsProduct();
                    $wproduct->id = $id;
                    $wproduct->name = $name;
                    $wproduct->reg_price = $price;
                    $wproduct->discount_price = $discount_price;
                    //$wproduct->updated_at = date('Y-m-d H:i:s');
                    $wproduct->save();
                } else {
                   // debug('================ старый обновленный =================');
                    // debug($total);
                    // $wproduct->id = $id;
                    $wproduct->name = $name;
                    $wproduct->reg_price = $price;
                    $wproduct->discount_price = $discount_price;
                    //$wproduct->updated_at = date('Y-m-d H:i:s');
                    $wproduct->save();
                    //  $wproduct->update();

                    $wproduct = WatsonsProduct::findOne($id);

                    //$wproduct->updated_at = date('Y-m-d H:i:s');
                    //$wproduct->update();
                    
                    unset($currentHtml);
                }
                unset($subcathtml);
            }
        }
        echo '<p>Загрузка завершена</p>';
        echo '<p> ' . $inputurl . '</p>';

        echo '<p>Загрузка завершена. Загружено ' + $total + ' товаров.</p>';
    }

}
