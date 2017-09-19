<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\crm\models\Dw */

//$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Сегменты</h2>
    <div>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th> Сегмент </th>
                    <th> Количество покупателей</th>
                    <th> % </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($segments as $seg): ?>
                    <tr>
                        <td>
                            <?= $seg['segment'] ?>
                        </td>
                        <td>
                            <?= $seg['cnt'] ?>
                        </td>
                        <td>
                            <?= round($seg['cnt'] / $totalemails, 2) ?>%
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total">
                    <td>
                        Итого
                    </td>
                    <td>
                        <?= $totalemails ?>
                    </td>
                    <td>
                        100%
                    </td>
                </tr>
            </tbody>
        </table>

    </div>



</div>

