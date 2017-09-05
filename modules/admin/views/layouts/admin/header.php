<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $content string */
/* @var $this \yii\web\View */

//$lang = Yii::$app->request->get('lang');

?>

<header class="main-header">

    <?= Html::a('<span>Zelenbum</span>', Url::to(\Yii::$app->request->hostInfo) .'/ru', ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li>
                    <?= Html::a('Logout',Url::toRoute('/admin/logout'))?>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
