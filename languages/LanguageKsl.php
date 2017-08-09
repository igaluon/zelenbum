<?php
/*
 * Класс подключается перед запуском приложения по событию beforeRequest
 * из config\main.php и устанавливает язык приложения
 *
 */
namespace app\languages;

use Yii;


class LanguageKsl
{
    static $url_language = '/ru|/uk|/en'; //используемые языки
    static $default_language = 'ru'; //основной язык (по-умолчанию)

    public function run(){
        $url = Yii::$app->request->url;
//var_dump($url);
        $list_languages = self::$url_language;
        preg_match("#^(/\w+)(/\w+)?($list_languages)?(/\w+)?(.*)?#", $url, $match_arr);
//        preg_match("#^(/\w+)(/en|/ru|/uk)?(/\w+)(/\w+)?#", $url, $match_arr);
//        var_dump($match_arr[1]);die;

        if($match_arr[2] == '/admin' |$match_arr[2] == '/seo'){
            return;
//            Yii::$app->response->redirect($match_arr[1].$match_arr[2].$match_arr[4]);;
        }
//echo $match_arr[3];die;
//var_dump(Yii::$app->formatter->locale);die;
        //Если URL содержит указатель языка - сохраняем его в параметрах приложения и используем
        if ($match_arr[3] && $match_arr[3] != '/'){
            $lang = $match_arr[3];
            Yii::$app->language = substr($lang, 1);
            Yii::$app->formatter->locale = substr($lang, 1);
            Yii::$app->homeUrl = $match_arr[3];

            /*
             * Если URL не содержит указатель языка (например главная страница)-
             * делаем перенаправление на ее же + добавляем GET параметр языка
             */
        } else {
            $lang = Yii::$app->request->get('lang');
//            $str=strpos(Yii::$app->language, '-');
//            $lang=substr(Yii::$app->language, 0, $str);
//            $lang = Yii::$app->language;
            Yii::$app->response->redirect(['site/ru/index']);
//            Yii::$app->response->redirect($lang. $match_arr[2]);
//            var_dump($match_arr[1].$match_arr[2].'/'.$lang.$match_arr[4].$match_arr[5]);die;
            if (isset($match_arr[5])) {
            Yii::$app->response->redirect($match_arr[1].$match_arr[2].'/'.$lang.$match_arr[4].$match_arr[5]);
            } else {
                    Yii::$app->response->redirect($match_arr[1].$match_arr[2].'/'.$lang.$match_arr[4]);

            }
        }
    }
}