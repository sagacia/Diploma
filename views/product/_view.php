<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $product->id;
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
                    <h2><?= $product->name ?></h2>
                    <p>Код товара: <?= $product->id ?></p>
                    <?php
                    $mainImg = $product->getImage();
                    $gallery = $product->getImages();
                    //debug($mainImg);
                    //debug($gallery);
                    ?>
                    <?= Html::img($mainImg->getUrl('300x'), ['alt' => $product->name, 'height' => '200']) ?>

                    <span>
                        <span><?= $product->price ?></span>
                        <label>Количество:</label>
                        <input type="text" value="1" name="qtyy" id="qty" />
                        <a  href="<?= \yii\helpers\Url::to(['/cart/add', 'id' => $product->id]) ?>" 
                            data-id="<?= $product->id ?>" class="btn btn-fefault add-to-cart cart ">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </a>
                    </span>
                    <p><b>Цена:</b><?= $product->price ?> </b> </p>

                    <p><b>Бренд:</b><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->cat_id]) ?>" >
                            <?= $product->brand->brand_name ?> </a> </p>
                    <p><b>Категория:</b><a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->cat_id]) ?>" >
                            <?= $product->category->cat_name ?> </a> </p>
                    <div class="similar-product">
                        <div class="carousel-inner">

                            <?php
                            $count = count($gallery);
                            $i = 0;
                            foreach ($gallery as $img):
                                ?>
                                    <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo "active" ?>  ">
                                    <?php endif; ?>  
                                    <a href=""><?= Html::img($img->getUrl('100x'), ['alt' => $product->name]) ?> </a>
                                <?php $i++;
                                if ($i % 3 == 0 || $i == $count):
                                    ?>
                                    </div>
                            <?php endif; ?>
                    <?php endforeach; ?>

                        </div>
                    </div>
<?= $product->description ?>
                </div><!--/product-information-->
            </div><!--/product-details-->
        </div>
    </div>
</div>


