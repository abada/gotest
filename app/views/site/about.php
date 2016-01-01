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
             /* A dataprovider with all articles */
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => PageModel::find()->where(['homepage' => 0]),
                'pagination' => [
                    'pagesize' => 5 ,
                ],
            ]);


            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_reviewnew',
                'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
                    'noneLeftText'=>yii::t('easyii','No More'),
                    'triggerText'=>'<button class="btn dry-btn-2 center-block margin-bottom10">'.yii::t('easyii','More Testimonials').'</button>'],


            ]);


     ?>

<!--            <button class="btn dry-btn-2 center-block margin-bottom10">More Testimonials</button> -->
        </div>
    </div>
</div>