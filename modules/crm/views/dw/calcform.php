
<?php

use yii\helpers\Html;

//use yii\widgets\DetailView;
//$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    

    <form action="/crm/dw/calcseg" name="calcseg" method="get">

        <p><input type="date" name="datestart" value="<?php if(isset($start)) echo date('Y-m-d', strtotime($start)); else echo date('Y-m-d'); ?>">Начало периода

        <p><input type="date" name="dateend"   value="<?php if(isset($end)) echo date('Y-m-d', strtotime($end)); else echo date('Y-m-d');  ?>"> Конец периода

        <p><input type="input" name="interval" value="4">Интервал
        <p><input type="submit"></p>
    </form>

    <?php if (Yii::$app->session->hasFlash('notification')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" area-label="close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('notification') ?>
        </div>    
    <?php endif; ?>
</div>