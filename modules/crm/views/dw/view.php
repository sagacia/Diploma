<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\crm\models\Dw */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dw-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'email' => $model->email, 'periodstart' => $model->periodstart, 'periodend' => $model->periodend], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'email' => $model->email, 'periodstart' => $model->periodstart, 'periodend' => $model->periodend], [
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
            'email:email',
            'segment',
            'periodstart',
            'periodend',
            'checks1',
            'checks2',
            'checks3',
        ],
    ]) ?>

</div>
