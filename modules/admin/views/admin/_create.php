<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categorie */
/* @var $categories app\models\Categorie[] */


$this->title = 'Создание категории';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form-create', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
