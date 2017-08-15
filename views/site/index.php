<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Космо';
?>

<?php //debug(Yii::$app->user->identity) ?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="left-sidebar">
                <ul id="accordion" class ="catalog category-products " > 
                    <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
                </ul> 
            </div>
        </div>


        <!--    <div id="slider-wrap" class="container col-lg-8 col-md-8 col-sm-8">
                <div id="slider">
        <?= Html::img('@web/images/slider/slider1.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
        <?= Html::img('@web/images/slider/slider2.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
        <?= Html::img('@web/images/slider/slider4.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
        <?= Html::img('@web/images/slider/slider4.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
                </div>
            </div>-->
    </div>

</div>

<!--<div id="slider-wrap" class="container">
    <div id="slider">
<?= Html::img('@web/images/slider/slider1.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
<?= Html::img('@web/images/slider/slider2.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
<?= Html::img('@web/images/slider/slider4.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
<?= Html::img('@web/images/slider/slider4.jpg', ['class' => 'slide', 'alt' => 'в']) ?>
    </div>
</div>-->





