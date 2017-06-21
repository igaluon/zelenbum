

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

            </div>
        </div>

       <!--  search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
       <!--  /.search  -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],

                'items' => [
                    ['label' => 'Товары', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/product']],
                    ['label' => 'Категории', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/categorie']],

//                    ['label' => 'Категории',

//                         'items' =>  Category::CategoryMenu()],
//                         'items' =>  app\models\Categorie::menuAdminItems()],

                    ['label' => 'Заказы', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/order']],
                    ['label' => 'SEO', 'icon' => 'fa fa-dashboard', 'url' => '',
                        'items' =>  [
                            ['label' => 'О нас', 'icon' => 'fa fa-dashboard', 'url' => ['/seo/tag', 'id' => 10]],
                            ['label' => 'Ассортимент', 'icon' => 'fa fa-dashboard', 'url' => '',
                                'items' =>  app\models\Categorie::menuAdminItems()],
                            ['label' => 'Наши работы', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/product']],
                            ['label' => 'Контакты', 'icon' => 'fa fa-dashboard', 'url' => ['/admin/product']],
                            ],
                    ],
                ],
                'activeCssClass' => 'active',
                'activateParents' => true,
            ]
        ) ?>

    </section>

</aside>
