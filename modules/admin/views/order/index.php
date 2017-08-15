<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    if($data->status==0)
                         return '<span class="text-danger"> Активен </span>';
                    if($data->status==1)
                         return '<div class="text-primary"> В обработке </div>' ;
                    if($data->status==2)
                         return '<div class="text-success"> Доставлен </div>';
                },
                         'format' => 'html',
            ],
            //'status',
            // 'name',
            // 'email:email',
            // 'phone',
            // 'address',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
