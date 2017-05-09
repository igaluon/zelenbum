<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;


/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $categorie_id
 * @property string $product
 * @property string $slug
 * @property string $description
 * @property string $image
 */
class Product extends ActiveRecord
{
    public $images;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['product'],
            ],
            'seo' => [
                'class' => \notgosu\yii2\modules\metaTag\components\MetaTagBehavior::className(),
                'languages' => ['ru'],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categorie_id'], 'integer'],
            [['product'], 'required'],
            [['description'], 'string'],
            [['product', 'slug', 'image'], 'string', 'max' => 255],
            [['categorie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['categorie_id' => 'id']],
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
            'product' => 'Товар',
            'slug' => 'Slug',
            'description' => 'Описание',
            'image' => 'Image',
            'images' => 'Картинка',
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
