<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Админка';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <ul class="nav navbar-nav navbar-left ">
        <li ><a href="<?= yii\helpers\Url::to(['/admin/default/catload']) ?>"  > Загрузить категории</a></li>
        <li ><a href="<?= yii\helpers\Url::to(['/admin/default/brandload']) ?>"  > Загрузить бренды</a></li>
        <li ><a href="<?= yii\helpers\Url::to(['/admin/default/productload']) ?>"  > Загрузить товары</a></li>
    </ul>
</div>


<div class="admin-default-index container">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
