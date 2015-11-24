<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use yii\helpers\Url;
use  \yii\easyii\models\Setting;




$page = Page::get('page-shopcart');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
$delivery= Setting::get('deliver_cost');
?>





    <div class="content">
        <div class="container">
            <h2 class="title"><?= Yii::t('easyii','order online');?></h2>
            <div class="sub-title"><?= Yii::t('easyii','Choose from any of the special offers below to enjoy valuable savings on Poise&reg; protection.');?></div>
            <div class="row">

                <?php if(count($goods)) : ?>
                <div class="col-md-6 order-online">
                      <?php
                      if($error){
                          $data =explode('.',$error);
                            foreach ($data as $error){
                                echo $error."<br/>";

                            }
                      }
                      ?>

                    <?= Shopcart::form(['successUrl' => Url::to('/shopcart/success') ],$model)?>


                </div>




                <div class="col-md-5 col-md-offset-1">
                    <div class="your-order">
                        <h2 class="title"><?= Yii::t('easyii','Check Out')?> </h2>
                        <hr>
                  <?php foreach($goods as $good) :
                      ?>
                        <div class="order">
                            <div class="media">
                                <div class="media-left">
                                   <img src="<?= $good->item->image?>" width="30px" height="30px">

                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?= $good->item->title ?></h3>
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label for="exampleInputName2"><?= Yii::t('easyii','Quantity')?></label>
                                            <?= Html::textInput("Good[$good->id]", $good->count, ['class' => 'form-control']) ?>
                                        </div>
                                    </form>
                                    <p>   <span><?= Html::a('<i class="glyphicon glyphicon-trash "></i>', ['/shopcart/remove', 'id' => $good->id], ['title' => 'Remove item']) ?></span>

                                        <?= Yii::t('easyii','Price')?><span class="pull-right">$<?= $good->price * $good->count ?></span>
                                    </p>
                                </div>
                            </div>

                        </div>

                  <?php endforeach; ?>



                    </div>
                    <div class="price">
                        <p><?= Yii::t('easyii','total price')?> <span class="pull-right"> $<?= Shopcart::cost() ?></span></p>
                        <p> <?= Yii::t('easyii','delivery price')?> <span class="pull-right">$<?= $delivery ;?></span></p>
                        <p> <?= Yii::t('easyii','final total Price')?> <span class="pull-right">$<?= Shopcart::cost()+$delivery ?> </span></p>
                    </div>
                </div>

                <?php else : ?>
                <div class="col-md-6 order-online">
                    <br/><br/><br/><br/>
                    <p><?= Yii::t('easyii','Shopping cart is empty');?></p>
                    <br/><br/><br/>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </div>

