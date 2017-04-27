<?php

namespace app\models;

use Yii;

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
            'parent_id' => 'Parent ID',
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
    private function getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
//                    'active' => $activeId === $category->id,
//                    'active' => true,
                    'label' => $category->categorie,
//                    'labelTemplate' => $category->parent_id === $parent ? '<a href="#"></a>' : '#',
                    'url' => $category->parent_id === $parent ? ['edit', 'id' => $category->categorie] : '#',
//                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => static::getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }

        return $menuItems;
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Categorie[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            elseif ($category->parent_id == $categoryId){
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
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
                    'url' => $category->parent_id === $parent ? ['category', 'id' => $category->id] : '#',
//                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => static::getAdminMenuItems($categories, $activeId, $category->id),

//                        ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'id' => $category->categorie],],
//                        ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'id' => $category->id],],
                ];
            }
        }

        return $menuItems;
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Categorie[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getAdminCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            elseif ($category->parent_id == $categoryId){
                $this->getAdminCategoryIds($categories, $category->id, $categoryIds);
            }
        }
        return $categoryIds;
    }
}
