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

$this->title = $page->seo('title',yii::t('easyii',"Who’s Dry"));


$this->params['meta_keyword'] = yii::t('easyii','meta 2');
$this->params['meta_description'] = yii::t('easyii','meta 80');
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
                'query' => PageModel::find()->where("homepage=0  or homepage=2")
                ,
                'pagination' => [
                    'pagesize' => 4 ,
                ],
            ]);


            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_reviewnew',
                'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
                    'noneLeftText'=>'', //yii::t('easyii','No More')
                    'triggerText'=>'<button class="btn dry-btn-2 center-block margin-bottom10">'.yii::t('easyii','More Testimonials').'</button>'],


            ]); //btn dry-btn-2 center-block margin-bottom10


     ?>

        </div>
    </div>
</div>



    <script>

        function windowPopup(url, width, height) {
            // Calculate the position of the popup so
            // it’s centered on the screen.
            var left = (screen.width / 2) - (width / 2),
                top = (screen.height / 2) - (height / 2);

            window.open(
                url,
                "",
                "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left
            );
        }


        //jQuery
        $(".js-social-share").on("click", function(e) {
            e.preventDefault();

            windowPopup($(this).attr("href"), 500, 300);
        });

        // Vanilla JavaScript
        var jsSocialShares = document.querySelectorAll(".js-social-share");
        if (jsSocialShares) {
            [].forEach.call(jsSocialShares, function(anchor) {
                anchor.addEventListener("click", function(e) {
                    e.preventDefault();

                    windowPopup(this.href, 500, 300);
                });
            });
        }

    </script>