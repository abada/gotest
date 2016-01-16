<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "2222d12e-5607-475a-b5d7-2ba1c0a2c5c0", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<?php
use app\models\AddToCartForm;
use yii\easyii\modules\catalog\api\Catalog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;
use  \app\models\Products;

$this->title = $item->seo('title', $item->model->title);
$totalreviews=  Products::reviews($item->id,1);

?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="online-product">
                    <div class="row">
                        <div class="col-md-7"  ><div class="media">
                                <div class="media-left">
<!--                                    <img class="img-responsive center-block" src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/offer-1.jpg">-->
                                    <? //= Html::img($item->thumb(300, 300),['class'=>'center-block']) ?>
                                    <?php
                                   if (\Yii::$app->language == "en"){
                                       $image =($item->online_image == "")?  $item->image :$item->online_image ;
                                    }else{
                                       $image =($item->online_image_ar == "")?  $item->image_ar :$item->online_image_ar ;


                                   }
                                    ?>

                   <img src="<?= $image ?>" width="300" height="300" class="center-block">


                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?= $item->title ;?> </h3>
                                    <p><?= $item->price ;?>
                                        <? if(\Yii::$app->language == 'ar') echo "ج.م" ;?>
                                        <? if(\Yii::$app->language == 'en') echo "LE" ;?> </p>
                                    <form id="ratingsForm">
                                        <?= Products::reviews($item->id)?>

                                        <div class="stars">
                                            <?php
                                            for($i=0; $i<$totalreviews;$i++){
                                                ?>
                                                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/product-stars.png" class="star-img">

                                            <?
                                            }
                                            ?>
                                        </div>

                                    </form>
                                   <!-- <a class="" href="#"><?= Yii::t('easyii','check reviews')?></a>-->


                                    <?php if(Yii::$app->request->get(AddToCartForm::SUCCESS_VAR)) {
                                     ?>
                                        <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i>
                                            <?= Yii::t('easyii','Added to cart')?>
                                            </h4>

                                    <?
                                    }else{
                                  $form = ActiveForm::begin([

                                        'action' => Url::to(['/shopcart/add', 'id' => $item->id ]),
                                        'options' => ['class' => 'form-inline']
                                    ]); ?>

                                    <div class="form-group" style="float: left;width: 100%;">
                                        <?= $form->field($addToCartForm, 'count')->textInput(['class' => 'form-control'])->label(Yii::t('easyii','Quantity')) ?>
                                        	
                                    </div>
                                    <?= Html::submitButton(Yii::t('easyii','Add to Cart').' <i class="fa fa-cart-arrow-down fa-lg"></i>' , ['class' => 'btn dry-btn','style' => 'float:left']) ?>
                                    <?php ActiveForm::end();
                                    }
                                    ?>


                                </div>
                            </div></div>
                        <div class="col-md-5">
                            <h3><?= Yii::t('easyii','Product details');?></h3>
                            <hr>
                            <p><?= $item->description ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class='col-md-12 alert' dir=" " style="display: none">
                            <div class='alert alert-danger'>
                                <a class="close" data-hide="alert">×</a>
                                <strong>!</strong> <?= Yii::t('easyii','please add item to cart first') ?>

                            </div>
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
                        <a class="btn dry-btn-2 pull-right" <?= $url?>>
                            <?= Yii::t('easyii','Check Out'); ?></a>
                    </footer>
                </div>
            </div>
        </div>




        <div class="title like-title"><?= Yii::t('easyii','you may like also');?> </div>
        <div class="col-md-12">
            <div id="owl-example" class="owl-carousel">

                <?php if(count($products)){
                    foreach ($products as $product){
                        ?>
                        <div  class="item">
                            <?= Html::img($product->thumb(125, 169),['class'=>'center-block img-responsive']) ?>

                            <a href="/products/view-online?slug=<?=$product->slug   ?>" >
                            <button class="btn dry-btn"><?= Yii::t('easyii','view more')?>
<!--                                <img src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/view-arrow.jpg"/>-->
                            </button>
                                </a>
                        </div>

                    <?

                    }
                }
                  ?>



            </div>
        </div>
    </div>
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
