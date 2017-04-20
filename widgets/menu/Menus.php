<?php

namespace app\widgets\menu;

use app\models\Categorys;
use yii;

class Menus extends yii\widgets\Menu
{

    public function init()
    {
        parent::init();
    }

//    public function run()
//    {
//        $categories = Categorys::find()->indexBy('id')->orderBy('id')->all();
//        return $getMenuItems = $this->getMenuItems($categories, isset($categories->id) ? $categories->id : null);
//    }

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
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
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

//        $model = new Product;
//        $name = \yii::$app->cache->get('name');
////        $getname =  $model->getCat($name);
////        var_dump($getname);die;
////        $getname =  $getname->category_name;
//        $model = $model->findOne(10);
//        return $this->render('menu', ['model' => $model]);
//    }
}