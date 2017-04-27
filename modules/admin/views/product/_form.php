<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories app\models\Categorie[] */

$script = "
$('#product-images').change(function() {
  var input = $(this)[0];
  if ( input.files && input.files[0] ) {
      var reader = new FileReader();
      reader.onload = function(e) { $('#image_preview').attr('src', e.target.result); }
      reader.readAsDataURL(input.files[0]);
  } else console.log('not isset files data or files API not supordet');
});";
$this->registerJs($script, yii\web\View::POS_READY);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div> <img id="image_preview" src="<?='../../uploads/скачанные файлы.jpg' ?>" style="display: block; width: 200px; height: 300px;" alt=""/></div>
    <br>

    <?= $form->field($model, 'images')->fileInput() ?>

    <?= $form->field($model, 'categorie')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'categorie'), ['prompt' => 'Родительская']) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInputtextarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
