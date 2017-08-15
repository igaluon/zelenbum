<?php

namespace app\controllers;

use app\languages\LanguageKsl;
use app\models\Categorie;
use app\models\ContactForm;
use app\models\Product;
use app\models\User;
use app\component\GoMail;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class SiteController extends Controller
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
//        \Yii::$app->language = 'en';

        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
//    public function actions()
//    {
//        return [
//            'language' => [
//                'class' => 'app\languages\LanguageAction',
//            ],
//        ];
//    }
    /**
     *
     */
    public function actionLanquage()
     {
         $language = Yii::$app->request->get('lang');
         //предыдущая страница
         $url_referrer = Yii::$app->request->referrer;
//         var_dump($url_referrer);die;
         /*
          * разбивает URL на подмассив $match_arr
          * 0. http://site.loc/ru/contact
          * 1. http://site.loc
          * 2. ru или uk или en
          * 3. остальная часть
          */
         $list_languages = LanguageKsl::$url_language; //список языков

//         preg_match("#^(http:\/\/\w+/\w+)($list_languages)?(.*)#",$url_referrer, $match_arr);
         preg_match("#^(http:\/\/\w+)(/\w+)(\/$list_languages)?#", $url_referrer, $match_arr);
         // замена идентификатр языка
         $match_arr[3] = '/' .$language;
         // создание нового URL
//        var_dump($match_arr[2].$match_arr[4].$match_arr[3].$match_arr[5]);die;
//         $url = $match_arr[2].$match_arr[4].$match_arr[3].$match_arr[5];
         $url = $match_arr[2].$match_arr[3];
         // перенаправление
         Yii::$app->response->redirect($url);
     }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        \Yii::$app->cache->flush();

        $model = new Categorie();

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
     * @param $id
     * @return string
     */
    public function actionProduct($id)
    {
        $this->layout = 'products';

        $model = new Categorie();

        $product = Product::findAll(['categorie_id' => $id]);

        $category = Categorie::findOne(['id' => $id]);

        return $this->render('products',
            [
                'model' => $model,
                'product' => $product,
                'name' => $category->categorie,
                'id' => $id,
            ]);
    }

    public function actionContacts()
    {
        $this->layout = 'white';

        $model = new ContactForm();

//        if(\yii::$app->request->isAjax){

            if($model->load(\Yii::$app->request->post()) && $model->validate()){
//                echo 'MOdel Success';
                $body = " <div>Body: <b> ".$model->body." </b></div>";
                $body .= " <div>Email: <b> ".$model->email." </b></div>";

                \Yii::$app->gomail->sendMail($model->phone,$body);

                print "Send success";
            die;

//        }
       }
        return $this->render("contact", ['model' => $model]);

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

    /**
     * @return string
     */
    public function actionOurWorks()
    {
        return $this->render('our_works');
    }



        public function actionUrl()
    {
        echo Yii::$app->controller->id;
        echo Yii::$app->request->baseUrl;
       echo Yii::$app->controller->action->id;
        Yii::setAlias('@frontendWebroot', Yii::$app->request->baseUrl);
        $url = Yii::getAlias('@frontendWebroot');
        echo Yii::getAlias('@frontendWebroot');
        echo Yii::getAlias('@notgosu/yii2/modules/metaTag/messages');
        echo Yii::getAlias('/aquy/seo/module/messages');
        echo Yii::getAlias('@aquy/seo/module/message');
        echo $url;
    }

}
