<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $categorie_id
 * @property string $image
 * @property string $product
 * @property string $slug
 * @property string $description
 *
 * @property Categorie $categorie
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
            [['categorie_id'], 'integer'],
            ['product', 'required'],
            [['description'], 'string'],
            [['image', 'product', 'slug'], 'string', 'max' => 255],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['categorys_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categorie_id' => 'Categorie ID',
            'image' => 'Image',
            'product' => 'Product Name',
            'slug' => 'Slug',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorie()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'categorie_id']);
    }
}
