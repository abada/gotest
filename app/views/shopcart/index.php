<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use yii\helpers\Url;
use  \yii\easyii\models\Setting;

$page = Page::get('page-shopcart');

 $this->title =yii::t('easyii','Checkout');
$this->params['breadcrumbs'][] = $page->model->title;
$delivery= Setting::get('deliver_cost');
?>

<?php
    $page = Page::get('shopcartpage');
?>



    <div class="content">
        <div class="container">
            <h2 class="title"><?= $page->title ?></h2>
            <div class="sub-title"><?= $page->text ?></div>
            
        </div>
        <div class="row shopcart">
 			<div class="container">
                <?php if(count($goods)) : ?>
                <div class="col-md-5 col-md-offset-1 order-online">
                      <?php
                      if($error){
                          $data =explode('.',$error);
                            foreach ($data as $error){
                                echo $error."<br/>";

                            }
                      }
                      ?>

                    <?= Shopcart::form(['successUrl' => Url::to('/checkout/thank-you') ],$model)?>


                </div>



                    <?= Html::beginForm(['/shopcart/update'])?>

                <div class="col-md-5 col-md-offset-1">
                <h2 class="title"><?= Yii::t('easyii','Check Out')?> </h2>
                        
                    <div class="your-order " id="Default">
                        
                  <?php foreach($goods as $good) :
                      ?>
                        <div class="order">
                            <div class="media">
                                <div class="media-left">
                                   <img src="<?= (\Yii::$app->language == 'ar') ? $good->item->image_ar :$good->item->image ?>" width="70px" alt="<?= $good->item->title?>">

                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?= $good->item->title ?></h3>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label for="exampleInputName2"><?= Yii::t('easyii','Quantity')?></label>
                                            <?= Html::textInput("Good[$good->id]", $good->count, ['class' => 'form-control','onChange'=>'this.form.submit();']) ?>
                                        </div>
                                    </div>
                                    <p>   <span class="close"><?= Html::a('<i class="fa fa-times-circle"></i>', ['/shopcart/remove', 'id' => $good->id], ['title' => 'Remove item']) ?></span>

                                        <?= Yii::t('easyii','Price')?>
                                        <span class="pull-right" >
                                           <? if(\Yii::$app->language == 'ar') echo "ج.م" ;?>
                                            <? if(\Yii::$app->language == 'en') echo "LE" ;?>
                                            <?= $good->price * $good->count ?>
                                          </span>
                                    </p>
                                </div>
                            </div>

                        </div>

                  <?php endforeach; ?>

                        


                    </div>

                    <div class="price">
                    <?//= Html::submitButton('<i class="glyphicon glyphicon-refresh"></i> Update', ['class' => 'btn btn-default pull-right']) ?>
                    <div class="clearfix"></div>
                        <p><?= Yii::t('easyii','total price')?>
                            <span class="pull-right">
                                 <? if(\Yii::$app->language == 'ar') echo "ج.م" ;?>
                                 <? if(\Yii::$app->language == 'en') echo "LE" ;?>
                                 <?= Shopcart::cost() ?>
                            </span>
                        </p>


                        <p> <?= Yii::t('easyii','delivery price')?>
                            <span class="pull-right">
                                <? if(\Yii::$app->language == 'ar') echo "ج.م" ;?>
                                 <? if(\Yii::$app->language == 'en') echo "LE" ;?>
                                 <?= $delivery ;?>
                                <span id="DCost"></span>

                            </span>
                        </p>
                            <p> <?= Yii::t('easyii','final total Price')?>
                            <span class="pull-right">
                                <? if(\Yii::$app->language == 'ar') echo "ج.م" ;?>
                                 <? if(\Yii::$app->language == 'en') echo "LE" ;?>
                                <?= Shopcart::cost()+$delivery ?>
                            </span>
                        </p>
                    </div>
                </div>
                    <?= Html::endForm()?>
                <?php else : ?>
                <div class="col-md-6 order-online">
                    <br/><br/><br/><br/>
                    <p><?= Yii::t('easyii','Shopping cart is empty');?></p>
                    <br/><br/><br/>
                    </div>
                <?php endif; ?>


            </div>
            </div>
    </div>

<link rel="stylesheet" href="/theme/build/css/intlTelInput.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="/theme/build/js/intlTelInput.js"></script>
<script>
    $("#order-phone").intlTelInput({
        // allowExtensions: true,
       // autoFormat: false,
        // autoHideDialCode: false,
        // autoPlaceholder: false,
        // dropdownContainer: $("body"),
        // excludeCountries: ["us"],
        // geoIpLookup: function(callback) {
        //   $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // initialCountry: "auto",
        // nationalMode: false,
        // numberType: "MOBILE",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['eg','sa'],
        utilsScript: "/theme/lib/libphonenumber/build/utils.js"
    });
</script>
