<?php

namespace app\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

class AccountActivation extends Model{
    private $_user;
    
    public function __construct($key, $config = []) {
        if(empty($key) || !is_string($key))
            throw new InvalidParamException('Ключ не может быть пустым');
        $this->_user = User::findOne(['password_reset_token' => $key]);

        if(!$this->_user)
            throw new InvalidParamException('Неверный ключ');
        parent::__construct($config);
    }
    public function activateAccount() {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removePasswordResetToken();
        return $user->save();
    }
    
    public function getUsername() {
        $user = $this->user;
        return $user->username;
        
    }
    
}