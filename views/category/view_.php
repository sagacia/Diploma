<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

//$this->title = $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                sjkfhjashf askjfh lkashf lksahflkas fl
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 ">
                <div class="conainer">
                    <div class="row">                        

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="product-image-wrappers">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <h2>sdjfhksdj sldkjf lkdj klksdjflkg klsdjkflksjdkl dhgslkdgflkds gh1</h2>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>                                                
                                </div><!--features_items-->
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="product-image-wrappers">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <h2>sdjfhksdj sldkjf lkdj klksdjflkg klsdjkflksjdkl dhgslkdgflkds gh1</h2>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>                                                
                                </div><!--features_items-->
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="product-image-wrappers">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <h2>sdjfhksdj sldkjf lkdj klksdjflkg klsdjkflksjdkl dhgslkdgflkds gh1</h2>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>                                                
                                </div><!--features_items-->
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
