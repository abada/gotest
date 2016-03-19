
<!--<script>-->
<!--    if(window.location.hash) {-->
<!--        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character-->
<!--        $( "#"+hash ).addClass( "ancoreTop" );-->
<!--        // hash found-->
<!--    } else {-->
<!--        // No hash found-->
<!--    }-->
<!--</script>-->

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;

//
//$this->title = $cat->seo('title', $cat->model->title);
$this->title = yii::t('easyii','Dry  Offers');

$this->params['meta_keyword'] = yii::t('easyii','Sanitary napkin for the married, the Dry trunk of birth, better sanitary napkin for sensitive skin, better sanitary napkin after birth, types of towels PMS');
$this->params['meta_description'] = yii::t('easyii','DRY Arabia offers best sanitary pads to take care of the sensitive region before marriage and offers the best kinds of towels menstrual cycle ');


$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $cat->model->title;

//var_dump($this->params['sliderFilters']);
//echo $sliderFilters['absorptionrate'].'dd';die;

$page = Page::get('offerpage');
?>
<style>
.navbar-fixed-top{
position:absolute !important;	
}
</style>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= $page->title;?></h2>
            </div>
            <div class="sub-title">
                <?= $page->text;?>
                </div>
        </div>




        <div class="row">
			<div class="col-md-12">
            <?php foreach($items as $item) : ?>
                <?= $this->render('_itemOffer', ['item' => $item ,'addToCartForm' => new \app\models\AddToCartForm(),
                ]) ?>
            <?php endforeach; ?>
			</div>

        </div>
    </div>
</div>