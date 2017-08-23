<?php

use yii\helpers\Html;
use yii\helpers\Markdown;

?>

<div class="clear"></div>
<div class="grid_12 rt-indent-bottom-1">
    <div class="flex-border">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/slide-1.jpg" alt="">
                </li>
                <li>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/slide-2.jpg" alt="">
                </li>
                <li>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/slide-3.jpg" alt="">
                </li>
                <li>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/slide-4.jpg" alt="">
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="clear"></div>
<div class="grid_12">
    <div class="heading-wrapper indent-bot-2"><h3><?=\Yii::t('app', 'Ассортимент')?></h3><div class="heading-after"></div></div>
    <div>
        <div class="grid_4 alpha rt-indent-bottom-1">
            <a href="/category?id=1">
                <div class="img-border indent-bot-3">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/page1-img1.jpg" alt="" />
                </div>
                <p class="img-caption"><a href="/category?id=1"><?=\Yii::t('app', 'Камень')?></a></p>
            </a>
        </div>
        <div class="grid_4 rt-indent-bottom-1">
            <a href="/category?id=2">
                <div class="img-border indent-bot-3">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/page1-img2.jpg" alt="" />
                </div>
                <p class="img-caption"><a href="/category?id=2"><?=\Yii::t('app', 'Садовая мебель')?></a></p>
            </a>
        </div>
        <div class="grid_4 omega">
            <a href="/category?id=3">
                <div class="img-border indent-bot-3">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/page1-img3.jpg" alt="" />
                </div>
                <p class="img-caption"><a href="/category?id=3"><?=\Yii::t('app', 'Ретро сувениры')?></a></p>
            </a>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
</div>
<div class="container_12">
    <div>
        <div class="grid_12">
            <div class="banner">
                <div class="banner-bg">
                    <div class="banner-header"><?=\Yii::t('app', 'Подчеркните Вашу индивидуальность!')?></div>
                    <p><?=\Yii::t('app', 'Компания "Зеленбум" существует уже более 16 лет и является одной из ведущих компаний по комплексному снабжению материалами для строительства и благоутсройства територии. <br>Занимаемся переработкой и реализацией ланшафтного камня, отделочной и облицовочной плитки. Изготавливаем беседки, перголы, садовую мебель, кованые изделия. В наличии большой ассортимент плетеной мебели и ретро-сувениров.')?></p>
                </div>
            </div>
            <!-- content -->
            <section id="content">
                <div class="wrapper">
                    <div class="grid_4 alpha rt-indent-bottom-1">
                        <div class="maxheight" style="height: 105px;">
                            <h2 class="indent-bot-3"><?=Html::encode(\Yii::t('app', 'Что о нас говорят'))?></h2>
                            <div class="comment">
                                <?=\Yii::t('app', ' Я очень рада связать судьбу моего Сада с вами! Мы только начинаем сотрудничать, но я уже сейчас получаю массу удовольствия от нашей совместной работы, и надеюсь, мой сад с вашей помощью превратиться в "Сад моей мечты".')?>                                </div>
                        </div>
                    </div>
                    <div class="grid_4 rt-indent-bottom-1">
                        <div class="rt-block-indent-1 border-separator maxheight" style="height: 105px;">
                            <h2 class="indent-bot-3">&nbsp;</h2>
                            <div class="comment">
                                <?=\Yii::t('app', 'Заказывали материалы для благоустройства участка в 2016 году, остались довольны сотруднечеством.')?>                                 </div>
                        </div>
                    </div>
                    <div class="grid_4 omega">
                        <div class="rt-block-indent-1 border-separator maxheight" style="height: 105px;">
                            <h2 class="indent-bot-3">&nbsp;</h2>
                            <div class="comment">
                                <?=\Yii::t('app', ' В данной компании подбирали подарок шефу. Сотрудники  Зеленбума предложили массу вариантов из ретро сувениров. В итоге купили отличный востановленный самовар. Самое главное - именнинику угодили. Думаю, обязательно вернемся еще за нестандартными презентами.')?>                                </div>
                        </div>
                    </div>
                </div>
            </section><!-- end content -->

