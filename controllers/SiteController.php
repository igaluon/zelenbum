<?php

namespace app\controllers;

use app\models\Categorie;
use app\models\ContactForm;
use app\models\Product;
use app\models\RegisterMetaTag;
use app\models\User;
use app\component\GoMail;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;



class SiteController extends Controller
{
    public $layout = "main";

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        \Yii::$app->cache->flush();

        $model = new RegisterMetaTag();

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
    public function actionProduct($id)
    {
        $this->layout = 'products';

        $metatag = new RegisterMetaTag();

        $model = Product::findAll(['categorie_id' => $id]);

        $category = Categorie::findOne(['id' => $id]);

        return $this->render('products',
            [
                'model' => $model,
                'name' => $category->categorie,
                'metatag' => $metatag,
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
