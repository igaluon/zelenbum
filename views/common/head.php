<?php

use app\widgets\menu\Menus;

?>
<div class="bg-head">
    <div class="glow">
        <div class="top-shadow">
            <div class="container_12">
                <div>
                    <div class="grid_12">
                        <!-- header -->
                        <header>
                            <h1 class="logo">
                                <a href="<?php echo Yii::$app->homeUrl; ?>">
                                    <img src="<?php echo Yii::$app->getRequest()->getBaseUrl(true); ?>/images/logo.png" width="150px" height="65px" alt="Зеленбум - Все для красивой усадьбы" />
                                </a>
                            </h1>
                            <div class="menu-search">
                                <!-- menu -->
                                <nav>

                                    <?= Menus::widget();?>

                                </nav>
                                <?php
                                /*
                                 * Вывод списка языков для выбора пользователю
                                 */
                                use yii\helpers\Html;

                                $language = Yii::$app->language; //текущий язык
                                //Создаем массив ссылок всех языков с соответствующими GET параметрами Українська
                                $array_lang = [
//                                'en' => Html::a('English', ['site/language', 'lang' => 'en']),
                                    'en' => Html::a(Html::img("/images/usa.gif", ['alt' => 'English', 'title' => 'English', 'width' => '20px',  'height' => '20px']), ['site/language', 'lang' => 'en']),
                                    'ru' => Html::a(Html::img("/images/russia.gif", ['alt' => 'Русский', 'title' => 'Русский',  'width' => '20px',  'height' => '20px']), ['site/language', 'lang' => 'ru']),
                                    'uk' => Html::a(Html::img("/images/ukraina.gif", ['alt' => 'Українська', 'title' => 'Українська',  'width' => '20px',  'height' => '20px']), ['site/language', 'lang' => 'uk']),
                                ];
                                //ссылку на текущий язык не выводим
                                if(isset($array_lang[$language])) unset($array_lang[$language]);
                                ?>

                                <div class="language-ksl">
                                    <?php foreach ($array_lang as $lang) {
                                        echo ' '.$lang.' ';
                                    } ?>
                                </div>

                            </div>

<div class="clear"></div>

</header><!-- end header -->
</div>