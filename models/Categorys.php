<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorys".
 *
 * @property int $id
 * @property string $category
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 *
 * @property Categorys $parent
 * @property Categorys[] $categorys
 * @property Products[] $products
 */
class Categorys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'default', 'value' => null],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'title' => 'Category Name',
            'slug' => 'Slug',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Categorys::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorys()
    {
        return $this->hasMany(Categorys::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['categorys_id' => 'id']);
    }

    /**
     * Вывод главного меню
     * @return array
     */
    public static function menuItems()
    {
        /** @var Categorys $category */
        $category = null;

        $categories = Categorys::find()->indexBy('id')->orderBy('id')->all();

      return $items = static::getMenuItems($categories, isset($category->id) ? $category->id : null);

    }

    /**
     * @param Categorys[] $categories
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
                    'label' => $category->title,
//                    'labelTemplate' => $category->parent_id === $parent ? '<a href="#"></a>' : '#',
                    'url' => $category->parent_id === $parent ? ['catalog/list', 'id' => $category->id] : '#',
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
     * @param Categorys[] $categories all categories
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
}
