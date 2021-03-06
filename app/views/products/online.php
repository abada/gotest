<?php  $this->title =yii::t('easyii','Online Dry Products');
$this->params['meta_keyword'] = yii::t('easyii','meta 2');
$this->params['meta_description'] = yii::t('easyii','meta 81');

 ?>



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 gray-color postpartum">
                <div class="title"> <?= yii::t('easyii','postpartum pads')?></div>



                 <ul class="col-md-12 col-centered product">

                     <?php if(count($Postpartum)) : ?>
                         <?php foreach($Postpartum as $item) : ?>

                             <?php
                           // if(!isset($item->data->maxipads) or $item->data->maxipads==0  ){
                             echo $this->render('_itemonline', ['item' => $item]) ;
                             //}
                             ?>
                         <?php endforeach; ?>
                     <?php else : ?>
                         <p><?= Yii::t('easyii', 'No products Found');?>  </p>
                     <?php endif; ?>


                </ul>
            </div>


            <div class="col-lg-12 maxi">
                <h2 class="title"><?= yii::t('easyii','maxi pads')?></h2>
                <ul class="col-md-12 col-centered product">

                    <?php if(count($PeriodPads)) : ?>
                        <?php foreach($PeriodPads as $item) : ?>

                            <?php
                            if($item->data->maxipads==1){
                                echo $this->render('_itemonline', ['item' => $item]) ;
                            }
                            ?>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <p><?= Yii::t('easyii', 'No products Found');?>  </p>
                    <?php endif; ?>

                    </ul>
            </div>


            <div class="col-lg-12 ultra">
                <h2 class="title"><?= yii::t('easyii','Ultra pads')?></h2>
                <ul class="col-md-12 col-centered product">

                    <?php if(count($PeriodPads)) : ?>
                        <?php foreach($PeriodPads as $item) :

                            if(!isset($item->data->maxipads) or $item->data->maxipads==0  ) {

                               echo  $this->render('_itemonline', ['item' => $item]);
                            }

                        endforeach; ?>
                    <?php else : ?>
                        <p><?= Yii::t('easyii', 'No products Found');?>  </p>
                    <?php endif; ?>


                </ul>
            </div>
            <div class="col-lg-12 daily">
                <h2 class="title"><?= yii::t('easyii','daily pantilinears')?></h2>
                <ul class="col-md-12 col-centered product">
                    <?php if(count($DailyPantilinears)) : ?>
                        <?php foreach($DailyPantilinears as $item) : ?>
                            <?= $this->render('_itemonline', ['item' => $item]) ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p><?= Yii::t('easyii', 'No products Found');?>  </p>
                    <?php endif; ?>



                </ul>
            </div>
            <div class="col-lg-12 generation">
                <h2 class="title"><?= yii::t('easyii','new generation')?></h2>
                <ul class="col-md-12 col-centered product">
                    <?php if(count($NewGeneration)) : ?>
                        <?php foreach($NewGeneration as $item) : ?>
                            <?= $this->render('_itemonline', ['item' => $item]) ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p><?= Yii::t('easyii', 'No products Found');?>  </p>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>
</div>