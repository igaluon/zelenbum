<?php

namespace app\modules\admin\controllers;

use app\imageresize\ImageResize;
use app\models\Categorie;
use Imagine\Gmagick\Image;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\filters\AccessControl;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $layout = 'admin/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['admin/product'],
                        'roles' => ['@'] // авторизованные доступ ко всей админке
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $product = new Product();

        // Получаем категорию через метод-post
        if ($product->load( Yii::$app->request->post()) ) {

            // Создаем путь для загрузки картинки
            $path = Yii::getAlias("@app/web/uploads");

            // Создаем директорию для загрузки картинки
            BaseFileHelper::createDirectory($path, 0777, true);
            // Достаем картинку из формы
            $product->images = UploadedFile::getInstance($product, 'images');
            // Если картинка не выбрана - сохраняем остальные поля в базу и редирект на index
            if ($product->images == null) {

                $product->save();

                return $this->redirect(['index']);

            }

            // Меняем название картинки для защиты от кирилицы
            $extens = time() .'.' .$product->images->extension;
            // Загружаем картинку
            $product->images->saveAs($path .DIRECTORY_SEPARATOR .$extens);

            // Изменение размера картинки на нужный нам
            // -----------------------------------------
            // Получаем картинку из директории
            $image = $path .DIRECTORY_SEPARATOR .$extens;
            // Даем новое имя
            $new_name = $path .DIRECTORY_SEPARATOR .$extens;

            // Создаем экземпляр класса ImageResize
            $imageresize = new ImageResize();

            // Вызываем метод imageresize и задаем размеры картинки
            $imageresize::imageresize($image, $new_name, 220, 300);

            // -----------------------------------------

            // Сохраняем все данные в базу

            $values = [
                'image' => 'uploads' .DIRECTORY_SEPARATOR .$extens,
                'product' => $product->product,
                'description' => $product->description,
                'categorie_id' => $product->categorie_id,
            ];

            $product->attributes = $values;
            $product->save(false);

            // Если все удачно - редирект на index
            return $this->redirect(['index']);

        } else {

            $categories = Categorie::find()->all();

            return $this->render('create', [
                'model' => $product,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);

        // Получаем категорию через метод-post
        if ($product->load( Yii::$app->request->post()) ) {

            // Создаем путь для загрузки картинки
            $path = Yii::getAlias("@app/web/uploads");

            // Создаем директорию для загрузки картинки
            BaseFileHelper::createDirectory($path, 0755, true);

            // Достаем картинку из формы
            $product->images = UploadedFile::getInstance($product, 'images');

            // Если картинка не выбрана - сохраняем остальные поля в базу и редирект на index
            if ($product->images == null) {

                $product->save();

                return $this->redirect(['index']);

            }
                // Меняем название картинки для защиты от кирилицы
            $extens = time() .'.' .$product->images->extension;
            // Загружаем картинку
            $product->images->saveAs($path .DIRECTORY_SEPARATOR .$extens);

            // Изменение размера картинки на нужный нам
            // -----------------------------------------
            // Получаем картинку из директории
            $image = $path .DIRECTORY_SEPARATOR .$extens;
            // Даем новое имя
            $new_name = $path .DIRECTORY_SEPARATOR .$extens;

            // Создаем экземпляр класса ImageResize
            $imageresize = new ImageResize();

            // Вызываем метод imageresize и задаем размеры картинки
            $imageresize::imageresize($image, $new_name, 220, 300);
            // -----------------------------------------
//            unset($product->image);
            // Сохраняем все данные в базу

            $values = [
                'image' => 'uploads' .DIRECTORY_SEPARATOR .$extens,
                'product' => $product->product,
                'description' => $product->description,
                'categorie_id' => $product->categorie_id,
            ];

            $product->attributes = $values;
            $product->save(false);

            // Если все удачно - редирект на index
            return $this->redirect(['index']);
        } else {

            $categories = Categorie::find()->all();

            return $this->render('update', [
                'model' => $product,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id id of the parent category
     * @return mixed
     */
    public function actionCategorie($id = null)
    {
        $categories = Categorie::find()->all();
        $model = new Categorie();
        $model->parent_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (is_file($model->image)) {
            unlink($model->image);
        }

        $model->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
