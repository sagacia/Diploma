<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

//$this->title = $model->cat_id;
//$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
//echo Breadcrumbs::widget([
//    //'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
//    'links' => [
//        [
//            'label' => 'Post Category',
//            'url' => ['post-category/view', 'id' => 10],
//           // 'template' => "<li><b>{link}</b></li>\n", // template for this link only
//        ],
//        ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
//        'Edit',
//    ],
//]);
?>
<div class="category-view">


    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="left-sidebar">
                    <ul id="accordion" class ="catalog category-products " > 
                        <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                    </ul> 
                </div>
                <div class="left-sidebar">
                    <h3>Бренды</h3> 
                    <?php foreach ($brands as $brand): ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">

                            <p><a href="<?= yii\helpers\Url::to(['category/view', 'id' => $category->cat_id, 'brandid' => $brand->brand_id]) ?>"><?= $brand->brand_name ?></a></p>

                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 clearfix">
                <?php if (!is_null($brandd)): ?>
                    <h2 class="title text-center"><?= $category->cat_name . ' | ' . $brandd->brand_name ?></h2>
                <?php else: ?>
                    <h2 class="title text-center"><?= $category->cat_name ?></h2>

                <?php endif; ?>
                <div class="conainer">
                    <div class="row" >   
                        
                        <?php $i = 0; ?>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-4 col-sm-4" >
                                    <div class="products-row">
                                        <div class="product productinfo inner"    >
                                            <h3 style="height: 80px;" ><?= $product->name ?></h3>
                                            <?php $mainImg = $product->getImage(); ?>
                                            <?= Html::img($mainImg->getUrl('300x300'), ['alt' => $product->name, 'class' => 'productimg', 'width' => 300]) ?>
                                            <h2><?= isset($product->price) ? $product->price : '0' ?> грн</h2>
                                            бренд <?= $product->brand->brand_name ?>
                                            <p><a href="<?= yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= $product->name ?></a></p>
                                            <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div> <!-- product -->
                                    </div> <!-- products-row -->
                                </div> <!--  col-4 -->
                                <?php $i++; ?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="clearfix"></div>

                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>    
                            <div style="text-align: center">
                                <?php echo LinkPager::widget(['pagination' => $pages,]); ?>
                            </div>
                        <?php else: ?>
                            <h2>В этой категории товаров нет</h2>
                        <?php endif; ?>



                    </div> <!-- row -->
                </div>
            </div>
        </div>
    </div>
</div>
