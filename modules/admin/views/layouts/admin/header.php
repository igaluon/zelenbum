<?php/* @var $content string */
use yii\helpers\Html;

/* @var $this \yii\web\View */

?>

<header class="main-header">

    <?= yii\helpers\Html::a('<span>Zelenbum</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li>
                    <?= yii\helpers\Html::a('Logout',yii\helpers\Url::toRoute('/admin/logout'))?>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
