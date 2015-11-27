<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "2222d12e-5607-475a-b5d7-2ba1c0a2c5c0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php
use app\models\AddToCartForm;
use yii\easyii\modules\catalog\api\Catalog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;
use  \app\models\Products;

$this->title = $item->seo('title', $item->model->title);
$totalreviews=  Products::reviews($item->id,1);
?>
<div class="content single-product">
    <div class="container-fluid bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="bxslider">

                        <?php foreach($item->photos as $photo) : ?>
                            <?//= $photo->box(110, 100) ?>
                          <li><img src="<?= $photo->image?>" width="370" height="300" class="center-block"></li>

                        <?php endforeach;?>


                    </ul>
                    <div id="bx-pager" class="text-center">
                        <?php
                        $i=0;
                        foreach($item->photos as $photo) : ?>
                           <?//= $photo->box(110, 100) ?>
                           <a data-slide-index="<?= $i?>" href=""><img src="<?= $photo->image?>" width="50" height="50"></a>
                        <?php
                        $i++;
                        endforeach;?>
                    </div>
                    <p class="product-star">
                        <?php
                        for($i=0; $i<$totalreviews;$i++){
                            ?>
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/product-stars.png" class="star-img">

                        <?
                        }
                        ?>
                        <?php echo Products::reviews($item->id);?>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="title"><?= $item->title ;?></div>
                    <a href="/stores">  <button class="btn dry-btn"> <i class="fa fa-map-marker fa-lg"></i> <?= Yii::t('easyii','where to find it')?> </button></a>
                    <a href="/offers"><button class="btn dry-btn margin-left10"><i class="fa fa-leaf fa-lg"></i> <?= Yii::t('easyii','get the offer')?></button></a>

                    <p class="margin-top20"><?= $item->description ;?></p>
                    <ul class="product-details margin-top30">
                        <li><?= Yii::t('easyii','Share'); ?>
                            <span class='st_facebook_large' displayText=''></span>
                            <span class='st_twitter_large' displayText=''></span>
                            <span class='st_googleplus_large' displayText=''></span>
                            <span class='st_instagram_large' displayText=''></span>
                            <span class='st_sharethis_large' displayText=''></span>
                            <span class='st__large' displayText=''></span>
                       </li>
                    </ul>
                </div>
            </div>
            <div class="row pink-border">
                <div class="col-md-4 feature">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/absorb-loc.png"/>
                    <?php $page = Page::get('ppagesec1')?>
                    <?= $page->text ;?>
                </div>
                <div class="col-md-4 feature">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/dry-touch.png"/>
                    <?php $page = Page::get('ppagesec2')?>
                    <?= $page->text ;?>
                </div>
                <div class="col-md-4 feature">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/thin-flex.png"/>
                    <?php $page = Page::get('ppagesec3')?>
                    <?= $page->text ;?>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row margin-top30">
            <div class="col-sm-4">
                <div class="embed-responsive embed-responsive-4by3">
                    <?php $page = Page::get('productpage')?>
                    <?= $page->text ;?>
                </div>
            </div>
            <div class="col-sm-8">
                <?php $page= Page::get('rightchoice');?>
                <div class="title"> <?= $page->title?> </div>
                <p><?= $page->text  ?></p>
            </div>
        </div>
    </div>


    <div class="container-fluid review-bg">
        <div class="title"> <?= $totalreviews.' '.Yii::t('easyii','reviews')?> </div>
        <p class="product-star text-center">

            <?php
            for($i=0; $i<$totalreviews;$i++){
                ?>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/product-stars.png" class="star-img">

            <?
            }
            ?>

        <?php echo Products::reviews($item->id);?>
        </p>
        <button class="btn dry-btn center-block"><i class="fa fa-pencil fa-lg"></i> Write a review</button>
    </div>
    <div class="container margin-top20">
        <div class="row">
            <div class="col-sm-8">




                <?php

                foreach ($reviews as $review){

                    ?>
                    <div class="review">
                        <p class="text-uppercase">
                            <?= $review->getOwner() ;?>
                            <span class="margin-left10"><i class="fa fa-calendar"></i>
                            <?= $review->date?>
                            </span></p>
                        <p class="product-star">
                            <?php
                            for($i=0;$i<$review->no_of_review;$i++){
                                ?>
                                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/product-stars.png" class="star-img">
                                <?

                            }
                            ?>

                        </p>
                        <h3><?= $review->title?></h3>
                        <p><?= $review->text?></p>
                        <h4><i class="fa fa-thumbs-up fa-lg"></i> Yes, I recommend this product.</h4>
                        <ul class="product-details">
                           <li>Share
                                <?php $reviewUrl=Url::to(['product/review'], true).'/?slug='.$item->slug .'&review='.$review->slug;?>
                               <span class='st_facebook_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>" ></span>
                               <span class='st_twitter_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>"></span>
                               <span class='st_googleplus_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>"></span>
                               <span class='st_instagram_large' displayText='' st_url="<?= $reviewUrl ;?>   " st_title="<?= $review->title?>"></span>


                           </li>
                        </ul>                    </div>
                    <hr>

                <?

                }
                ?>

                <?= \app\modules\reviews\api\News::pages() ?>

<!--                <a class="readMore">read more</a>-->
            </div>
            <div class="col-sm-4">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/banner-1.jpg" class="img-responsive center-block"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/theme/images/banner-2.jpg" class="margin-top10 img-responsive center-block"/>
            </div>
        </div></div>

    </div>
