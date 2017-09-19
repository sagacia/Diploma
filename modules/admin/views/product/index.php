<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
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
            'id',
            //'category_id',
            ['attribute' => 'category_id',
                'value' => function($data) {
                    return isset($data->category->cat_name) ? $data->category->cat_name : '';
                }
            ],
           // 'brand_id',
            ['attribute' => 'brand_id',
                'value' => function($data) {
                    return isset($data->brand->brand_name) ? $data->brand->brand_name : '';
                }
            ],
            'name',
            'img',
            // 'description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
