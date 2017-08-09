<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Categorie;

/* @var $this yii\web\View */
/* @var $model app\models\Categorie */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories app\models\Categorie[] */

?>

<div class="categorie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categorie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'categorie'), ['prompt' => 'Root']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
