<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Админка | <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <?php $this->beginBody() ?>
    <nav id="header" class="navbar navbar-fixed-top">
        <div  id="menutop" class="container">
            <div class="container">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="#">Информационная поддержка</a>
                    </li>
                    <li ><a href="#">0 800 308 808*</a></li>
                    <!--<div > (дзвінки зі стаціонарних телефонів України безкоштовні)</div>-->
                </ul>

                <!--                <div class="container  navbar-right">
                                    <div class="row text-center">
                                        <a href="#"  ><i class="fa fa-twitter"></i></a>
                                        <a href="#"  ><i class="fa fa-facebook"></i></a>
                                        <a href="#"  ><i class="fa fa-youtube"></i></a>
                                    </div>
                                </div>-->

                <ul class="nav navbar-nav navbar-right ">
                    <li ><a href="#"  ><i class="fa fa-twitter"></i></a></li>
                    <li ><a href="#"  ><i class="fa fa-facebook"></i></a></li>
                    <li ><a href="#"  ><i class="fa fa-youtube"></i></a></li>
                </ul>

            </div>
        </div>

        <!--<div id="menu" class="container-fluid">-->
        <div id="menu" class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span  class="icon-bar"></span>
                    <span  class="icon-bar"></span>
                    <span  class="icon-bar"></span>
                </button>
                <a href="<?= \yii\helpers\Url::home() ?>" class="navbar-brand">Koсмо</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="#">Каталог</a></li>
                    <li ><a href="#">Магазины</a></li>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <li > 
                            <?= Html::beginForm(['/site/logout'], 'post') ?>
                            <?=
                            Html::submitButton(
                                    '<a href=#>Logout (' . Yii::$app->user->identity->username . ')</a>', ['class' => 'btn btn-link logout']
                            )
                            ?> 

                            <?= Html::endForm() ?>

                        </li>
                    <?php else: ?>
                        <li ><a href="<?= yii\helpers\Url::to(['/site/login']) ?>">Вход</a></li>
                    <?php endif; ?>
                    <li ><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="headerwrap">
        <!--        <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-8 col-lg-offset-2 ">
                            <div> </div>
                            
                        </div>
                    </div>
                </div>-->
    </div>


    <div class="container">
        <div class="btn-group  ">
            <!--<button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" >-->
            <a class="btn btn-warning " href="<?= \yii\helpers\Url::to(['/admin/order']) ?>" class="active">Заказы</a>
            <span ></span>
            <!--</button>-->
            <p></p>
        </div>

        <div class="btn-group dropdown">
            <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Категории <span class="caret"></span></button><p></p>
            <ul class="dropdown-menu">
                <li><a href="<?= \yii\helpers\Url::to(['category/index']) ?>">Список категорий</a></li>
                <li><a href="<?= \yii\helpers\Url::to(['category/create']) ?>">Добавить категорию</a></li>
                <li role="separator" class="divider"></li>
                <li ><a href="<?= yii\helpers\Url::to(['/admin/default/catload']) ?>"  > Загрузить категории из файла</a></li>

            </ul></div>

        <div class="btn-group dropdown">
            <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Бренды <span class="caret"></span></button><p></p>
            <ul class="dropdown-menu">
                <li><a href="<?= \yii\helpers\Url::to(['brand/index']) ?>">Список брендов</a></li>
                <li><a href="<?= \yii\helpers\Url::to(['brand/create']) ?>">Добавить бренд</a></li>
                <li role="separator" class="divider"></li>
                <li ><a href="<?= yii\helpers\Url::to(['/admin/default/brandload']) ?>"  > Загрузить бренды из файла</a></li>

            </ul></div>


        <div class="btn-group dropdown">
            <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Товары <span class="caret"></span></button><p></p>
            <ul class="dropdown-menu">
                <li><a href="<?= \yii\helpers\Url::to(['product/index']) ?>">Список товаров</a></li>
                <li role="separator" class="divider"></li>
                <li ><a href="<?= yii\helpers\Url::to(['/admin/default/productload']) ?>"  > Загрузить товары из файла</a></li>
                <li ><a class='productsDel' href='#'  > Удалить все товары</a></li>

            </ul></div>


    </div>


    <div class="container">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" area-label="close">
                    <span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success') ?>
            </div>    
        <?php endif; ?>
        <?= $content; ?>
    </div>





    <div class="clearfix"></div>

    <footer id="f">
        <div class="container">
            <div class="row text-center">
                <a href="#"  ><i class="fa fa-twitter"></i></a>
                <a href="#"  ><i class="fa fa-facebook"></i></a>
                <a href="#"  ><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>


    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>