<?php

use app\models\Category;

?>


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

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],

                'items' => [
                    ['label' => 'Все категории', 'icon' => 'fa fa-dashboard', 'url' => ['/admin']],

                    ['label' => 'Категории',

//                         'items' =>  Category::CategoryMenu()],
                         'items' =>  app\models\Categorie::menuItems()],

                    ['label' => 'SEO', 'icon' => 'fa fa-dashboard', 'url' => ['../admin/tag']],
                ],
            ]
        ) ?>

    </section>

</aside>
