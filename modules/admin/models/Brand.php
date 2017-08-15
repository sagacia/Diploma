<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $brand_id
 * @property integer $parent_id
 * @property string $brand_name
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'brand_name'], 'required'],
            [['parent_id'], 'integer'],
            [['brand_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'parent_id' => 'Parent ID',
            'brand_name' => 'Brand Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'brand_id']);
    }
}
