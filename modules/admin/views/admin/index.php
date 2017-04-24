<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все продукты';
$this->params['breadcrumbs'][] = $this->title;

\yii::$app->session->set('name', '');
\yii::$app->session->set('edit', '');

?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'integer',
                'label' => 'ID',
            ],
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
                'attribute' => 'categorie',
                'format' => 'text',
                'label' => 'Категория',
                'value' => 'categorie.categorie',
            ],
//            [
//                'label' => 'Категория',
//                'format' => 'text',
//                'value' => function($data){
//                       return \app\models\Categorie::getCategor($data->categorie_id);
//                       },
//            ],
            [

                'attribute' => 'product',
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
