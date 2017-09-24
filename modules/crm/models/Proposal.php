<?php

namespace app\modules\crm\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property integer $id
 * @property string $message
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message','title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title'=>'Title',
            'message' => 'Message',
        ];
    }
}
