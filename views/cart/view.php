<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    
<?php if (Yii::$app->session->hasFlash('successOrder')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" area-label="close">
            <span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successOrder') ?>
    </div>    
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('errorOrder')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" area-label="close">
            <span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('errorOrder') ?>
    </div>    
<?php endif; ?>

<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item) : ?>
                    <tr>
                        <td><?= yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]); ?></td>

                        <td> <a href="<?= \yii\helpers\Url::to(['@web/product/view', 'id' => $id]); ?>"><?= $item['name'] ?></a></td>
                        <td style="text-align: center"><?= $item['qty'] ?></td>
                        <td style="text-align: center"><?= $item['price'] ?></td>
                        <td style="text-align: center"><?= $item['qty'] * $item['price'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item-modal" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><strong>Итого</strong></td>
                    <td colspan="1"><strong><?= $session['cart.qty'] ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5"><strong>На сумму</strong></td>
                    <td colspan="1"><strong><?= $session['cart.sum'] ?></strong></td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($order, 'name') ?>
    <?= $form->field($order, 'email') ?>
    <?= $form->field($order, 'phone') ?>
    <?= $form->field($order, 'address') ?>
    <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    <?php $form = ActiveForm::end() ?>


<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>

</div>