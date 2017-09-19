<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
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

    public function rules() {
        return [
            [['category_id', 'brand_id', 'watsons_id'], 'integer'],
            [['name'], 'required'],
            [['price', 'discount_price'], 'double'],
            [['name', 'img', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'cat_id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            [['watsons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Watsonsproduct::className(), 'targetAttribute' => ['watsons_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Product ID',
            'category_id' => 'Категория',
            'brand_id' => 'Бренд',
            'name' => 'Наименование',
            'image' => 'Фото',
            'gallery' => 'Галерея',
            'description' => 'Описание',
            'price' => 'Цена',
            'discount_price' => 'Цена со скидкой',
            'watsons_id' => 'Watsons ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['cat_id' => 'category_id']);
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
    public function getWatsons() {
        return $this->hasOne(Watsonsproduct::className(), ['id' => 'watsons_id']);
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);

            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery() {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }

            return true;
        } else {
            return false;
        }
    }

}
