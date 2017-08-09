<?php

namespace app\widgets\menu;

use app\models\Categorie;
use yii;

class Menus extends yii\widgets\Menu
{

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function run()
    {
        echo $this->render('menu');
    }

    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['menu'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'ru-RU',
            'basePath'       => '@app/widgets/menu/messages',
//            'fileMap'        => [
//                'widgets/menu/messages' => 'messages.php',
//            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }
}