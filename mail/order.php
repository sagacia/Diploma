
<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" 
           class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($session['cart'] as $id => $item) : ?>
                <tr>
                    <td><?= yii\helpers\Html::img("@web/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50]); ?></td>
                    <td> <a href="<?= \yii\helpers\Url::to(['@web/product/view', 'id' => $id]); ?>"><?= $item['name'] ?></a></td>
                    <td style="text-align: center"><?= $item['qty'] ?></td>
                    <td style="text-align: center"><?= $item['price'] ?></td>
                    <td style="text-align: center"><?= $item['qty'] * $item['price'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4"><strong>Итого</strong></td>
                <td colspan="1"><strong><?= $session['cart.qty'] ?></strong></td>
            </tr>
            <tr>
                <td colspan="4"><strong>На сумму</strong></td>
                <td colspan="1"><strong><?= $session['cart.sum'] ?></strong></td>
            </tr>

        </tbody>
    </table>
</div>


