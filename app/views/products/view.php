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
                          <li><img src="<?= $photo->image?>" width="300" height="300" class="center-block"></li>

                        <?php endforeach;?>


                    </ul>
                    <div id="bx-pager" class="text-center">
                        <?php
                        $i=0;
                        foreach($item->photos as $photo) : ?>
                           <?//= $photo->box(110, 100) ?>
                           <a data-slide-index="<?= $i?>" href="">
                               <img src="<?= $photo->image?>" width="50" height="50">

                           </a>
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
                            <span class='st_sharethis_large' displayText=''></span>
                            <span class='st__large' displayText=''></span>
                       </li>
                    </ul>
                </div>
            </div>
            <div class="row pink-border">
                <div class="col-md-4 feature">

<!--                    <img src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/absorb-loc.png"/> -->
                    <img src="<?php echo(Yii::$app->language =='en') ? $item->slider_img_1 : $item->slider_img_1_ar ;?>"">
                    <?php echo $item->slider_text_1 ;?>

                </div>
                <div class="col-md-4 feature">
<!--                    <img src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/dry-touch.png"/> -->
                    <img src="<?php echo(Yii::$app->language =='en') ? $item->slider_img_2 : $item->slider_img_2_ar ;?>"">

                    <?php echo $item->slider_text_2 ;?>

                </div>
                <div class="col-md-4 feature">
<!--                    <img src=" --> <?php //echo Yii::$app->getUrlManager()->getBaseUrl()?>
                    <!-- /theme/images/thin-flex.png"/>   -->
                    <img src="<?php echo(Yii::$app->language =='en') ? $item->slider_img_3 : $item->slider_img_3_ar ;?>"">

                    <?php echo $item->slider_text_3 ;?>


                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row margin-top30">
            <div class="col-sm-4">
                <div class="embed-responsive embed-responsive-4by3" data-toggle="modal" data-target="#youtube">
                    <img src="http://img.youtube.com/vi/<?php echo $item->video?>/0.jpg" height="300" wid>
                </div>
            </div>
            <div class="col-sm-8">
               <?php echo $item->video_text?>

            </div>
        </div>
    </div>


    <div class="container-fluid review-bg">
        <div class="title"> <?= Products::reviews($item->id,2).' '.Yii::t('easyii','reviews')?> </div>
        <p class="product-star text-center">

            <?php
            for($i=0; $i<$totalreviews;$i++){
                ?>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/product-stars.png" class="star-img">

            <?
            }
            ?>

        <?php


            echo Products::reviews($item->id);?>
        </p>
        <button class="btn dry-btn center-block" data-toggle="modal" data-target="#writeReview"><i class="fa fa-pencil fa-lg"></i> Write a review</button>
        <!-- Modal -->

<div class="modal fade" id="writeReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Your Review <i class="fa fa-pencil fa-lg"></i></h4>
      </div>

        <div class="modal-body">

     <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => true,
                'action' => '/products/view/'.$item->slug,
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
            ]); ?>


  <div class="form-group">
    <label>Your Name/Nick Name</label>
      <?php echo $form->field($oReview, 'owner')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Name') ])->label(false);  ?>
      <label>Title</label>
      <?php echo $form->field($oReview, 'title')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Title') ])->label(false);  ?>

  </div>
  <div class="form-group">
    <label>Please Rate Our Product</label>
    <label class="radio-inline">
  <input type="radio" name="News[no_of_review]" id="inlineRadio1" value="1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="News[no_of_review]" id="inlineRadio2" value="2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="News[no_of_review]" id="inlineRadio3" value="3"> 3
</label>

    <label class="radio-inline">
  <input type="radio" name="News[no_of_review]" id="inlineRadio1" value="4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="News[no_of_review]" id="inlineRadio2" value="5"> 5
</label>
  </div>
  <div class="form-group">
    <label>Your Review</label>
      <?= $form->field($oReview, 'text')->textarea([ 'class' => 'form-control','rows'=>3])->label(false); ?>


      <p class="help-block">We Appreciate Your Review, Thanks For Your Time</p>
  </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Review</button>
            </div>
            <?php ActiveForm::end(); ?>
      </div>

    </div>
  </div>
</div>



    </div>

<div style="al">
    <?php    echo Yii::$app->session->getFlash('success');   ?>

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
                        <p class="product-star testimon">
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
                        <!--<h4><i class="fa fa-thumbs-up fa-lg"></i> Yes, I recommend this product.</h4>-->
                        <ul class="product-details">
                           <li>Share
                                <?php $reviewUrl=Url::to(['products/review'], true).'/?slug='.$item->slug .'&review='.$review->slug;?>
                               <span class='st_facebook_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>" ></span>
                               <span class='st_twitter_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>"></span>
                               <span class='st_googleplus_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $review->title?>"></span>


                           </li>
                        </ul>                    </div>
                    <hr>

                <?

                }
                ?>

                <?= \app\modules\reviews\api\News::pages() ?>

<!--                <a class="readMore">read more</a> -->
            </div>
            <div class="col-sm-4">


                <a href="<?= $item->adv1_url?>">
                    <img src="<?=Yii::$app->language =='en' ? $item->adv_1 :$item->adv_1_ar ?>" class="margin-bottom30 img-responsive center-block"/>
                </a>

                <a href="<?= $item->adv2_url?>">
                    <img src="<?=Yii::$app->language =='en' ? $item->adv_2 : $item->adv_2_ar ?>"  class="margin-bottom30 img-responsive center-block"/>
                </a>


            </div>
        </div></div>

    </div>


    <div class="modal fade" id="youtube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?= $item->title ;?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="yt-player">
                    <iframe width="100%" height="315" src="http://www.youtube.com/embed/<?php echo $item->video?>"></iframe>

                </div>
            </div>
        </div>
    </div>


<script>

    var src="http://www.youtube.com/embed/<?php echo $item->video?>";
$('#youtube').on('hidden.bs.modal', function () {
    $("#yt-player iframe").attr("src",src);
});


$('#youtube').on('show.bs.modal', function () {
    $("#yt-player iframe").attr("src", src+"?autoplay=1");
});

</script>
