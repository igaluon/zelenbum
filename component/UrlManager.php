<?php
/*
 * Добавляет указатель языка в ссылки на сайте
 */
namespace app\component;
use Yii;

class UrlManager extends \yii\web\UrlManager {

//    public function createUrl($params) {
//        if (empty($params['lang'])) {
//            $params['lang'] = Yii::$app->language;
//        }
//        return parent::createUrl($params);
//
//    }
    public function createUrl($params) {
        $url = Yii::$app->request->url;
//        echo $url;die;

        preg_match("#^(/\w+)?#", $url, $match_arr);
//        var_dump($match_arr[1]);die;
        if (isset($match_arr[1]) && $match_arr[1] == '/admin' | $match_arr[1] == '/seo') {
            return parent::createUrl($params);
        }
        elseif (empty($params['lang'])) {
            $params['lang'] = Yii::$app->language;
        }
        return parent::createUrl($params);

    }
}