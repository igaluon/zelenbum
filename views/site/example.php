<?php
use yii\widgets\Menu;
?>
            <div class="bg-head">
                <div class="glow">
                    <div class="top-shadow">
                        <div class="container_12">
                            <div>
                                <?php $actives = 'about';?>
                                <div class="grid_12">
                                    <!-- header -->
                                    <header>
                                        <h1><a href="/">Зеленбум - Все для красивой усадьбы</a></h1>
                                        <div class="menu-search">
                                            <!-- menu -->
                                            <nav>
                                                <?php echo yii\widgets\Menu::widget([
                                                    'items' => [
                                                        ['label' => 'О нас', 'url' => ['site/index']],
                                                        ['label' => 'Ассортимент',
                                                            'options'=>['class'=>'dropdown'],
                                                            'url' => ['javascript:void(0)'],
                                                            'options'=>['class'=>'dropdown'],
                                                            'params' => 'true',
                                                            // 'template' => '<a href="{url}" class="url-class">{label}</a>',
                                                            'items' => [
                                                                ['label' => 'Дерево', 'url' => ['site/products', 'id' => 'tree', 'name' => 'Дерево']],
                                                                ['label' => 'Камень', 'url' => ['site/products', 'id' => 'rock', 'name' => 'Камень']],
                                                                ['label' => 'Садовая мебель', 'url' => ['site/products', 'id' => 'garden_furnitur', 'name' => 'Садовая мебель']],
                                                                ['label' => 'Ретро сувениры', 'url' => ['site/products', 'id' => 'retro_souvenirs', 'name' => 'Ретро сувениры']],
                                                            ],
                                                        ],
                                                        ['label' => 'Наши работы', 'url' => ['site/our-works']],
                                                        ['label' => 'Контакты', 'url' => ['site/contacts']],
                                                    ],
                                                    'options' => [
                                                        'class' => 'sf-menu sf-js-enabled','data'=>'menu',
                                                    ],
                                                    //  'itemOptions'=>['class' =>  $active == $active ? 'active' : ''],
                                                    'activeCssClass' => 'active',
                                                    'submenuTemplate' => "\n<ul class='dropdown-menu' role='menu'>\n{items}\n</ul>\n",
                                                ]); ?>
                                            </nav>
                                        </div>
                                        <div class="clear"></div>
                                    </header><!-- end header -->
                                </div>
            <div class="clear"></div>
                </div>
                     </div>
                        </div>
                             </div>
                                 </div>
                                    </div>
            <div class="container_12">
                <div>
                    <div class="grid_12">
            <!-- content -->
            <section id="content">
                <div class="wrapper">
                    <div class="grid_10 alpha">
                        <h2 class="indent-bot-4"><?=$name?></h2>
                        <p class="indent-bot-3">AENEAN NONUMMY HENDRERIT MAURIS. PHASELLUS PORTA. FUSCE SUSCIPIT VARIUS MI. CUM SOCIIS NATOQUE PENATIBUS ET MAGNIS DIS PARTURIENT MONTES, NASCETUR RIDICULUS MUS. NULLA DUI. FUSCE FEUGIAT MALESUADA ODIO. MORBI NUNC ODIO, GRAVIDA AT, CURSUS NEC, LUCTUS A, LOREM. MAECENAS TRISTIQUE ORCI AC SEM.</p>
                    </div>
                </div>
                <div class="wrapper">
                    <div id="show-image">
                        <?php foreach($model as $value) {?>
                            <div class="grid_3 indent-bot-5 rt-grid-1">
                                <img class="indent-bot-3 rt-img-1 {width:100%;}" src="<?='../' .$value->image?>" alt="">
                                <p><a class="link-1" href="#"><?=$value->image?></a></p>
                                <p>Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                            </div>
                        <?php } ?>
                    </div>

            </section><!-- end content -->
            <footer>
                <ul class="list-soc">
                    <li><a href="#"><img src="../images/soc-icon-1.jpg" alt=""></a></li>
                    <li><a href="#"><img src="../images/soc-icon-2.jpg" alt=""></a></li>
                    <li><a href="#"><img src="../images/soc-icon-3.jpg" alt=""></a></li>
                    <li><a href="#"><img src="../images/soc-icon-4.jpg" alt=""></a></li>
                </ul>
                <div class="policy">Зеленбум © 2016 <br class="br-h"> Все права защищены
                    <div class="powered-by">Powered by <a href="http://igorsharay.com" target="_blank">Igor Sharay</a></div>
                </div>
                <div class="clear"></div>
            </footer><!-- end footer -->