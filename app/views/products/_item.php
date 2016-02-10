<?php use yii\helpers\Html; ?>



<li data-tag='postpartum'>
<!--    <img class="center-block img-responsive thumb" src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/product-img.jpg">-->
    <?//= Html::img($item->thumb(125, 125),['class'=>'center-block img-responsive thumb']) ?>
    <?php
    if(Yii::$app->language =='en' ){
        $image= $item->image;
    }else{
        $image=$item->image_ar;
    }
    ?>

    <?= Html::a('<img class="center-block img-responsive thumb" src="'.$image.'" alt="'.$item->title. '" >
'.'
        ', ['products/view', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>


    <div class="product-name"><?= $item->title ?></div>
    <?php if($item->no_of_drops == ''){$no=1;}else{$no=$item->no_of_drops ;}?>

     <img class="center-block img-responsive dropsimg" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()."/theme/images/drops/".$no.".png" ;?>">


	
    <?= Html::a(Yii::t('easyii', 'view more').'
        ', ['products/view', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>

</li>