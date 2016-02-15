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

            <?php $reviewUrl=\yii\helpers\Url::to(['site/about'], true).'/?review='.$model->page_id;?>

              <a class="js-social-share" href="https://twitter.com/intent/tweet/?text=<?= $model->title ;?>&url=<?= urlencode($reviewUrl) ;?>&via=DryArabia" target="_blank">
                <img width="30" height="30" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/twitter.png">
            </a>
            <a  class="js-social-share" href="https://plus.google.com/share?url=<?= urlencode($reviewUrl) ;?>"  target="_blank">
                <img width="30" height="30" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/googleplus.png">
            </a>
            <a class="js-social-share" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($reviewUrl) ;?>" target="_blank">
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