<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $image
 * @property string $category
 * @property string $name
 * @property string $product_name
 * @property string $description
 */
class Product extends \yii\db\ActiveRecord
{
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios['fileimput'] = [
//            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg','gif'],
//            [[ 'category', 'name','image'], 'string', 'max' => 55],
//            [['product_name'], 'string', 'max' => 255],
//            [['description'], 'string', 'max' => 500],
//        ];
//        return $scenarios;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['images'], 'image', 'skipOnEmpty' => false, 'extensions' => ['png, jpg','gif']],
            [['image'], 'image', 'maxSize' => 1024 * 1024 * 5],
            [[ 'category', 'category_name'], 'string', 'max' => 55],
            [['product_name', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Картинка',
            'images' => 'Картинка',
            'category' => 'Категория',
            'category_name' => 'Name',
            'product_name' => 'Название продукта',
            'description' => 'Описание',
        ];
    }

    public function getCat($name)
    {
        return $this->hasMany(Category::className(), ['category_name' => 'category'])
            ->where('category_name :threshold', [':threshold' => $name]);
    }

}
