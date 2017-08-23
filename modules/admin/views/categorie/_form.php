<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Categorie;

/* @var $this yii\web\View */
/* @var $model app\models\Categorie */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories app\models\Categorie[] */
$categories = Categorie::find()->indexBy('id')->orderBy('id')->all();

?>

<div class="categorie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categorie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'categorie'), ['prompt' => 'Root']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
