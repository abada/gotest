<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\AddToCartForm;
use yii\easyii\modules\catalog\api\Catalog;
?>

<a name="<?= $item->offer_product_id ?>"  id="<?= $item->offer_product_id ?>"></a>

<div class="col-md-12 offer">
    <div class="inner-offer">
        <div class="media">
            <div class="media-left">
                <?//= Html::img($item->thumb(302, 241),['class'=>'img-responsive']) ?>
    <?php
    if(Yii::$app->language =='en' ){
        $image= $item->image;
        $dir='ltr';
    }else{
        $image=$item->image_ar;
        $dir='rtl';

    }
    ?>
        <img class="img-responsive" src="<?php echo $image?>">

            </div>
            <div class="media-body">
                <h3 class="media-heading"><?= $item->title ?></h3>
                <p><?= $item->description ;?></p>


                <?php if(Yii::$app->request->get(AddToCartForm::SUCCESS_VAR) and Yii::$app->request->get('id')== $item->id) { ?>
                    <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i><?= Yii::t('easyii','Added to cart'); ?>  </h4>
                <?php } else { ?>


                    <?php $form = ActiveForm::begin(['action' => Url::to(['/shopcart/add', 'id' => $item->id])]); ?>
                    <?= $form->field($addToCartForm, 'count')->hiddenInput(['value' => 1])->label(false) ?>
                    <?= Html::submitButton(Yii::t('easyii','Add to Cart').' <i class="fa fa-cart-arrow-down fa-lg"></i>' , ['class' => 'btn dry-btn']) ?>

                   <div class="clear"></div>
                    <div class='col-md-12 alert' dir=" " style="display: none; direction: <?=$dir?>" >
                        <div class='alert alert-danger'>
                            <a class="close" data-hide="alert">×</a>
                            <strong>!</strong> <?= Yii::t('easyii','please add item to cart first') ?>

                        </div>
                    </div>



                        <?php ActiveForm::end(); ?>

                <?php
                }
                ?>




            </div>
        </div>
        <footer>

            <a class="btn dry-btn-2 shopping" href="/products/online" style="line-height:normal">
                <?= Yii::t('easyii','Continue Shopping'); ?></a>

            <?php
            if(\yii\easyii\modules\shopcart\api\Shopcart::goods()){

                $url='href="/shopcart"';
            }else{
                $url='  href="javascript:void(0)"  onclick="'."$('.alert').show()".' "';
            }
            ?>
            <a <?= $url?> ><button class="btn dry-btn-2 pull-right"> <?= Yii::t('easyii','Check Out'); ?> </button></a>
        </footer>
    </div>
</div>

<script>
    $(function(){
        $("[data-hide]").on("click", function(){
            $("." + $(this).attr("data-hide")).hide();
            /*
             * The snippet above will hide all elements with the class specified in data-hide,
             * i.e: data-hide="alert" will hide all elements with the alert property.
             *
             * Xeon06 provided an alternative solution:
             * $(this).closest("." + $(this).attr("data-hide")).hide();
             * Use this if are using multiple alerts with the same class since it will only find the closest element
             *
             * (From jquery doc: For each element in the set, get the first element that matches the selector by
             * testing the element itself and traversing up through its ancestors in the DOM tree.)
             */
        });
    });

</script>
