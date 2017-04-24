
<?php

use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */


?>

<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

<div class="row">
    <?php
    echo "<h3>",  \yii\helpers\Html::label( ucfirst($name) ), "</h3>";

    echo \kartik\file\FileInput::widget([
        'name' => 'images',
        'options' => [
            'accept' => 'image/*',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['file-upload-images']),
            'deleteUrl' => \yii\helpers\Url::to(['file-upload-images']),
            'uploadExtraData' => [
                'name' => $name,
            ],
            'overwriteInitial' => false,
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'initialPreviewConfig' => ['width' => 20, 'heigth' => 120 ],
            'initialPreview' => $images,
            'showUpload' => true,
            'showRemove' => false,
            'dropZoneEnabled' => false
        ]
    ]);
    ?>

</div>


<?php \yii\bootstrap\ActiveForm::end(); ?>


