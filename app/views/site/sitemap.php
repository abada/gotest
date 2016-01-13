<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\helpers\Html;
use  \yii\easyii\models\Setting;


$page = Page::get('about');

$this->title = yii::t('easyii','Dry Site Map');

$products = \yii\easyii\modules\catalog\models\Item::find()->where('category_id =2')->all();
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= yii::t('easyii','site map')?> </h2>
            </div>
        </div>
        <div class="row">
            <div class="site-map center-block">
                <a href="/"><i class="fa fa-circle"></i> <?= yii::t('easyii','home')?></a>
                <a href="/products"><i class="fa fa-circle"></i><?= yii::t('easyii','Products')?> </a>
                <?php
                foreach($products as $product){

                    echo "<a href='products/view/".$product->slug."'><span><i class='fa fa-circle-o'></i>$product->title </span></a>";
                }
                ?>



                <a href="/offers"><i class="fa fa-circle"></i> <?= yii::t('easyii','Offers')?></a>
                <a href="/stores"><i class="fa fa-circle"></i><?= yii::t('easyii','Find a store')?> </a>
                <a href="/who’s-Dry"><i class="fa fa-circle"></i> <?= yii::t('easyii','About Dry')?></a>
                <a href="/who’s-Dry"><span><i class="fa fa-circle-o"></i><?= yii::t('easyii',"Who’s Dry")?> </span></a>
                <a href="/awareness-program"><span><i class="fa fa-circle-o"></i><?= yii::t('easyii','awareness program')?> </span></a>
                
                <a href="/contact-us"><i class="fa fa-circle"></i><?= yii::t('easyii','contact us')?> </a>
                <a href="/products-online"><i class="fa fa-circle"></i> <?= yii::t('easyii','order online')?></a>
                
                
            </div>
        </div>
    </div>
</div>