<?php use yii\helpers\Html; ?>

<li>

    <?php
    if(Yii::$app->language =='en' ){
        $image= $item->image;
    }else{
        $image=$item->image_ar;
    }
    ?>
    <img class="center-block img-responsive thumb" src="<?php echo $image?>" alt="<?= $item->item_image_alt ?>" >

    <?//= Html::img($item->thumb(125, 169),['class'=>'center-block img-responsive']) ?>
	<div class="product-name"><?= $item->title ?></div>
    <?= Html::a(Yii::t('easyii', 'order online').'', ['products/view-online', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>

</li>