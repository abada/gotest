<?php
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\easyii\modules\subscribe\api\Subscribe;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use  \yii\easyii\models\Setting;
use yii\helpers\Html;

$goodsCount = count(Shopcart::goods());
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>



<header class="navbar navbar-fixed-top bs-docs-nav" id="top" role="banner">
<div class="search">
  <div class="container">
 <?= Html::beginForm(Url::to(['/search']), 'get') ?>
                        <?= Html::textInput('text', $text, ['class' => 'form-control', 'placeholder' => '']) ?>
                        
<?= Html::endForm() ?>
</div>
</div>
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      
      
      <a class="navbar-brand" href="<?= Url::home() ?>"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/logo.png"></a>
    </div>
    <nav id="bs-navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav cl-effect-21">
                <li class=""><a href="<?= Url::home() ?>">
                        <span class="sr-only">(current)</span><?= Yii::t('easyii', 'home');?></a>
                </li>
                <li><a href="/products"><?= Yii::t('easyii', 'Products');?></a></li>
                <li><a href="/offers"><?= Yii::t('easyii', 'Offers');?></a></li>
                <li><a href="/stores"><?= Yii::t('easyii', 'Find a store');?></a></li>
                
                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= Yii::t('easyii', 'About Dry');?>  <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/who’s-Dry"><?= Yii::t('easyii', 'Who’s Dry');?></a></li>
                    <li><a href="/awareness-program"><?= Yii::t('easyii', 'awareness program');?></a></li>
                  </ul>
                </li>
            </ul>
            
      <ul class="social">

        <li><a href=" <?= Setting::get('facebook')?>" target="_blank"><i class="fa fa-facebook  fb"></i></a></li>
        <li><a href=" <?= Setting::get('twitter')?>" target="_blank"><i class="fa fa-tumblr  twe"></i></a></li>
        <li><a href=" <?= Setting::get('instagram')?>" target="_blank"><i class="fa fa-instagram  in"></i></a></li>
        <li><a href=" <?= Setting::get('youtube')?>" target="_blank"><i class="fa fa-youtube uTube"></i></a></li>
      </ul>   
      <ul class="heder-r">
        <li>
            <?php echo \webvimark\behaviors\multilanguage\language_selector_widget\LanguageSelector::widget();?>
        </li>
        
        
        
        
       <li>
             <span class="searchclick">
                  <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/search-purple-icon.png" class="search"/></span>
			 
         </li>
      </ul>  
          
      
    </nav>
  </div>
</header>














<?= $content ?>





<footer>
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">

                <h3><?= Yii::t('easyii', 'newsletter sign up');?></h3>

                <?php if(Yii::$app->request->get(Subscribe::SENT_VAR)) : ?>
                    <?= Yii::t('easyii', 'You have successfully subscribed');?>
                <?php else : ?>
                    <?= Subscribe::form() ?>
                <?php endif; ?>


            </div>

<!--
 <form class="form-inline col-md-offset-2">
                    <div class="input-group">
                        <input type="text" class="form-control" id="left" placeholder="Enter email">
                        <div class="input-group-addon"><a href="#"><img src="images/mail.png"/></a></div>
                    </div>
                </form>

 -->


            <div class="col-sm-6">
                <h3><?= Yii::t('easyii', 'Follow Us');?></h3>
                <ul class="social list-inline center-block">
                    <li><a href="<?= Setting::get('facebook')?>" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
                    <li><a href=" <?= Setting::get('twitter')?>" target="_blank"><i class="fa fa-tumblr fa-2x"></i></a></li>
                    <li><a href="<?= Setting::get('instagram')?>" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></li>
                    <li><a href="<?= Setting::get('youtube')?>" target="_blank"><i class="fa fa-youtube fa-2x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <ul class="footer-menu list-inline text-center">
                <li><a href="<?= Url::home() ?>"><?= Yii::t('easyii', 'home');?></a></li>|
                <li><a href="/products"><?= Yii::t('easyii', 'Products');?></a></li>|
                <li><a href="/offers"><?= Yii::t('easyii', 'Offers');?></a></li>|
                <li><a href="/stores"><?= Yii::t('easyii', 'Find a store');?></a></li>|
                <li><a href="/who’s-Dry"><?= Yii::t('easyii', 'About Dry');?> </a></li>|
                <li><a href="/contact-us"><?= Yii::t('easyii', 'contact us');?></a></li>|
                <li><a href="/site-map"><?= Yii::t('easyii', 'site map');?></a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12"><p class="text-center h6 margin-top10">
                    <?= Yii::t('easyii', 'Copyright '.date("Y").'. All Right Reserved');?>
                    </p></div>
        </div>
    </div>

</footer>



<?php $this->endContent(); ?>
