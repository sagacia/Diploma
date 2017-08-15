<?php

namespace app\models;
use mdm\admin\models\User as UserModel;

class User extends UserModel
{
//   public function rules(){
//       
//       return array_merge(parent::rules(), 
//                ['status', 'default', 'value'=>User::STATUS_INACTIVE, 'on'=>'emailActivation']);
//   }
   
   public function scenarios() {
       $scenarios = parent::scenarios();
       $scenarios['emailActivation'] = ['status', 'default', 'value' =>User::STATUS_INACTIVE];
       return $scenarios;
   }


//   public function scenarios()
// {
//      $scenarios = parent::scenarios();
//       // $scenarios['add'] = ['user_id', 'question','answer'];
//        //$scenarios['edit'] = ['user_id','question'];
//         
//        return $scenarios;
// }
}
