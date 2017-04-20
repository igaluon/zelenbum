<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// Записываем в сессию $edit для перехода в текущую категорию, которая передается в экшен update
\yii::$app->session->set('edit', 'edit');
// Записываем в сессию название текущей категории $name, которая передается в экшен update
\yii::$app->session->set('name', $name);

$this->title = $name_rus;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-edit">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'action' => ['edit', ['name' => $name]],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                        return Html::img(\yii\helpers\Url::toRoute('../' .$data->image),[
                            'alt'=>'Картинка',
                            'style' => 'width:100px;'
                        ]);
                    },
            ],
            [

                'attribute' => 'product_name',
                'format' => 'text',
                'label' => 'Название товара',
            ],
            [

                'attribute' => 'description',
                'format' => 'text',
                'label' => 'Описание',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
