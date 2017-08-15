<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product_id',
            'category_id',
            'brand_id',
            'product_name',
            'img',
            'price',
            [
                'attribute' => 'watsons name',
                'value' => function($data) {
                    //debug($data);die;
                    return isset($data->watsons->name) ? $data->watsons->name : 'не установлен';
                    //return 'dfg';
                }
            ],
            [
                'attribute' => 'watsons price',
                'value' => function($data) {
                    //debug($data);die;
                    return isset($data->watsons->reg_price) ? $data->watsons->reg_price : 'не установлен';
                    //return 'dfg';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>