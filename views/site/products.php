

                            <div class="clear"></div>
                        </header><!-- end header -->
                    </div>
                    </div>
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
                        <h2 class="indent-bot-4"><?=$name?></h2>
                        <p class="indent-bot-3">AENEAN NONUMMY HENDRERIT MAURIS. PHASELLUS PORTA. FUSCE SUSCIPIT VARIUS MI. CUM SOCIIS NATOQUE PENATIBUS ET MAGNIS DIS PARTURIENT MONTES, NASCETUR RIDICULUS MUS. NULLA DUI. FUSCE FEUGIAT MALESUADA ODIO. MORBI NUNC ODIO, GRAVIDA AT, CURSUS NEC, LUCTUS A, LOREM. MAECENAS TRISTIQUE ORCI AC SEM.</p>
                    </div>
                </div>
                <div class="wrapper">
                  <div id="show-image">
                    <?php foreach($model as $value) {?>
                    <div class="grid_3 indent-bot-5 rt-grid-1">
                        <img class="indent-bot-3 rt-img-1 {width:100%;}" src="<?=Yii::$app->request->baseUrl .'/' .$value->image?>" alt="">
                        <p><a class="link-1" href="#"><?=$value->image?></a></p>
                        <p>Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                    </div>
                    <?php } ?>
                  </div>

            </section><!-- end content -->
