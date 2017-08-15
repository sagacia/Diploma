<?php

namespace app\modules\admin\models;

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
 * @property double $discount_price
 * @property integer $watsons_id
 *
 * @property Category $category
 * @property Brand $brand
 * @property Watsonsproduct $watsons
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id', 'watsons_id'], 'integer'],
            [['product_name'], 'required'],
            [['price', 'discount_price'], 'number'],
            [['product_name', 'img', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'cat_id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            [['watsons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Watsonsproduct::className(), 'targetAttribute' => ['watsons_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
            'product_name' => 'Product Name',
            'img' => 'Img',
            'description' => 'Description',
            'price' => 'Price',
            'discount_price' => 'Discount Price',
            'watsons_id' => 'Watsons ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['cat_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWatsons()
    {
        return $this->hasOne(Watsonsproduct::className(), ['id' => 'watsons_id']);
    }
}
