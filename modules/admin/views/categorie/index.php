<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая категория', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                        return empty($model->parent_id) ? '-' : $model->parent->categorie;
                    },
            ],
            'categorie',
            'slug',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {images} {delete}',
                'buttons' => [
                    'images' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon glyphicon-picture" aria-label="Image"></span>', Url::to(['image/index', 'id' => $model->id]));
                        }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
