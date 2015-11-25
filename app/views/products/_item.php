<?php use yii\helpers\Html; ?>



<li data-tag='postpartum'>
<!--    <img class="center-block img-responsive" src="images/product-img.jpg">-->
    <?= Html::img($item->thumb(125, 169)) ?>
	<div class="product-name"><?= $item->title ?></div>
    <?= Html::a(Yii::t('easyii', 'view more').'
        ', ['products/view', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>

</li>