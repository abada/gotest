    <div class="review">
    <p class="text-uppercase">
        <?//= $model->getOwner() ;?>
        <span class="margin-left10"><i class="fa fa-calendar"></i>
            <?//= $model->date?>
                            </span></p>
    <p class="product-star testimon">
        <input value="<?= $model->no_of_review ;?>" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" readonly="readonly">


    </p>
    <h3><?= $model->title?></h3>
    <p><?= $model->text?></p>
    <!--<h4><i class="fa fa-thumbs-up fa-lg"></i> Yes, I recommend this product.</h4>-->
    <ul class="product-details">
        <li><?= yii::t('easyii','Share')?>

            <?php $reviewUrl=\yii\helpers\Url::to(['products/review'], true).'/?slug='.$item->slug .'&review='.$model->slug;?>
            <span class='st_facebook_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>" ></span>
            <span class='st_twitter_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>"></span>
            <span class='st_googleplus_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>"></span>


        </li>
    </ul>                    </div>
<hr>