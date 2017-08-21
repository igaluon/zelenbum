<?php

use app\widgets\menu\Menus;

?>
<div class="bg-head">
    <div class="glow">
        <div class="top-shadow">
            <div class="container_12">
                <div>
                    <div class="grid_12">
                        <!-- header -->
                        <header>
                            <h1 class="logo">
                                <a href="<?php echo Yii::$app->homeUrl; ?>">
                                    <img src="<?php echo Yii::$app->getRequest()->getBaseUrl(true); ?>/images/logo.png" width="150px" height="65px" alt="Зеленбум - Все для красивой усадьбы" />
                                </a>
                            </h1>
                            <div class="menu-search">
                                <!-- menu -->
                                <nav>

                                    <?= Menus::widget();?>

                                </nav>

                            </div>
<div class="clear"></div>
</header><!-- end header -->
</div>