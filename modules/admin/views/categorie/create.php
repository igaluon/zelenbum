<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categorie */
/* @var $categories app\models\Categorie[] */


$this->title = 'Новая категория';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
