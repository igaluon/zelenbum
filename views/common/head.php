<div class="bg-head">
    <div class="glow">
        <div class="top-shadow">
            <div class="container_12">
                <div>
                    <div class="grid_12">
                        <!-- header -->
                        <header>
                            <h1><a href="/">Зеленбум - Все для красивой усадьбы</a></h1>
                            <div class="menu-search">
                                <!-- menu -->
                                <nav>
                                    <?php echo yii\widgets\Menu::widget([
                                         'items' =>   [
                                            ['label' => 'О нас', 'url' => ['site/index']],
                                            ['label' => 'Ассортимент',
                                                'options'=>['class'=>'dropdown'],
                                                'items' =>  app\models\Categorie::menuItems(),
                                            ],
                                            ['label' => 'Наши работы', 'url' => ['site/our-works']],
                                            ['label' => 'Контакты', 'url' => ['site/contacts']],
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