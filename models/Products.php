<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $categorys_id
 * @property int $parents_id
 * @property string $image
 * @property string $products_name
 * @property string $slug
 * @property string $description
 *
 * @property Categorys $categorys
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categorys_id'], 'integer'],
            ['title', 'required'],
            [['description'], 'string'],
            [['image', 'title', 'slug'], 'string', 'max' => 255],
            [['categorys_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorys::className(), 'targetAttribute' => ['categorys_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categorys_id' => 'Categorys ID',
            'image' => 'Image',
            'title' => 'Products Name',
            'slug' => 'Slug',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorys()
    {
        return $this->hasOne(Categorys::className(), ['id' => 'categorys_id']);
    }
}
