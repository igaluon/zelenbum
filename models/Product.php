<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;


/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $categorie_id
 * @property string $product
 * @property int $price
 * @property string $slug
 * @property string $description
 * @property string $image
 */
class Product extends ActiveRecord implements CartPositionInterface
{
    public $images;

    use CartPositionTrait;

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if ($this->_product === null) {
            $this->_product = Product::findOne($this->id);
        }
        return $this->_product;
    }


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
            [['categorie_id', 'price'], 'integer'],
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
            'price' => 'Цена',
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
