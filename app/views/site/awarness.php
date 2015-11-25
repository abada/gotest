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
use \app\modules\awarness\api\Feedback as Awarness;


$page = Page::get('about');

$this->title = $page->seo('title', $page->model->title);
use yii\widgets\ActiveForm;

?>

<div class="content">
    <?php

    $banner = \app\modules\advertise\models\Page::find(1)->one();
        Yii::$app->language =='en' ? $image=$banner->image :$image=$banner->image_ar

    ?>
          <img class="img-responsive" src="<?= $image ;?>">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $page = Page::get('know-more-about-us');?>
                <h2 class=" lined-heading"><span><?= $page->title ;?></span></h2>
            </div>
            <div class="lineHeight awarness">
                <?= $page->text ;?>

            </div>
        </div>
    </div>
    <div class="request-programe">
        <h1>request awareness program</h1>

        <?php if($Saved) : ?>
            <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> <?= Yii::t('easyii', 'Message successfully sent')?> </h4>
        <?php else : ?>
   <?php
            $form = ActiveForm::begin([
                'enableClientValidation' => true,
               'options'=>['class'=>'col-md-offset-4']

            ]);
            ?>

        <div class="form-group center-block col-md-6">

            <?php echo $form->field($model, 'name')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Name') ])->label(false);  ?>
            <?php echo $form->field($model, 'title')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Phone') ])->label(false);  ?>
            <?php echo $form->field($model, 'email')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Your Mail') ])->label(false);  ?>
            <?php echo $form->field($model, 'text')->textarea(['class' => 'form-control msg',' placeholder'=>Yii::t('easyii', 'your message') ])->label(false);  ?>

            <button type="submit" class="btn dry-btn-3 center-block"><?php echo Yii::t('easyii', 'Send Request') ?></button>
        </div>


        <?php ActiveForm::end() ; ?>

        <?php endif; ?>

    </div>
</div>

