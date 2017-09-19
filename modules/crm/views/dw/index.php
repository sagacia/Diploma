<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dws';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dw-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dw', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'email:email',
            'segment',
            'periodstart',
            'periodend',
            'checks1',
            // 'checks2',
            // 'checks3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
