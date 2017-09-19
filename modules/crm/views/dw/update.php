<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\crm\models\Dw */

$this->title = 'Update Dw: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'email' => $model->email, 'periodstart' => $model->periodstart, 'periodend' => $model->periodend]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dw-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
