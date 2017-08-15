<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
$layout = null;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cat_id',
            //  'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($data) {
                    //debug($data);                    die;
                    //обязательно использовать жадную загрузку в контроллере ->with('category')
                    return isset($data->category->cat_name) ? $data->category->cat_name: 'Самостоятельная категория';
                }
            ],
            'cat_name',
            'cat_description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
