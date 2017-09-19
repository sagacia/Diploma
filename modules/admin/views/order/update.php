<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Update Order: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1>Обновить заказ № <span class="orderid"><?= Html::encode($model->id) ?></span></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>


    <?php $items = $model->orderItems; ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID товара</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php $qty = 0;
                $sum = 0;
                ?>

                <?php foreach ($items as $id => $item) : ?>
                    <?php $qty +=$item->qty_item;
                    $sum = $item->qty_item * $item->price;
                    ?>

                <tr class="productrow">
                        <td class="productid" style="text-align: center"><?= $item->product_id ?></td>

                        <td> <a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $item->product_id]); ?>"><?= $item->product_name ?></a></td>
                        <td class="productqty" style="text-align: center"><?= $item->qty_item ?></td>
                        <td class="productprice" style="text-align: center"><?=  number_format($item->price, 2, '.', ' ');?></td>
                        <td class="good-sum" style="text-align: center"><?= $item->qty_item * $item->price ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item-order" aria-hidden="true"></span></td>
                    </tr>
<?php endforeach; ?>

                <tr>
                    <td colspan="5" style="text-align: right; padding-right: 100px; "><strong>Итого</strong></td>
                    <td colspan="1" ><strong><?= $qty ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right; padding-right: 100px;" ><strong>На сумму</strong></td>
                    <td colspan="1" ><strong><?= $sum ?></strong></td>
                </tr>


            </tbody>
        </table>
    </div>

</div>
