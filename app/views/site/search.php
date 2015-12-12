<?php use yii\helpers\Html;
use yii\easyii\modules\page\api\Page;

$pageAwarness = Page::get('know-more-about-us');
$pageAbout = Page::get('about');


$count=0;
if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false) $count++;
if(strpos($pageAwarness->title ,$text) !== false or strpos($pageAwarness->text ,$text) !== false) $count++;

?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= Yii::t('easyii',' search result for')?> <span class="search-result"><?=$text?></span></h2>
            </div>
            <div class="sub-title"><?php if(count($items)+$count)echo count($items)+$count; ?> <?= Yii::t('easyii','results found on the site')?> </div>
            <?php $i=0;?>

            <?php if(count($items)) :
                $i=1;
                ?>
                <?php foreach($items as $item) : ?>
                    <p class="search-result">
             <?= Html::a($item->title, ['products/view', 'slug' => $item->slug],['class' => '']) ?>
                    <br/>
                        <?= $item->description?>
                        .</p>
                <?php endforeach; ?>

            <?php endif; ?>


            <?php
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['site/about-dry'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>

            <?php
            if(strpos($pageAwarness->title ,$text) !== false or strpos($pageAwarness->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAwarness->title, ['site/about-dry'],['class' => '']) ?>
                    <br/>
                    <?= $pageAwarness->text?>
                    .</p>
            <?  }  ?>

            <?php
            $pageAbout = Page::get('our-vision');
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['site/about-dry'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>


            <?php
            $pageAbout = Page::get('our-mission');
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['site/about-dry'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>


            <?php
            $pageAbout = Page::get('offerpage');
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['products/offers'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>


            <?php
            $pageAbout = Page::get('page-contact');
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['contact'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>




            <?php
            $pageAbout = Page::get('find-store');
            if(strpos($pageAbout->title ,$text) !== false or strpos($pageAbout->text ,$text) !== false){
                $i=1;
                ?>
                <p class="search-result">
                    <?= Html::a($pageAbout->title, ['stores'],['class' => '']) ?>
                    <br/>
                    <?= $pageAbout->text?>
                    .</p>
            <?  }  ?>


            


            <p> <?php

                if($i=0) echo Yii::t('easyii','No items found')?> </p>



        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>