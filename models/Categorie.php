<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;


/**
 * This is the model class for table "categorie".
 *
 * @property string $categorie
 * @property string $slug
 * @property int $parent_id
 *
 * @property Categorie $parent
 * @property Categorie[] $categories
 * @property Product[] $products
 */
class Categorie extends \yii\db\ActiveRecord
{
    public $product;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorie';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['categorie'],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categorie'], 'required'],
            [['parent_id'], 'integer'],
            [['categorie', 'slug'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categorie' => 'Категория',
            'slug' => 'Slug',
                'parent_id' => 'Родительская',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categorie::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['categorie_id' => 'id']);
    }

    /**
     * Вывод главного меню
     * @return array
     */
    public static function menuItems()
    {
        /** @var Categorie $category */
        $category = null;

        $categories = Categorie::find()->indexBy('id')->orderBy('id')->all();

        return $items = static::getMenuItems($categories, isset($category->id) ? $category->id : null);

    }

    /**
     * @param Categorie[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private static function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
//                    'active' => $activeId === $category->id,
//                    'active' => true,
                    'label' => $category->categorie,
//                    'labelTemplate' => $category->parent_id === $parent ? '<a href="#"></a>' : '#',
//                    'url' => isset($category->parent_id) ? ['site/product', 'id' => $category->id, 'name' => $category->categorie] : '#',
                    'url' => ['site/product', 'id' => $category->id, 'name' => $category->categorie],
                    'items' => static::getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }

        return $menuItems;
    }

    /**
     * Вывод меню в админке
     * @return array
     */
    public static function menuAdminItems()
    {
        /** @var Categorie $category */
        $category = null;

        $categories = Categorie::find()->indexBy('id')->orderBy('id')->all();

        return $items = static::getAdminMenuItems($categories, isset($category->id) ? $category->id : null);

    }

    /**
     * @param Categorie[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getAdminMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
//                    'active' => $activeId === $category->id,
//                    'active' => true,
                    'label' => $category->categorie,
//                    'labelTemplate' => $category->parent_id === $parent ? '<a href="#"></a>' : '#',
                    'url' => ['category', 'id' => $category->id],
//                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => static::getAdminMenuItems($categories, $activeId, $category->id),

//                        ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'id' => $category->categorie],],
//                        ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'id' => $category->id],],
                ];
            }
        }

        return $menuItems;
    }

}
