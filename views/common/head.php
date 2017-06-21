<div class="bg-head">
    <div class="glow">
        <div class="top-shadow">
            <div class="container_12">
                <div>
                    <div class="grid_12">
                        <!-- header -->
                        <header>
                            <h1 class="logo">
                                <a href="/">
                                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/logo.png" width="150px" height="65px" alt="Зеленбум - Все для красивой усадьбы" />
                                </a>
                            </h1>
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