<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php foreach ($products as $product): ?>
    <p><a href="<?= yii\helpers\Url::to(['product/view', 'id' => $product->product_id]) ?>"><?= $product->product_name ?></a></p>


<?php endforeach; ?>
    <div>Показать больше результатов</div>

