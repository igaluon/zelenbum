 <?php

 use yii\widgets\ActiveForm;

 /* @var $model app\models\ContactForm */
 /* @var $form yii\widgets\ActiveForm */
 /* @var $this yii\web\View */

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
                    <div class="grid_5 alpha rt-indent-bottom-1">
                        <div class="rt-block-indent-2">
                            <h2 class="indent-bot-2"><?=\Yii::t('app', 'Наши координаты')?></h2>
                            <div>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2682.2832720240363!2d35.21531931553473!3d47.75655958560002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDfCsDQ1JzIzLjYiTiAzNcKwMTMnMDMuMCJF!5e0!3m2!1sen!2sua!4v1460486353684" width="360" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                            <div>
                                <dl class="adress">
                                    <dt><?=\Yii::t('app', 'Украина, Запорожье')?><br>
                                        <?=\Yii::t('app', 'Выезд из Запорожья, п. Балабино.')?></dt>
                                    <dd><span>(067) 700 06 :</span><?=\Yii::t('app', 'Телефон:')?></dd>
                                    <dd><span>(066) 656 77</span><?=\Yii::t('app', 'Телефон:')?></dd>
                                    <dd>E-mail: <a class="link-1" href="#">zelenbum@ukr.net</a></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="grid_7 omega">
                        <h2 class="indent-bot-2"><?=\Yii::t('app', 'Напишите нам')?></h2>
                        <!-- contact form -->
                        <div id="confirm">
                            <?php $form = ActiveForm::begin(['id' => 'form1',
                                'fieldConfig' => ['template' => "{input}\n{hint}\n{error}"]

                            ]); ?>

                            <div class="success" style="display: none;">Данные отправлены. Мы свяжемся с Вами в ближайшее время</div>

                            <?= $form->field($model, 'name')->textInput(['placeholder' => \Yii::t('app', 'имя')])->label('') ?>

                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'email'])->label('')?>

                            <?= $form->field($model, 'phone')->textInput(['placeholder' => \Yii::t('app', 'телефон')])->label('')?>

                            <?= $form->field($model, 'body')->textarea(['placeholder' => \Yii::t('app', 'сообщение')])->label('') ?>

                            <div class="btns">
                                <?= \yii\helpers\Html::submitButton(\Yii::t('app', 'Отправить'), ['class' => 'button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
<!--
                        </div><!-- end contact form -->
                    </div>
                </div>
            </section><!-- end content -->