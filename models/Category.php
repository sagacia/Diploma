<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_id
 * @property integer $parent_id
 * @property string $cat_name
 * @property string $cat_description
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    
    public function getCategory(){

        return $this->hasOne(Category::className(), ['cat_id' => 'parent_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'cat_name'], 'required'],
            [['parent_id'], 'integer'],
            [['cat_name'], 'string', 'max' => 255],
            [['cat_description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'ID категории',
            'parent_id' => 'Родительская категория',
            'cat_name' => 'Название категории',
            'cat_description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'cat_id']);
    }
}
