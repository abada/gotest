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
use app\modules\newtestmonials\models\Page as PageModel;

$page = Page::get('about');

$this->title = $page->seo('title', $page->model->title);
?>

<div class="content">

    <div class="container-fluid">
        <div class="row about">
            <div class="about-vision">
                <article>
                    <?php $page = Page::get('our-vision');?>
                    <div class="title"><?=$page->title;?></div>
                    <p>
                      <?php

                      echo $page->text;
                      ?>
                    </p>

                </article>

            </div>
            <div class="about-mission">
                <article>
                    <?php $page = Page::get('our-mission');?>
                    <div class="title"><?=$page->title;?></div>
                    <p>
                        <?php

                        echo $page->text;
                        ?>
                    </p>

                </article>

            </div>
            <div class="about-dry">
                <article>
                    <?php $page = Page::get('about') ?>
                    <div class="title"><?= $page->title ;?></div>
                    <p>

                        <?php

                        echo $page->text;
                        ?>

                    </p>

                </article>

            </div>



            <div class="testimonials">
                <div class="title"><?= Yii::t('easyii', 'testimonials');?> </div>
            </div>
            <?php
              $testmonials= PageModel::find()->where("homepage=0")->desc()->all();
                    $num = 0;
                foreach($testmonials as $item){
                    $num++;
                    if($num&1) {
                       echo ' <div class="about-review container">';
                    } else {
                        echo '<div class="gray-review about-review ">
                                        <div class="container">';
                    }

                    ?>
                    <h4><?= $item->owner?> </h4>
                    <h3><?= $item->title ?></h3>
                    <p><?= $item->text ?></p>
<!--                    <a href="#">Read More <i class="fa fa-caret-right"></i></a> -->

                <?php
                    if($num&1) {
                        echo ' </div>';
                    } else {
                        echo ' </div> </div>';

                    }



                }
            ?>




<!--            <button class="btn dry-btn-2 center-block margin-bottom10">More Testimonials</button> -->
        </div>
    </div>
</div>