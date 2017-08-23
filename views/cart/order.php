<?php
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */
/* @var $order app\models\Order */
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
    <h1><?=\Yii::t('app', 'Ваша корзина : ')?></h1>

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
        </div>
        <?php foreach ($products as $product):?>
        <div class="row">
            <div class="col-xs-4">
                <?= Html::encode($product->product) ?>
            </div>
            <div class="col-xs-2">
                $<?= $product->price ?>
            </div>
            <div class="col-xs-2">
                <?= $quantity = $product->getQuantity()?>
            </div>
            <div class="col-xs-2">
                $<?= $product->getCost() ?>
            </div>
        </div>
        <?php endforeach ?>
        <div class="row">
            <div class="col-xs-8">

            </div>
            <div class="col-xs-2">
                <?=\Yii::t('app', 'Обшая сумма: ')?><?= $total ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?php
                /* @var $form ActiveForm */
                $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                ]) ?>

                <?= $form->field($order, 'phone') ?>
                <?= $form->field($order, 'email') ?>
                <?= $form->field($order, 'notes')->textarea() ?>

                <div class="form-group row">
                    <div class="col-xs-12">
                        <?= Html::submitButton(\Yii::t('app', 'Купить'), ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>