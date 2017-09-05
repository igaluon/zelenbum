<?php
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */

 $lang = Yii::$app->request->get('lang');
?>

<div class="container-fluid">
    <div class="row">
        <div class="grid_12">
            <!-- header -->
            <header>


                <div class="menu-search">
                    <!-- menu -->
                    <nav>
                        <?php $itemsInCart = Yii::$app->cart->getCount(); ?>
                        <?= \app\widgets\menu\Menus::widget();?>

                    </nav>
                    <?php
                    /*
                     * Вывод списка языков для выбора пользователю
                     */

                    $language = Yii::$app->language; //текущий язык
                    //Создаем массив ссылок всех языков с соответствующими GET параметрами Українська
                    $array_lang = [
//                                'en' => Html::a('English', ['site/language', 'lang' => 'en']),
                        'en' => Html::a(Html::img("/images/usa.gif", ['alt' => 'English', 'width' => '30px',  'height' => '15px']), ['site/language', 'lang' => 'en']),
                        'ru' => Html::a(Html::img("/images/russia.gif", ['alt' => 'Русский', 'width' => '30px',  'height' => '15px']), ['site/language', 'lang' => 'ru']),
                        'uk' => Html::a(Html::img("/images/ukraina.gif", ['alt' => 'Українська', 'width' => '30px',  'height' => '15px']), ['site/language', 'lang' => 'uk']),
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

        <div class="cart">
            <h1><?=\Yii::t('app', 'Ваша корзина : ')?></h1>

    <?php foreach ($products as $product):?>
    <?php if (empty($product)) {?>
                <h1><?=\Yii::t('app', 'пустая')?></h1>
            <?php ;} ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-4">

                        </div>
                        <div class="col-xs-2">
                            <?=\Yii::t('app', 'Цена')?>
                        </div>
                        <div class="col-xs-2">
                            <?=\Yii::t('app', 'Количество')?>
                        </div>
                        <div class="col-xs-2">
                            <?=\Yii::t('app', 'Сумма')?>
                        </div>
                        <div class="col-xs-2">

                    </div>
                </div>
<!--                --><?php //foreach ($products as $product):?>
                <div class="row">
                    <div class="col-xs-4">
                        <?= Html::encode(\Yii::t('app', $product->product)) ?>
                    </div>
                    <div class="col-xs-2">
                        <?php echo $lang == 'en' ?  '$' .round($product->price/26) :  $product->price. 'грн';?>
                    </div>
                    <div class="col-xs-2">
                        <?= $quantity = $product->getQuantity()?>

                        <?= Html::a('-', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-danger', 'disabled' => ($quantity - 1) < 1])?>
                        <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-success'])?>
                    </div>
                    <div class="col-xs-2">
                        <?php echo $lang == 'en' ?  '$' .round($product->getCost()/26) :  $product->getCost(). 'грн';?>
                    </div>
                    <div class="col-xs-2">
                        <?= Html::a('×', ['cart/remove', 'id' => $product->getId()], ['class' => 'btn btn-danger'])?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <div class="col-xs-2">
                        <?=\Yii::t('app', 'Обшая сумма:')?>
                        <?php echo $lang == 'en' ?  '$' .round($total/26) :  $total. 'грн';?>
                    </div>
                    <div class="col-xs-2">
                        <?= Html::a(\Yii::t('app', 'Купить'), ['cart/order'], ['class' => 'btn btn-success'])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>