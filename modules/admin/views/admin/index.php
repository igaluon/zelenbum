<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Categorie */

$this->title = 'Товары ';
$this->params['breadcrumbs'][] = $this->title;

\yii::$app->session->set('name', '');
\yii::$app->session->set('edit', '');

?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая категория', ['create-categorie'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Новый товар', ['product/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            [
//                'attribute' => 'categorie_id',
//                'format' => 'integer',
//                'label' => 'ID',
//            ],
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
                'label' => 'Категория',
                'value' => 'categorie.categorie',
                'format' =>'raw',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Categorie::find()->all(), 'categorie', 'categorie')
            ],
//            [
//
//                'attribute' => 'product',
//                'format' => 'text',
//                'label' => 'Название товара',
//            ],
            [
                'attribute' => 'product',
                'format' => 'raw',
                'value' => 'product',
                'label' => 'Название товара',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'product', 'product')
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
