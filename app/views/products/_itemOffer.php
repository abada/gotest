<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\AddToCartForm;
use yii\easyii\modules\catalog\api\Catalog;
?>

<div class="col-md-12 offer">
    <div class="inner-offer">
        <div class="media">
            <div class="media-left">
                <?= Html::img($item->thumb(302, 241),['class'=>'img-responsive']) ?>

            </div>
            <div class="media-body">
                <h3 class="media-heading"><?= $item->title ?></h3>
                <p><?= $item->description ;?></p>


                <?php if(Yii::$app->request->get(AddToCartForm::SUCCESS_VAR) and Yii::$app->request->get('id')== $item->id) { ?>
                    <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Added to cart</h4>
                <?php } else { ?>
                    <?php $form = ActiveForm::begin(['action' => Url::to(['/shopcart/add', 'id' => $item->id])]); ?>
                    <?= $form->field($addToCartForm, 'count')->hiddenInput(['value' => 1])->label(false) ?>
                    <?= Html::submitButton(Yii::t('easyii','Add to Cart').' <i class="fa fa-cart-arrow-down fa-lg"></i>' , ['class' => 'btn dry-btn']) ?>
                    <?php ActiveForm::end(); ?>

                <?php
                }
                ?>




            </div>
        </div>
        <footer>
            <button class="btn dry-btn-2 shopping"> <?= Yii::t('easyii','Continue Shopping'); ?></button>
            <a href="/shopcart"><button class="btn dry-btn-2 pull-right"> <?= Yii::t('easyii','Check Out'); ?> </button></a>
        </footer>
    </div>
</div>
