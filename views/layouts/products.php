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
    <link rel="shortcut icon" href="/web/favicon.ico" type="image/x-icon"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <script src="js/jquery.hoverIntent.minified.js"></script>
    <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
</head>
<body id="page2">

<?php $this->beginBody() ?>


<!-- Header Starts -->
<?php echo $this->render("//common/head") ?>
<!-- #Header Starts -->

<?= $content ?>

<!-- Footer Starts -->
<?php echo $this->render("//common/footer"); ?>
<!-- #Footer Starts -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
