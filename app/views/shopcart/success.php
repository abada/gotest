<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use\yii\easyii\modules\shopcart\models\Order ;

$page = Page::get('page-shopcart-success');
$successCode=Page::get('successcode');
echo $successCode->text;


$pay=Page::get('paydetails');


$this->title = 'Thank you ';
$this->params['breadcrumbs'][] = $page->model->title;

?>

    <div class="content">
    <div class="container">
    
    <!--<?= Yii::t('easyii','order online');?>-->
    <h2 class="title"><?= $page->title ;?></h2>
	<div class="sub-title col-md-12">
    	<p style="text-align: center;"><?= $page->text ?></p>
    </div>
    <div class="clearfix"></div>
    <div class="row">

        <?php

if(Yii::$app->session->getFlash('order_id')) {
        $sql = 'SELECT country FROM easyii_shopcart_orders where order_id='. Yii::$app->session->getFlash('order_id');
        $order = Order::findBySql($sql)->one();
        if($order->country != 'EGY'){
            ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= $pay->title?></div>
                <div class="panel-body">
                    <?= $pay->text ?>
                </div>
            </div>
        <?

        }
        }

        ?>


<div class="title like-title"><?= Yii::t('easyii','you may like also');?> </div>
        <div class="col-md-12">
            <div id="owl-example" class="owl-carousel">

                <?php if(count($products)){
                    foreach ($products as $product){
                        ?>
                        <div  class="item">
                            <?= Html::img($product->thumb(125, 169),['class'=>'center-block img-responsive']) ?>

                            <a href="/products/view-online?slug=<?=$product->slug   ?>" >
                            <button class="btn dry-btn"><?= Yii::t('easyii','view more')?>
<!--                                <img src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/view-arrow.jpg"/>-->
                            </button>
                                </a>
                        </div>

                    <?

                    }
                }
                  ?>



            </div>
        </div>
        
         
       


    </div>
    </div>
    </div>
