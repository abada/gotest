<?php use yii\helpers\Html; ?>

<li>
    <?= Html::img($item->thumb(125, 169),['class'=>'center-block img-responsive']) ?>
	<div class="product-name"><?= $item->title ?></div>
    <?= Html::a(Yii::t('easyii', 'order online').'', ['products/view-online', 'slug' => $item->slug],['class' => 'btn dry-btn']) ?>

</li>