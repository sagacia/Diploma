<?php

namespace app\modules\crm\models;

use Yii;

/**
 * This is the model class for table "dw".
 *
 * @property string $email
 * @property string $segment
 * @property string $periodstart
 * @property string $periodend
 * @property integer $checks1
 * @property integer $checks2
 * @property integer $checks3
 */
class Dw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'segment', 'periodstart', 'periodend', 'checks1', 'checks2', 'checks3'], 'required'],
            [['periodstart', 'periodend'], 'safe'],
            [['checks1', 'checks2', 'checks3'], 'integer'],
            [['email', 'segment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'segment' => 'Segment',
            'periodstart' => 'Periodstart',
            'periodend' => 'Periodend',
            'checks1' => 'Checks1',
            'checks2' => 'Checks2',
            'checks3' => 'Checks3',
        ];
    }
}
