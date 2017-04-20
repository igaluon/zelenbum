<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $category
 * @property string $category_name
 * @property string $parent_category

 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [[ 'category', 'category_name', 'parent_category'], 'string', 'max' => 55],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Категория',
            'category' => 'Транслит (латинскими буквами)',
            'parent_category' => 'Родительская категория',
        ];

    }

    public static function CategoryMenu()
    {

        $categories=Category::find()->all();

            foreach ($categories as $value) {

               //  Вывод меню категорий
                if ($value->category_name) {
                    $items[] = [
                        'label' => $value->category_name,
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'name' => $value->category],],
                            ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'name' => $value->category],],
                        ],
                    ];
                }
//
//                // Вывод меню подкатегорий
//                if ($value->parent_category) {
//
//                    $items[] = [
//                        'label' => $value->parent_category,
//                        'icon' => 'fa fa-share',
//                         'url' => '#',
//                            'items' => [
//                                ['label' => $value->category_name,
//                                'icon' => 'fa fa-share',
//                                'url' => '#',
//                                    'items' => [
//                                        ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'name' => $value->category],],
//                                        ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'name' => $value->category],],
//                                     ],
//                                ],
//                            ],
//                    ];
//                }
//            }
//        if ($value->category_name) {
//            $items[] = [
//                'label' => $value->parent_category? '': $value->category_name,
//                'icon' => 'fa fa-share',
//                'url' => ['admin/category', 'name' => $value->category],
//                 'items' => [
//                    ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'name' => $value->category],],
//                    ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'name' => $value->category],],
//                ],
//            ];
//        }

//        if ($value->parent_category) {
//
//                    $items[] = [
//                        'label' => $value->category_name,
//                        'icon' => 'fa fa-share',
//                         'url' => '#',
////                            'label' => $value->parent_category? '': $value->category_name,
////                            'icon' => 'fa fa-share',
////                            'url' => ['admin/category', 'name' => $value->category],
//                        $value->category_name? "'items' => [
//                                ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'name' => $value->category],],
//                                ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'name' => $value->category],],
//                            ],"
//                            : "'items' => [
//                                ['label' => $value->parent_category,
//                                'icon' => 'fa fa-share',
//                                'url' => '#',
//                                    'items' => [
//                                        ['label' => 'Загрузить картинки', 'icon' => 'fa fa-file-code-o', 'url' => ['admin/category', 'name' => $value->category],],
//                                        ['label' => 'Редактировать ', 'icon' => 'fa fa-dashboard', 'url' => ['admin/edit', 'name' => $value->category],],
//                                     ],
//                                ],
//                            ];",
//                    ];
        }

        return $items;
    }

//    public function getProduct()
//    {
//        return $this->hasMany(Product::className(), ['category_name' => 'category']);
//    }
}


