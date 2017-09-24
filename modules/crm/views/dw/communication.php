
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use yii\widgets\DetailView;
//$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <?php if (Yii::$app->session->hasFlash('notification')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" area-label="close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('notification') ?>
        </div>    
    <?php endif; ?>
    <div class="row">
        
            <div class="result">Результат


    </div>
    <div class="container">      
        <div class="container"><a class="btn btn-warning preproposal" href="<?= \yii\helpers\Url::to(['/crm/dw/preproposal']) ?>" class="active">Просмотр</a></div>
       

    </div>


    <form method="POST" action="on.php"> 
         <p>
            <input type="reset" value="Сбросить" name="B2"></p> 
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="segments">
                    <h3>Сегменты</h3>
                    <?php foreach ($segments as $segment): ?>
                        <div><input type="checkbox" name="news" value="ON" data-seg='<?= $segment['segment'] ?>' >
                            <?= $segment['segment'] ?> </div>
                    <?php endforeach; ?>
                    <p>&nbsp;</p> 
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3">

                <div class="categories">
                    <h3>Категории</h3>
                    <?php foreach ($categories as $category): ?>
                        <div><input type="checkbox" name="news" value="ON" data-catid='<?= $category['category_id'] ?>'>
                            <?= $category['category_id'] ?>  <?= $category['cat_name'] ?></div>
                    <?php endforeach; ?>
                    <p>&nbsp;</p> 
                </div>


            </div>
        </div>




        <p><input type="reset" value="Сбросить" name="B2"></p> 
        <div class="container"><a class="btn btn-warning preproposal" href="<?= \yii\helpers\Url::to(['/crm/dw/preproposal']) ?>" class="active">Просмотр</a></div>



    </form> 


</div>