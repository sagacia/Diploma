<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Breadcrumbs;
?>
<div class="category-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                <div class="left-sidebar">
                    <ul id="accordion" class ="catalog category-products " > 
<?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                    </ul> 
                </div>


            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 ">
                <h2 class="title text-center"> Поиск по: <?= $srch ?></h2>


                <div class="conainer">
                    <div class="row">                        
<?php $i = 0; ?>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <h3><?= $product->product_name ?></h3>
        <?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->product_name, 'class' => 'productimg', 'width' => 300]) ?>
                                            <h2><?= $product->price ?></h2>
                                            бренд <?= $product->brand->brand_name ?>
                                            <p><a href="<?= yii\helpers\Url::to(['product/view', 'id' => $product->product_id]) ?>"><?= $product->product_name ?></a></p>
                                            <a href="#" data-id="<?= $product->product_id ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div> <!-- info -->
                                    </div> <!-- single-products -->
                                </div> <!-- single-products col-4 -->
        <?php $i++; ?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="clearfix"></div>

        <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>                                                
                            <?php echo LinkPager::widget(['pagination' => $pages,]); ?>
                        <?php else: ?>
                            <h2>Ничего не найдено</h2>
                        <?php endif; ?>



                    </div> <!-- row -->
                </div>
            </div>
        </div>
    </div>
</div>
