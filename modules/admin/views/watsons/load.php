<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Watsons download';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

     <h1><?= Html::encode($this->title) ?></h1>

    <div class="btn-group  ">
            <!--<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" >-->
            <div class="container"><input class="inputurl" type="text"></div>
            
            <div class="container"><a class="btn btn-warning watsonsdownload" href="<?= \yii\helpers\Url::to(['/admin/watsons/downloadbylink']) ?>" class="active">Загрузить Watsons</a></div>
            <span ></span>
            <!--</button>-->
            <p></p>
        </div>
     
     <div class="downloadResult"></div>
</div>
