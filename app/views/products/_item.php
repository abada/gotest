<?php use yii\helpers\Html; ?>



<li data-tag='postpartum'>
<!--    <img class="center-block img-responsive" src="images/product-img.jpg">-->
    <?= Html::img($item->thumb(125, 169)) ?>
    <?php if($item->no_of_drops == ''){$no=1;}else{$no=$item->no_of_drops ;}?>

     <img class="center-block img-responsive" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()."/theme/images/drops/".$no.".png" ;?>">


	<div class="product-name"><?= $item->title ?></div>
    <?= Html::a(Yii::t('easyii', 'view more').'
        ', ['products/view', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>

</li>