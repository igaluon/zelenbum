<?php
use yii\helpers\Html;
use app\assets\AppAsset;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <?php
    if (is_null(Yii::$app->seo->block('title'))) {
        echo '<title>' . Html::encode($this->title) . '</title>';
    } else {
        echo '<title>' . Html::encode(\aquy\seo\module\Meta::t('app', Yii::$app->seo->block('title'))) . '</title>';
//        echo '<title>' . Html::encode(Yii::$app->seo->block('title')) . '</title>';
    }
    ?>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <script src="js/jquery.hoverIntent.minified.js"></script>
    <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
</head>
<body>

<?php $this->beginBody() ?>


<!-- Header Starts -->
<?php echo $this->render("//common/head"); ?>
<!-- #Header Starts -->

<?= $content ?>

<!-- Footer Starts -->
<?php echo $this->render("//common/footer"); ?>
<!-- #Footer Starts -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
