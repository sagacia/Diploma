<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\crm\models\Dw */

$this->title = 'Create Dw';
$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dw-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
