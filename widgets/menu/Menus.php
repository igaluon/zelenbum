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
}