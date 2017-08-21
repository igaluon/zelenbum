    <?php $lang = Yii::$app->request->get('lang'); ?>.
    <?php $itemsInCart = Yii::$app->cart->getCount(); ?>
    <?php echo yii\widgets\Menu::widget([
        'items' =>   [
            ['label' => \app\widgets\menu\Menus::t('menu', 'О нас'), 'url' => ['site/index']],
            ['label' => \app\widgets\menu\Menus::t('menu', 'Ассортимент'),
                'options'=> ['class'=>'dropdown'],
                'items' =>  app\models\Categorie::menuItems(),
            ],
            ['label' => \app\widgets\menu\Menus::t('menu', 'Наши работы'), 'url' => ['site/our-works']],
            ['label' => \app\widgets\menu\Menus::t('menu', 'Контакты'), 'url' => ['site/contacts']],
            ['label' => \app\widgets\menu\Menus::t('menu', 'Корзина' ). ($itemsInCart ? " ($itemsInCart)" : ''), 'url' => ['/cart/list']],

        ],
        'options' => [
            'class' => 'sf-menu sf-js-enabled','data'=>'menu',
        ],
        'activeCssClass' => 'active',
        'activateParents' => true,
        'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",
    ]); ?>
