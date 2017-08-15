<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Загрузка категорий';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <h1><?= $title; ?></h1>
    <!--    <form action="/admin/default/catload2" method="post" id="my_form" enctype="multipart/form-data">-->
    <form action="<?= \yii\helpers\Url::to($url) ?>" method="post" id="my_form" enctype="multipart/form-data">

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />

        <label for="avatar">Выберите файлы для загрузки:</label><br>
        <input type="file" name="myfile[]">
        <!--        <button id="add_field">Ещё бы полей</button>-->
        <!--        <div id="additional_fields"></div>-->
        <p>
            <input type="submit" id="submit" value="Отправить">
        </p>
    </form>


    <div class="ajax-respond alert alert-success alert-dismissible" role="alert" style="visibility: hidden">
        <button type="button" class="close" data-dismiss="alert" area-label="close">
            <span aria-hidden="true">&times;</span></button>

    </div>    


</div>