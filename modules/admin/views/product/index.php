<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

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
                'attribute' => 'categorie_id',
                'label' => 'Категория',
                'value' => function ($model) {
                        return $model->categorie->categorie;
                    },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Categorie::find()->all(), 'id', 'categorie')

            ],
            [
                'attribute' => 'product',
                'format' => 'raw',
                'value' => 'product',
                'label' => 'Название товара',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'product', 'product')
            ],
            [
                'attribute' => 'price',
                'format' => 'raw',
                'value' => 'price',
                'label' => 'Цена',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'price', 'price')
            ],
            'description:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
