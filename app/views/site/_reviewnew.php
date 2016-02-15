<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "2222d12e-5607-475a-b5d7-2ba1c0a2c5c0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<?php
if($index % 2) {
    echo '<div class="gray-review  ">
                                        <div class="about-review container">';
} else {

    echo ' <div class="about-review container">';
}
?>




<div class="testim">
    <h4><?= $model->owner?> </h4>
    <h3><?= $model->title ?></h3>
    <p><?= $model->text ?></p>
    <ul class="product-details">
        <li><?= yii::t('easyii','Share')?>
            <?php $reviewUrl=\yii\helpers\Url::to(['products/review'], true).'/?slug='.$item->slug .'&review='.$model->slug;?>
            <span class='st_facebook_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>" ></span>
            <span class='st_twitter_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>"></span>
            <span class='st_googleplus_large' displayText='' st_url="<?= $reviewUrl ;?>" st_title="<?= $model->title?>"></span>


            <a class="js-social-share" href="https://twitter.com/intent/tweet/?text=Check%20out%20this%20website!&url=https%3A%2F%2Fjonsuh.com%2F&via=jonsuh" target="_blank">
                <img width="30" height="30" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/twitter.png">
            </a>
            <a  class="js-social-share" href="https://plus.google.com/share?url=https%3A%2F%2Fjonsuh.com%2F"  target="_blank">
                <img width="30" height="30" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/googleplus.png">
            </a>
            <a class="js-social-share" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fjonsuh.com%2F" target="_blank">
                <img width="30" height="30" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/facebook.png">
            </a>




        </li>
    </ul>


</div>


<?php
if($index % 2) {
    echo ' </div> </div>';
} else {
    echo ' </div>';


}

?>