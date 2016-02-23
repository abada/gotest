<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;
?>
    <ul class="col-md-12 col-centered products-page" >

        <?php if(count($items)) : ?>
            <br/>
            <?php foreach($items as $item) : ?>
                <?= $this->render('_item', ['item' => $item]) ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p><?= Yii::t('easyii', 'No products Found');?>  </p>
        <?php endif; ?>


    </ul>

<?= $cat->pages() ?>