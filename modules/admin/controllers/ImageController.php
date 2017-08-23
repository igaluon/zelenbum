<?php

namespace app\modules\admin\controllers;

use Yii;
use app\imageresize\ImageResize;
use app\models\Product;
use app\models\Categorie;
use yii\filters\AccessControl;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    public $layout = 'admin/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['admin/image'],
                        'roles' => ['@'] // авторизованные доступ ко всей админке
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Выбор категории для мультизагрузки картинок
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $images = [];
        $model = Product::find()->where(['categorie_id' => $id])->all();
        $path = Yii::getAlias("@app/web/uploads");

        if (isset($model)) {
            foreach ($model as $value) {
        try {
            if(is_dir($path)) {

                $images[] = '<img src="'.DIRECTORY_SEPARATOR .$value->image. '"width=170>';
            }
        }
        catch(\yii\base\Exception $e){}
            }
        }
        $name = $this->findModel($id)->categorie;

        return $this->render("/admin/category",['images' => $images, 'name' => $name, 'id' => $id]);
    }

    /**
     * Загрузка картинок
     * @param $id
     * @return bool
     */
    public function actionFileUploadImages($id)
    {

        if(Yii::$app->request->isPost){

            // Создаем путь для загрузки картинки
            $path = Yii::getAlias("@app/web/uploads");

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
                'image' => 'uploads' .DIRECTORY_SEPARATOR .$extens,
                'categorie_id' => $id,
            ];

            $product = new Product();

            $product->attributes = $values;
            $product->save(false);

            sleep(1);
            return true;

        }
    }

    /**
     * Finds the Categorie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categorie the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categorie::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
