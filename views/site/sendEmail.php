<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SendEmailForm */
/* @var $form ActiveForm */
?>
<div class="site-sendEmail">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if (Yii::$app->session->hasFlash('warning')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" area-label="close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('warning') ?>
        </div>    
    <?php endif; ?>

</div><!-- site-sendEmail -->
