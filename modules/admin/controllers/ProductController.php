<?php

namespace app\modules\admin\controllers;

use app\imageresize\ImageResize;
use app\models\Categorie;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
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
//    public $layout = '//modules/admin/admin/layuots/main';

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
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $product = new Product();

        if ($product->load( Yii::$app->request->post()) ) {

            // Получаем категорию через метод-post
var_dump($product->categorie);die;
            // Создаем путь для загрузки картинки
            $path = Yii::getAlias("@app/web/uploads/" . $product['Product']['categorie']);

            // Создаем директорию для загрузки картинки
            BaseFileHelper::createDirectory($path, 0755, true);

            // Достаем картинку из формы
            $file = UploadedFile::getInstanceByName($product['Product']['images']);
var_dump($file);die;
            // Меняем название картинки для защиты от кирилицы
            $extens = time().'.'.$file->extension;

            // Загружаем картинку в нужную директорию
            $file->saveAs($path .DIRECTORY_SEPARATOR .$extens);

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
                'image' => 'uploads/' .$product->categorie_id .DIRECTORY_SEPARATOR .$extens,
            ];

            $product->attributes = $values;
            $product->save(false);

            return $this->redirect(['view', 'id' => $product->id]);

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

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
