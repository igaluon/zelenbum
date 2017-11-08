<?php

use yii\helpers\Html;
use yii\helpers\Markdown;

$lang = Yii::$app->request->get('lang');
?>


                            <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container_12">
    <div>
        <div class="grid_12">
            <!-- content -->
            <section id="content">
                <div class="wrapper">
                    <div class="grid_10 alpha">
                        <h2 class="indent-bot-4"><?=yii\helpers\Html::encode(\Yii::t('app', $categorie->categorie))?></h2>
                        <p class="indent-bot-3"><?=\Yii::t('app', $categorie->description)?></p>
                    </div>
                  <div id="show-image">
                    <?php foreach($product as $value) {?>
                    <div class="grid_3 indent-bot-5 rt-grid-1">
                        <?=Html::img(Yii::$app->request->baseUrl .'/' .$value->image, ['class', "indent-bot-3 rt-img-1 {width:100%;}"])?>
                        <p><a class="link-1" href="#"><?=yii\helpers\Html::encode(\Yii::t('app', $value->product))?></a></p>
                        <p><?=Markdown::process(\Yii::t('app', $value->description))?></p>
                        <p><?=Html::encode(\Yii::t('app', 'Цена : '))?><?=$lang == 'en' ? '$'.round($value->price/26) : $value->price. 'грн'?></p>
                        <?= Html::a(\Yii::t('app', 'Добавить в корзину'), ['cart/add', 'id' => $value->id], ['class' => 'korzina'])?>
                    </div>
                    <?php } ?>
                  </div>
                </div>

            </section><!-- end content -->
