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


$page = Page::get('page-index');

$this->title = $page->seo('title', $page->model->title);
?>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="multi lang"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <?php
        $i=0;
        if(count($items)) {
            foreach ($items as $item) {
                ?>
                <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                    <?= $item ;?>
                </div>
                <?
                $i = 1;
            }
        }
        ?>


    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <i class="fa fa-angle-left fa-5x" aria-hidden="true"></i>
        <span class="sr-only"><?= Yii::t('easyii', 'Previous');?></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <i class="fa fa-angle-right fa-5x" aria-hidden="true"></i>
        <span class="sr-only"><?= Yii::t('easyii', 'Next');?></span>
    </a>
</div>

<?php  $page = Page::get('dry-feature'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
             <h2 class=" lined-heading text-primary">
               <span><?= $page->title ;?>   </span></h2>
        </div>
    </div>
</div>
<div class="content">

    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10"><p class="text-center text-justify"><?= $page->text ;?></p></div>
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="circle-container">
                        <div class="circlestat center-block absorption-bg" data-dimension="200" data-text="<?= Setting::get('absorption')?>%" data-width="15" data-fontsize="30" data-percent="<?= Setting::get('absorption')?>" data-fgcolor="#fc8abe" data-bgcolor="#f0eeef"></div>
                        <div class="title"><?= Yii::t('easyii', 'absorption');?></div>
                    </div>
                </div><div class="col-md-3">
                    <div class="circle-container">
                        <div class="circlestat center-block cotton-bg" data-dimension="200" data-text="<?= Setting::get('cotton')?>%" data-width="15" data-fontsize="30" data-percent="<?= Setting::get('cotton')?>" data-fgcolor="#fc8abe" data-bgcolor="#f0eeef"></div>
                        <div class="title"><?= Yii::t('easyii', 'cotton');?></div>
                    </div>
                </div><div class="col-md-3">
                    <div class="circle-container">
                        <div class="circlestat center-block stickiness-bg" data-dimension="200" data-text="<?= Setting::get('stickiness')?>%" data-width="15" data-fontsize="30" data-percent="<?= Setting::get('stickiness')?>" data-fgcolor="#fc8abe" data-bgcolor="#f0eeef"></div>
                        <div class="title"><?= Yii::t('easyii', 'stickiness');?></div>
                    </div>
                </div><div class="col-md-3">
                    <div class="circle-container">
                        <div class="circlestat center-block fitting-bg" data-dimension="200" data-text="<?= Setting::get('fittingclothes')?>%" data-width="15" data-fontsize="30" data-percent="<?= Setting::get('fittingclothes')?>" data-fgcolor="#fc8abe" data-bgcolor="#f0eeef"></div>
                        <div class="title"><?= Yii::t('easyii', 'fitting clothes');?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class=" lined-heading"><span><?= Yii::t('easyii', 'keep moving');?></span></h2>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 no-padding">
                <div id="carousel-example-generic-1" class="carousel slide mini-slider carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery1')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2 no-padding">
                <div id="carousel-example-generic-2" class="carousel slide mini-slider" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">

                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery2')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div id="carousel-example-generic-3" class="carousel slide mini-slider carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery3')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div id="carousel-example-generic-4" class="carousel slide mini-slider" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery4')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2 no-padding">
                <div id="carousel-example-generic-5" class="carousel slide mini-slider carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">

                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery5')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>

                    </div>
                </div>
            </div>
            <div class="col-md-4 no-padding">
                <div id="carousel-example-generic-6" class="carousel slide mini-slider" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery6')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div id="carousel-example-generic-7" class="carousel slide mini-slider carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery7')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div id="carousel-example-generic-8" class="carousel slide mini-slider carousel-fade" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach(Gallery::last(5,['item_id'=>Gallery::cat('gallery8')->model->category_id]) as $photo) :

                            ?>
                            <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                <img src="<?= $photo->image ;?>" alt="slider-<?$i?>">
                            </div>
                            <?
                            $i++;
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <ul class="col-md-12 col-centered features-group">
                <?php

                $adv1 = \app\modules\advertise\models\Page::findOne(2);
                $adv2 = \app\modules\advertise\models\Page::findOne(3);
                $adv3 = \app\modules\advertise\models\Page::findOne(4);
                ?>

                <li>
                    <img src="<?=Yii::$app->language =='en' ? $adv1->image :$adv1->image_ar ?>" class="img-responsive center-block"/>
                </li>
                <li>
                    <img src="<?=Yii::$app->language =='en' ? $adv2->image :$adv2->image_ar ?>" class="img-responsive center-block"/>
                    <button class="btn pink-btn btn-block">Sign Up Now!</button>
                </li>
                <li>
                    <img src="<?=Yii::$app->language =='en' ? $adv3->image :$adv3->image_ar ?>" class="img-responsive center-block"/>
                    <button class="btn pink-btn btn-block">Try it now!</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid gray-color margin-top50">
        <div class="container">
            <div class="row margin-top20">

                <?php  $page = Page::get('about'); ?>


                <div class="title"><?= $page->title ;?></div>
                <p class="lineHeight">
                <?php //= substr($page->text,0,450)." ...";
                echo $page->text;
                ?>
                </p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="carousel-example-generic-testimonials" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner testimonial" role="listbox">

                           <?php
                           $i=0;
                           foreach($testmonials as $item) :

                               ?>
                               <div class="item <?= ($i == 0) ? 'active' : ''; ?>">
                                  <p><?= $item->text?></p>
                               </div>
                               <?
                               $i++;
                           endforeach;


                           ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>