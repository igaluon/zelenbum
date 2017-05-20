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
<body id="page1">

<?php $this->beginBody() ?>

<script>

    $(function(){
        $('.flexslider').flexslider({
            animation: "fade",
            slideshow: true,
            slideshowSpeed: 7000,
            animationDuration: 600,
            prevText: "Previous",
            nextText: "Next",
            controlNav: true
        });

        $(window).load(function(){
            $('.heading-wrapper .heading-after').each(function() {
                var thiswidth = ($(this).parent().width() - $(this).prev().width()) -10;
                $(this).css({width:thiswidth})})
        });

    })
</script>

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
