<?php
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */
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
                </div>
                <div class="clear"></div>
            </header><!-- end header -->
        </div>

        <div class="cart">
            <h1>Ваша корзина</h1>
            <?php if (empty($products)) {?>
                <h1>пуста</h1>
            <?php } ?>
            <?php foreach ($products as $product):?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-2">
                        Цена
                    </div>
                    <div class="col-xs-2">
                        Количество
                    </div>
                    <div class="col-xs-2">
                        Сумма
                    </div>
                    <div class="col-xs-2">

                    </div>
                </div>
<!--                --><?php //foreach ($products as $product):?>
                <div class="row">
                    <div class="col-xs-4">
                        <?= Html::encode($product->product) ?>
                    </div>
                    <div class="col-xs-2">
                        $<?= $product->price ?>
                    </div>
                    <div class="col-xs-2">
                        <?= $quantity = $product->getQuantity()?>

                        <?= Html::a('-', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-danger', 'disabled' => ($quantity - 1) < 1])?>
                        <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-success'])?>
                    </div>
                    <div class="col-xs-2">
                        $<?= $product->getCost() ?>
                    </div>
                    <div class="col-xs-2">
                        <?= Html::a('×', ['cart/remove', 'id' => $product->getId()], ['class' => 'btn btn-danger'])?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <div class="col-xs-2">
                        Обшая сумма: $<?= $total ?>
                    </div>
                    <div class="col-xs-2">
                        <?= Html::a('Купить', ['cart/order'], ['class' => 'btn btn-success'])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>