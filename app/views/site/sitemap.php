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

$this->title = $page->seo('title', $page->model->title);
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">site map</h2>
            </div>
        </div>
        <div class="row">
            <div class="site-map center-block">
                <a href="/"><i class="fa fa-circle"></i> home</a>
                <a href="/products"><i class="fa fa-circle"></i> Products</a>
                <a href="/products/offers"><i class="fa fa-circle"></i> Offers</a>
                <a href="/stores"><i class="fa fa-circle"></i> Find a store</a>
                <a href="/site/about-dry"><i class="fa fa-circle"></i> About Dry</a>
                <a href="/site/about-dry"><span><i class="fa fa-circle-o"></i> whos dry</span></a>
                <a href="/site/awarness"><span><i class="fa fa-circle-o"></i> awareness program</span></a>
                
                <a href="/contact"><i class="fa fa-circle"></i> contact us</a>
                <a href="/products/online"><i class="fa fa-circle"></i> order online</a>
                
                
            </div>
        </div>
    </div>
</div>