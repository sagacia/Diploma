<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

//mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // debug($model); ?>

    <?php //echo $form->field($model, 'category_id')->textInput()  ?>

    <div class="form-group field-category-parent_id required has-success">
        <label class="control-label" for="product-category_id">Категория</label>
        <select id="category-parent_id" class="form-control" name="Product[id]" aria-required="true" aria-invalid="false">
            <option value="0">Самостоятельная категория</option>

            <?= app\components\MenuWidget::widget(['tpl' => 'select_product', 'model' => $model]) ?>

        </select>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


    <?php //echo $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>



    <?php // echo $form->field($model, 'description')->textInput(['maxlength' => true])  ?>

    <?php
//    echo $form->field($model, 'description')->widget(CKEditor::className(), [
//        'editorOptions' => [
//            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
//            'inline' => false, //по умолчанию false
//        ],
//    ]);

    echo $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder' /* , 'path' => 'some/sub/path' */], [/* Some CKEditor Options */]),
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
