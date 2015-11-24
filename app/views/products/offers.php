<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//
$this->title = $cat->seo('title', $cat->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $cat->model->title;

//var_dump($this->params['sliderFilters']);
//echo $sliderFilters['absorptionrate'].'dd';die;
?>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= Yii::t('easyii','SAVE WITH dryq® COUPONS AND OFFERS') ;?></h2>
            </div>
            <div class="sub-title">
                <?= Yii::t('easyii','Choose from any of the special offers below to enjoy valuable savings on Poise® protection.') ;?>
                </div>
        </div>




        <div class="row">

            <?php foreach($items as $item) : ?>
                <?= $this->render('_itemOffer', ['item' => $item ,'addToCartForm' => new \app\models\AddToCartForm(),
                ]) ?>
            <?php endforeach; ?>


        </div>
    </div>
</div>