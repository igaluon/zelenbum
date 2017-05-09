<?php

namespace app\controllers;

use app\models\Categorie;
use app\models\Category;
use app\models\Product;
use app\models\User;
use Yii;
use yii\web\Controller;



class SiteController extends Controller
{
    public $layout = "main";

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Product();

        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionError()
    {
        return $this->render('error');
    }


    /**
     * @return string
     */
    public function actionProduct($id,$name)
    {
        $this->layout = 'products';

        $metatag = new Category();

        $model = Product::findAll(['categorie_id' => $id]);

        return $this->render('products', ['model' => $model, 'name' => $name, 'metatag' => $metatag]);
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
 * @ret
 *
 * urn string
     */
    public function actionExample()
    {

//        $id = Yii::$app->request->get('id');
//        $name = Yii::$app->request->get('name');
        $id = 'tree';
        $name = 'Дерево';
//        \Yii::$app->params['some_value' => $name];
        \yii::$app->cache->set('name', $name);

        $model = Product::findAll(['category_name' => $id]);

        return $this->render('example', ['model' => $model, 'name' =>$name]);
    }

    public function actionHasMany()
    {
        $product = Categorys::find()
            ->with('product')
//            ->where(2)
            ->all();
        foreach ($product as $value) {
           echo $value->category, '<br>';
        }
    }
        public function actionUrl()
    {
        Yii::setAlias('@frontendWebroot', Yii::$app->request->baseUrl);
        $url = Yii::getAlias('@frontendWebroot');
        echo Yii::getAlias('@frontendWebroot');
        echo $url;
    }
    public function actionOurWorks()
    {
        return $this->render('our_works');
    }

}
