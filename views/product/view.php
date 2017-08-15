<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $product->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                <div class="left-sidebar">
                    <ul id="accordion" class ="catalog category-products " > 
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                    </ul> 
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="product-information"><!--/product-information-->
                    <h2><?= $product->product_name ?></h2>
                    <p>Код товара: <?= $product->product_id ?></p>
                    <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->product_name, 'height' => '200']) ?>

                    <span>
                            <span><?= $product->price ?></span>
                            <label>Количество:</label>
                            <input type="text" value="1" name="qtyy" id="qty" />
                            <a  href="<?= \yii\helpers\Url::to(['/cart/add', 'id' => $product->product_id]) ?>" 
                                data-id="<?= $product->product_id ?>" class="btn btn-fefault add-to-cart cart ">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </a>
                    </span>

                    <p><b>Бренд:</b><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->cat_id]) ?>" >
                            <?= $product->brand->brand_name ?> </a> </p>
                    <p><b>Категория:</b><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->cat_id]) ?>" >
                            <?= $product->category->cat_name ?> </a> </p>
                    <?= $product->description ?>
                </div><!--/product-information-->
            </div><!--/product-details-->
        </div>
    </div>
</div>


