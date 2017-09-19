
<?php

use yii\helpers\Html;

//use yii\widgets\DetailView;
//$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <form action="/crm/dw/calcseg" name="calcseg" method="get">

        <p><input type="date" name="datestart" value="0">Начало периода
        <p><input type="date" name="dateend" value="0">Конец периода
        <p><input type="input" name="interval" value="4">Интервал
        <p><input type="submit"></p>
    </form>
</div>