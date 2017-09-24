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
        <?= Html::csrfMetaTags() ?>
        <title><?php echo Yii::$app->name ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>



        <nav id="header" class="navbar navbar-fixed-top">
            <div  id="menutop" class="container">
                <div class="container">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="active"><a href="#">Информационная поддержка</a>
                        </li>

                        <li ><a href="#">0 800 308 808*</a></li>
                        <!--<div > (дзвінки зі стаціонарних телефонів України безкоштовні)</div>-->
                        <li> <a>
                                <div class="search_box pull-right">
                                    <form method="get" action="<?= \yii\helpers\Url::to('/category/search') ?>">
                                        <input id="search" autocomplete="off" style="width: 300px;" type="text" placeholder="Введите название или код товара" name="srch"/>
                                        <div id="resSearch"></">

                                        </div>
                                    </form>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul>

                    </ul>

                    <ul class="nav navbar-nav navbar-right ">
                        <li ><a href="#"  ><i class="fa fa-twitter"></i></a></li>
                        <li ><a href="#"  ><i class="fa fa-facebook"></i></a></li>
                        <li ><a href="#"  ><i class="fa fa-youtube"></i></a></li>
                    </ul>


                </div>
            </div>

            <!--<div id="menu" class="container-fluid">-->
            <div id="menu" class="container-fluid">

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


                        <li ><a href="<?= \yii\helpers\Url::to(['/category/index']) ?>">Каталог</a></li>
                        <li ><a href="<?= \yii\helpers\Url::to(['/site/stores']) ?>">Магазины</a></li>
                        <li ><a href="<?= \yii\helpers\Url::to(['/site/contacts']) ?>">Контакты</a></li>

                        <li ><a href="#" onclick="return getCartModal()">Корзина</a></li>
                        <!--<li ><a href="<?= \yii\helpers\Url::to(['/cart/showcart']) ?>">Корзина</a></li>-->


                        <?php if (!Yii::$app->user->isGuest): ?>
                            <li> 
                                <?= Html::beginForm(['/site/logout'], 'post') ?>
                                <?=
                                Html::submitButton(
                                        'Выйти (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                                )
                                ?> 

                                <?= Html::endForm() ?>

                            </li>
                        <?php else: ?>
                            <li ><a href="<?= yii\helpers\Url::to(['site/login']) ?>">Вход</a></li>
                        <?php endif; ?>
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li ><a href="<?= yii\helpers\Url::to(['site/signup']) ?>">Регистрация</a></li>
                        <?php endif; ?>

                        <li ><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="headerwrap">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-8 col-lg-offset-2 ">
                        <div> 

                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <?php if (Yii::$app->session->hasFlash('warning')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" area-label="close">
                        <span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('warning') ?>
                </div>    
            <?php endif; ?>
        </div>
        <div class="container">   <?= $content; ?> </div>




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
        <?php
        \yii\bootstrap\Modal::begin([
            'id' => 'cart',
            'size' => 'modal-lg',
            'header' => '<h2>Ваша корзина</h2>',
            'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить</button>
        <a href="' . \yii\helpers\Url::to(['/cart/view']) . '" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>'
        ]);

        \yii\bootstrap\Modal::end();
        ?>
        <?php $this->endBody() ?>
    </body>
</html>



<?php $this->endPage() ?>