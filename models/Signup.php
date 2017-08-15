<?php

namespace app\models;

use Yii;
use mdm\admin\models\form\Signup as SignupModel;

class Signup extends SignupModel {

    public $_status;

    public function rules() {

        return array_merge(parent::rules(), [
            ['_status','string'],
            ['_status', 'default', 'value' => User::STATUS_INACTIVE, 'on' => 'emailActivation']]
        );
    }

    public function signup() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = User::STATUS_INACTIVE;

        //    if ($this->scenario === 'emailActivation') {
                $user->generatePasswordResetToken();
        //    } 
            $user->save(false);
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $user->getId());
            return $user;
        }

        return null;
    }

    public function sendActivationEmail($user) {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' отправлено роботом'])
                        ->setTo($this->email)
                        ->setSubject('Активация для ' . Yii::$app->name)
                        ->send();
    }

}
