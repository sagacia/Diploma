<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $product_name
 * @property string $img
 * @property string $description
 * @property double $price
 *
 * @property Brand $brand
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord {

    public $image;
    public $gallery;

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'brand_id', 'product_name'], 'required'],
            [['category_id', 'brand_id'], 'integer'],
            [['price'], 'number'],
            [['name', 'img', 'description'], 'string', 'max' => 255],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'cat_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Product ID',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
            'product_name' => 'Product Name',
            'img' => 'Img',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand() {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['cat_id' => 'category_id']);
    }

}
