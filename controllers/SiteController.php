<?php

namespace app\controllers;

use app\languages\LanguageKsl;
use app\models\Categorie;
use app\models\ContactForm;
use app\models\Product;
use app\models\User;
use app\component\GoMail;
use Yii;
use yii\helpers\Html;
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
    public function actions()
    {
        return [
            'language' => [
                'class' => 'app\languages\LanguageAction',
            ],
        ];
    }
    /**
     *
     */
//    public function actionLanguage()
//
//         $language = Yii::$app->request->get('lang');
//
//         //предыдущая страница
//         $url_referrer = Yii::$app->request->referrer;
//
//         //С.Ш. мой костыль - если $url_referrer пустой - формируем его под индексную страницу
//        if ($url_referrer == null) {
//            $url_referrer = Yii::$app->request->hostInfo. '/ru';
//        }
//         /*
//          * разбивает URL на подмассив $match_arr
//          * 0. http://site.loc/ru/contact
//          * 1. http://site.loc
//          * 2. ru или uk или en
//          * 3. остальная часть
//          */
//         $list_languages = LanguageKsl::$url_language; //список языков
//
//
//        preg_match("#^(http:\/\/\w+\.\w+)/($list_languages)?(.*)#",$url_referrer, $match_arr);
//        // замена идентификатора языка
//        $match_arr[2] = '/'.$language;
//        // создание нового URL
//        $url = $match_arr[1].$match_arr[2].$match_arr[3];
////        var_dump($url);die;
//        // перенаправление
//        Yii::$app->response->redirect($url);
//     }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo " <p>" .\Yii::$app->session->get('success') ? \Yii::$app->session->get('success') : \Yii::$app->session->get('error')."<p>";

        \Yii::$app->session->set('success', '');

        \Yii::$app->session->get('error', '');

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
                'categorie' => $category,
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
                \Yii::$app->session->set('success', 'Ok');
       }

        $success = \Yii::$app->session->get('success');
        return $this->render("contact", ['model' => $model, 'success' => $success]);

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
        $this->layout = 'white';
        return $this->render('our_works');
    }



        public function actionUrl()
    {
        echo 1, Yii::$app->controller->id, '<br>';
        echo 2, Yii::$app->basePath, '<br>';
        echo 2.1, Yii::$app->homeUrl, '<br>';
        echo 2.2, Yii::$app->request->hostInfo, '<br>';
        echo 2.3, Yii::$app->getHomeUrl(), '<br>';
       echo 3, Yii::$app->controller->action->id, '<br>';
        Yii::setAlias('@frontendWebroot', Yii::$app->request->baseUrl);
        $url = Yii::getAlias('@frontendWebroot');
        echo 4, Yii::getAlias('@frontendWebroot'), '<br>';
        echo 5, Yii::getAlias('@notgosu/yii2/modules/metaTag/messages'), '<br>';
        echo 6, Yii::getAlias('/aquy/seo/module/messages'), '<br>';
        echo 7, Yii::getAlias('@aquy/seo/module/message'), '<br>';
        echo $url;
    }

}
