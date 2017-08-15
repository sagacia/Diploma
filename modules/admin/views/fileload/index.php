<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>



<?php

/*$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<button>Отправить</button>

<?php ActiveForm::end()*/ ?>




<!--
<div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-3 right">
            <p >
                <?= Html::input('file', 'load', 'ld', ['class' => '']) ?>
            </p>                   
        </div>
        <div class="col-lg-3 col-md-3 right">
            <p >
                <?= Html::input('submit', 'attr', 'Загрузить категории', ['class' => 'btn btn-success', 'value' => 'Загрузить категории']) ?>
            </p>                   
        </div>
    </div>
</div>-->