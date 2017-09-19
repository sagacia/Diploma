<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\crm\models\Dw */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dw-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodstart')->textInput() ?>

    <?= $form->field($model, 'periodend')->textInput() ?>

    <?= $form->field($model, 'checks1')->textInput() ?>

    <?= $form->field($model, 'checks2')->textInput() ?>

    <?= $form->field($model, 'checks3')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
