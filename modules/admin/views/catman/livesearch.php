<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<ul slyle="list-style-type: none">
    <?php foreach ($wproducts as $wproduct): ?>



    <li class="wproduct"><p> <a href="#" wproductid ="<?= $wproduct->id ?>" ><?= $wproduct->name ?></a></p></li>


    <?php endforeach; ?>
</ul>


