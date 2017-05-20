<?php
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */
?>
<div class="grid_12">
    <!-- header -->
    <header>


        <div class="menu-search">
            <!-- menu -->
            <nav>
                <?php $itemsInCart = Yii::$app->cart->getCount(); ?>
                <?php echo yii\widgets\Menu::widget([
                    'items' =>   [
                        ['label' => 'О нас', 'url' => ['site/index']],
                        ['label' => 'Ассортимент',
                            'options'=>['class'=>'dropdown'],
                            'items' =>  app\models\Categorie::menuItems(),
                        ],
                        ['label' => 'Наши работы', 'url' => ['site/our-works']],
                        ['label' => 'Контакты', 'url' => ['site/contacts']],
                        ['label' => 'Корзина' . ($itemsInCart ? " ($itemsInCart)" : ''), 'url' => ['/cart/list']],

                    ],
                    'options' => [
                        'class' => 'sf-menu sf-js-enabled','data'=>'menu',
                    ],
                    'activeCssClass' => 'active',
                    'activateParents' => true,
                    'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",
                ]); ?>
            </nav>
        </div>
        <div class="clear"></div>
    </header><!-- end header -->
</div>

<div class="cart">
    <h1>Ваша корзина</h1>

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
                Обшая сумма: $<?= $total ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?php
                /* @var $form ActiveForm */
                $form = ActiveForm::begin([
                    'id' => 'order-form',
                ]) ?>

                <?= $form->field($order, 'phone') ?>
                <?= $form->field($order, 'email') ?>
                <?= $form->field($order, 'notes')->textarea() ?>

                <div class="form-group row">
                    <div class="col-xs-12">
                        <?= Html::submitButton('Order', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>