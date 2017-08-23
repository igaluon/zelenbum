<?php

use yii\helpers\Html;
use yii\helpers\Markdown;

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
                        <h2 class="indent-bot-4"><?=yii\helpers\Html::encode($name)?></h2>
                        <?php foreach($product as $value) {?>
                        <p class="indent-bot-3"><?=\Yii::t('app', 'Цена : ')?></p>
                    </div>
                  <div id="show-image">

                    <div class="grid_3 indent-bot-5 rt-grid-1">
                        <?=Html::img(Yii::$app->request->baseUrl .'/' .$value->image, ['class', "indent-bot-3 rt-img-1 {width:100%;}"])?>
                        <p><a class="link-1" href="#"><?=yii\helpers\Html::encode($value->product)?></a></p>
                        <p><?=Markdown::process($value->description)?></p>
                        <p><?=Html::encode(\Yii::t('app', 'Цена : ') .$value->price .'грн')?></p>
                        <?= Html::a(\Yii::t('app', 'Добавить в корзину'), ['cart/add', 'id' => $value->id], ['class' => 'korzina'])?>
                    </div>
                    <?php } ?>
                  </div>
                </div>

            </section><!-- end content -->
