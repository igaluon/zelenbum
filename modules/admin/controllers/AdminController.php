<?php

namespace app\modules\admin\controllers;

use app\models\Categorie;
use Yii;
use app\imageresize\ImageResize;
use app\models\CategorieSearch;
use app\models\ProductSearch;
use app\models\User;
use yii\filters\AccessControl;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Product;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\UrlManager;

/**
 * Class AdminController
 * @package app\modules\admin\controllers
 */
class AdminController extends Controller
{
    public $layout = 'admin/main';

    /**
     * Права доступа в админку
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['admin/admin'],
                        'roles' => ['@'] // авторизованные доступ ко всей админке
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['admin/admin'],
                        'actions' => ['login'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?'] // неавторизованные доступ только к логину
                    ],
                ]
            ],

        ];
    }


    /**
     * Вход в админку
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $this->redirect('/web/admin/product');

        }

        $this->layout = 'admin/main-login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Редактирование отдельной категории
     * @return mixed
     */
    public function actionEdit()
    {

        $name = \yii::$app->request->get('categorie.categorie');

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('edit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'name_rus' => $model_category->categorie,
            'name' => $name,
        ]);

    }

    /**
     * Обновление данных как с индексной страницы, так и с отдельных категорий($edit)
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        if ($id == 0) {
            $this->redirect(['index']);
        }

        $model = $this->findModel($id);
        // получаем пост-данные
        if ($model->load( Yii::$app->request->post()) ) {
            // получаем картинку из формы, если она выбрана
            $model->images = UploadedFile::getInstance($model, 'images');
            // если картинка существует - загружаем ее
            if($model->images) {
                // если есть предидущая картинка - удаляем ее
                if($model->image) {
                   unlink($model->image);
                } // валидируем данные
                if ($model->validate()) {
                    // загружаем новую картинку в нужную директорию
                    $path = Yii::getAlias("@app/web/uploads/" . $model->categorie_id);
                    $extens = time() .'.' .$model->images->extension;
                    $model->images->saveAs($path .DIRECTORY_SEPARATOR .$extens);

                    // Изменение размера картинки на нужный нам
                    // -----------------------------------------
                    // Получаем картинку из директории
                    $image = $path . DIRECTORY_SEPARATOR . $extens;
                    // Даем новое имя
                    $new_name = $path .DIRECTORY_SEPARATOR .time() .'.' .$model->images->extension;

                    // Вызываем экземпляр класса ImageResize
                    $imageresize = new ImageResize();

                    // Вызываем метод imageresize и задаем размеры картинки
                    $imageresize::imageresize($image, $new_name, 220, 300);

                    // -----------------------------------------

                    // создаем адрес новой картинки для записи в базу данных
//                        $image = 'uploads/' .$model->category_name .DIRECTORY_SEPARATOR .$model->images;
                        $image = 'uploads/' .$model->categorie_id .DIRECTORY_SEPARATOR .$extens;
                        $model->image = $image;
                    // сохраняем все данные в базу
                        $model->save(false);
                    // если редактировалась отдельная категория - редирект на категорию(edit)
                    if (\yii::$app->session->get('edit') == 'edit') {
                        return $this->redirect(['edit', 'name' => \yii::$app->session->get('name')]);
                    }
                        // если пришли с индекса - возвращаемся на индексную страницу
                     return $this->redirect(['index']);
                }
            }  // если картинка не выбрана - обновляются остальные данные
                $model->save();
            // если редактировалась отдельная категория - редирект на категорию(edit)
            if (\yii::$app->session->get('edit') == 'edit') {
                return $this->redirect(['edit', 'name' => \yii::$app->session->get('name')]);
            }
            // если пришли с индекса - возвращаемся на индексную страницу
                return $this->redirect(['index']);
      } // вывод формы обновления
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id id of the parent category
     * @return mixed
     */
    public function actionCreateCategorie($id = null)
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
     * Удаление товара
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);

//        \yii::$app->session->set('name', $model->categorie_id);

        if (is_file($model->image)) {
        unlink($model->image);
        }

        $model->delete();

//        if (\yii::$app->session->get('name')) {
//            $name = \yii::$app->request->get('name');
//           return $this->redirect(['edit', 'name'=> \yii::$app->session->get('name')]);
//        }

        return $this->redirect(['index']);
    }

    /**
     * Выбор категории для загрузки картинок
     * @return string
     */
    public function actionCategory()
    {

        $name = Yii::$app->request->get('id');

       \yii::$app->session->set('id', $name);

        $path = Yii::getAlias("@app/web/uploads/" . $name . "/");
        $images = [];

        try {
            if(is_dir($path)) {
                $files = \yii\helpers\FileHelper::findFiles($path);

                foreach ($files as $file) {
                    $images[] = '<img src="/web/uploads/' . $name . '/' . basename($file) . '" width=250>';
                }
            }
        }
        catch(\yii\base\Exception $e){}

//        $name_category = $this->findCategorieModel($name)->categorie;
//var_dump($name);die;
        return $this->render("category",['images' => $images, 'name' => $name]);

    }

    /**
     * Загрузка картинок
     * @return bool
     */
    public function actionFileUploadImages()
    {

        if(Yii::$app->request->isPost){
            // Получаем категорию через метод-post
            $name_category = Yii::$app->request->post('name');

            // Создаем путь для загрузки картинки
            $path = Yii::getAlias("@app/web/uploads/" . $name_category);

            // Создаем директорию для загрузки картинки
            BaseFileHelper::createDirectory($path, 0755, true);

            // Достаем картинку из формы
            $file = UploadedFile::getInstanceByName('images');

            // Меняем название картинки для защиты от кирилицы
            $extens = time().'.'.$file->extension;

            // Загружаем картинку в нужную директорию
            $file->saveAs($path .DIRECTORY_SEPARATOR .$extens);

//            $file->saveAs($path .DIRECTORY_SEPARATOR .$file);

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
                'image' => 'uploads/' .$name_category .DIRECTORY_SEPARATOR .$extens,
            ];

            $product = new Product();

            $product->attributes = $values;
            $product->save(false);

            sleep(1);
            return true;

        }
    }

    /**
     * Выход из админки
     * @param bool $destroySession
     * @return \yii\web\Response
     */
    public function actionLogout($destroySession = true)
    {

        \Yii::$app->user->logout();
//        return $this->goBack();
        return $this->redirect('admin/login');
    }

    /**
     * Получаем модель Product по id
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
//        if ($model = Product::find()->with('categorie')->where(['id' => $id])->one() !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//        $model = Product::find()->with('categorie')->where(['id' => $id])->one();
    }

    public function actionModel()
    {

    }

    /**
     * Получаем модель Product по name (названию категории)
     * @param $name
     * @return static
     */
    protected function findProductModel($name)
    {
        $model = Product::findOne(['category_name' => $name]);
        return $model;

    }

    /**
     * Получаем модель Category по name (названию категории)
     * @param $name
     * @return static
     */
    protected function findCategorieModel($name)
    {
        $model = Categorie::findOne(['categorie' => $name]);
        return $model;

    }

/**
 * Установка логина и пароля админа
 */
//    public function actionAddAdmin()
//    {
//        $model = User::find()->one();

//        if (empty($model)) {
//            $user = new User();
//            $user->username = 'admin';
//            $user->setPassword('123456');
//            $user->generateAuthKey();
//            if ($user->save()) {
//                echo 'Its good';
//            }
//        }
//    }

}
