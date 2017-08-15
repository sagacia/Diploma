<?php

use yii\helpers\Html;

echo 'Добрый день, ' . Html::encode($user->username) . '! ';
echo Html::a('Для активации аккаунта перейдите по ссылке ' ,
        Yii::$app->urlManager->createAbsoluteUrl(
                [
                    'site/activate-account',
                    'key' => $user->password_reset_token
                ]
));
