
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
                                    <ul class="sf-menu sf-js-enabled">

                                        <li class="<?php echo ($model->category ==  \yii::$app->cache->get('name') || $actives == 'products?id=tree&name=Дерево' || $actives == 'products3' || $actives == 'products4') ? 'active' : ''; ?>"><a href="javascript:void(0);" class="sf-with-ul">Ассортимент<span class="sf-sub-indicator"> »</span></a>
                                            <ul style="display: none;">
                                                <li class="<?php echo $actives == $actives ? 'active' : ''; ?>"><?php echo yii\helpers\Html::a('Камень', yii\helpers\Url::to(['products', 'id' => 'rock', 'name' => 'Камень'])); ?></li>
                                                <li class="<?php echo $actives == 'products?id=tree&name=Дерево' ? 'active' : ''; ?>"><?php echo yii\helpers\Html::a('Дерево', yii\helpers\Url::to(['products', 'id' => 'tree', 'name' => 'Дерево'])); ?></li>
                                                <li class="<?php echo $actives == 'products3' ? 'active' : ''; ?>">
                                                    <?php echo yii\helpers\Html::a('Садовая мебель', yii\helpers\Url::to
                                                        (['products', 'id' => 'garden_furniture', 'name' => 'Садовая мебель'])); ?></li>
                                                <li class="<?php echo $actives == 'products4' ? 'active' : ''; ?>"><?php echo yii\helpers\Html::a('Ретро сувениры', yii\helpers\Url::to(['products', 'id' => 'retro_souvenirs', 'name' => 'Ретро сувениры'])); ?></li>
                                            </ul>
                                        </li>
                                        <!-- <li class="<?php echo $actives == 'services' ? 'active' : ''; ?>"><a href="services">Наши услуги</a></li> -->
<!--                                        <li class="--><?php //echo $actives ==  $name ? 'active' : ''; ?><!--">--><?php //echo yii\helpers\Html::a('Наши работы', yii\helpers\Url::to(['our-works'])); ?><!--</li>-->
                                        <li class="<?php echo $actives == 'contacts' ? 'active' : ''; ?>"><a href="contacts">Контакты</a></li>
                                        <li class="<?php echo $actives ==  \yii::$app->cache->get('name') ? 'active' : ''; ?>"><?php echo yii\helpers\Html::a('О нас', yii\helpers\Url::to(['/'])); ?></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="clear"></div>
                        </header><!-- end header -->
                    </div>
