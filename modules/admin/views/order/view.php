<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1> Просмотр заказа № <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    
    <?php $items = $model->orderItems;  ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $id => $item) : ?>
                    <tr>

                        <td> <a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $item->product_id]); ?>"><?= $item->product_name ?></a></td>
                        <td style="text-align: center"><?= $item->qty_item ?></td>
                        <td style="text-align: center"><?= $item->price ?></td>
                        <td style="text-align: center"><?= $item->qty_item * $item->price ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item-modal" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

</div>
