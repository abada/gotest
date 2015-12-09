<?php use yii\helpers\Html; ?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= Yii::t('easyii',' search result for')?> <span class="search-result"><?=$text?></span></h2>
            </div>
            <div class="sub-title"><?= count($items)?> <?= Yii::t('easyii','results found on the site')?> </div>

            <?php if(count($items)) : ?>
                <?php foreach($items as $item) : ?>
                    <p class="search-result">
             <?= Html::a($item->title, ['products/view', 'slug' => $item->slug],['class' => '']) ?>
                    <br/>
                        <?= $item->description?>
                        .</p>
                <?php endforeach; ?>


            <?php else : ?>
                <p> <?= Yii::t('easyii','No items found')?> </p>
            <?php endif; ?>




        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>