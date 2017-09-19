<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table competitors">
        <thead>
            <tr>
                <th>Код товара</th>
                <th>Категория</th>
                <th>Бренд</th>
                <th>Название</th>
                <th>Картинка</th>
                <th>Цена</th>
                <th>Название Watsons</th>
                <th>Цена Watsons </th>
                <th>Цена со скидкой Watsons </th>
            <!--<th>Подтвердить </th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>

                <tr class="productrow">
                    <td class='productid' scope="row"> <?= $product->id ?> </td>
                    <td><?= $product->category_id ?> </td>
                    <td><?= $product->brand_id ?> </td>
                    <td><?= $product->name ?> </td>
                    <td><?= $product->img ?> </td>
                    <td><?= $product->price ?> </td>
                    <td>
                        <div class="row">

                            <div class="wname col-8 col-sm-8">
                                <input class="wsearch" data-productid="<?= $product->id ?>" 
                                       data-watsonsid="<?= $product->watsons['id'] ?>"
                                       type="text" value="<?= isset($product->watsons['name']) ? $product->watsons['name'] : 'не установлено' ?>"
                                       size="15"
                                       url='/admin/catman/addwkey'
                                       readonly=""
                                       style="visibility: hidden; position: absolute"
                                       > 
                                <div class='prename'><?= isset($product->watsons['name']) ? $product->watsons['name'] : 'не установлено' ?></div>
                                <div class="wresSearch"></div>
                            </div>
                            <div class="change-wproduct col-2 col-sm-2"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></div>
                        </div>
                    </td>
                    <td class='wprice' ><?= $product->watsons['reg_price'] ?> </td>
                    <td class='wprice' ><?= $product->watsons['discount_price'] ?> </td>

                        <!--<td><a href="#" class="confirm">Подтвердить</a> </td>-->


                </tr>


            <?php endforeach; ?>

        </tbody>
    </table>
    <?php echo LinkPager::widget(['pagination' => $pages,]); ?>
</div>