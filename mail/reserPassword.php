<?php

use yii\helpers\Html;

echo 'Добрый день, ' . Html::encode($user->username) . '. ';
echo Html::a('Для смены пароля передите по этой ссылке. ', Yii::$app->urlManager->createAbsoluteUrl(
                [
                    '/site/reset-password',
                    'key' => $user->password_reset_token
                ]
        )
);
