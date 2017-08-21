<footer>
    <?php
    /*
     * Вывод списка языков для выбора пользователю
     */
    use yii\helpers\Html;

    $language = Yii::$app->language; //текущий язык
    //Создаем массив ссылок всех языков с соответствующими GET параметрами
    $array_lang = [
        'en' => Html::a('English', ['site/language', 'lang' => 'en']),
        'ru' => Html::a('Русский', ['site/language', 'lang' => 'ru']),
        'uk' => Html::a('Українська', ['site/language', 'lang' => 'uk']),
    ];
    //ссылку на текущий язык не выводим
    if(isset($array_lang[$language])) unset($array_lang[$language]);
    ?>

    <div class="language-ksl">
        <?php foreach ($array_lang as $lang) {
            echo ' '.$lang.' ';
        } ?>
    </div>
    <ul class="list-soc">
        <li><a href="https://vk.com/id344748408" targer="_blank"><img src="<?php echo Yii::$app->request->baseUrl; ?>/images/soc-icon-1.png" alt=""></a></li>
    </ul>
    <div class="policy">Зеленбум © 2017 <br class="br-h"> Все права защищены
        <div class="powered-by">Powered by <a href="http://igorsharay.com" target="_blank">Igor Sharay</a></div>
    </div>
    <div class="clear"></div>
</footer><!-- end footer -->