<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;


//$this->title = $cat->seo('title', $cat->model->title);
$this->title = yii::t('easyii','Dry Products');


$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $cat->model->title;

$this->params['meta_keyword'] = yii::t('easyii','meta 4');
$this->params['meta_description'] = yii::t('easyii','meta 77');

$sliderFilters=$this->params['sliderFilters'];
$ListCloth =['1'=>'Wide','2'=>'Tight',''=>'Wide'];
$ListActive =['1'=>'Sleep','2'=>'Normal','3'=>'Active',''=>'Sleep'];

//var_dump($this->params['sliderFilters']);
//echo $sliderFilters['absorptionrate'].'dd';die;

//var_dump($sliderFilters);
?>
        <div class="container-fluid">
            <div class="row">
                <div class="product-filter">
                    <div class="title"><?= Yii::t('easyii', 'Product Choice Tool');?> </div>
                    <div class="container">
                        <?php $form = ActiveForm::begin(['method' => 'get','id'=>'FilterForm', 'action' => Url::to(['/products/index#SeResult', 'slug' => 'products'])]); ?>
                        <input type="hidden"   value="<?= $this->params['sliderFilters']['product_cat']?>"  name="GadgetsFilterForm[product_cat]" id="gadgetsfilterform-product_cat" >


                        <div class="row">
                            <div class="col-md-3">
                                <div class="absorpation center-block filters">
                                    <h4><?= Yii::t('easyii', 'Absorption Rate');?>  </h4>
                                   
                                    <div class="filterdiv">
                                    
                                         <input type="text"  name="GadgetsFilterForm[absorptionrate]" id="gadgetsfilterform-absorptionrate" >
                                      
                                  </div>
                                    <div id="slider-range-max"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="speed center-block filters">
                                    <h4><?= Yii::t('easyii', 'Speed');?>  </h4>
                                    
                                    <div class="filterdiv">
                                    
                                         <input type="text"  name="GadgetsFilterForm[speed]" id="gadgetsfilterform-speed" value="5" >
                                      
                                  </div>
                                    <div id="slider-range-max2"></div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="clothes center-block filters">
                                    <h4><?= Yii::t('easyii', 'Clothes');?>  </h4>
                                    
                                    <div class="filterdiv">
                                    	<p class="col-md-6 text-left wide" style="margin-bottom: 7px;margin-top: 5px;    padding: 0;">
                                            <?= Yii::t('easyii', 'Wide');?> </p>
                                            <p class="col-md-6 text-right tight" style="margin-bottom: 7px;margin-top: 5px;    padding: 0;">
                                            <?= Yii::t('easyii', 'Tight');?>
                                            </p>
                                        <div class="clearfix"></div>
                                         <input type="hidden"  name="GadgetsFilterForm[clothes]" id="gadgetsfilterform-clothes" >
                                         <input type="text"  readonly="readonly"  id="gadgetsfilterform-clothes-text"  value="<?= $ListCloth [$sliderFilters['clothes']] ?>" style="display:none">
                                     
                                  </div>
                                    <div id="slider-range-max3"></div>

                                </div>
                            </div>
                            <div class="col-md-3" id="SeResult">
                                <div class="activity center-block filters">
                                    <h4><?= Yii::t('easyii', 'Activity');?>  </h4>
                                    <div class="filterdiv">
                                    	<p class="col-md-4 text-left Sleep" style="margin-bottom: 7px;margin-top: 5px;    padding: 0;">
                                            <?= Yii::t('easyii', 'Sleep');?>  </p>
                                            <p class="col-md-4 text-center Normal" style="margin-bottom: 7px;margin-top: 5px;    padding: 0;">
                                            <?= Yii::t('easyii', 'Normal');?>  </p>
                                            <p class="col-md-4 text-right Activity" style="margin-bottom: 7px;margin-top: 5px;    padding: 0;">
                                            <?= Yii::t('easyii', 'Active');?> </p>
                                        <div class="clearfix"></div>
                                         <input type="hidden"   name="GadgetsFilterForm[activity]" id="gadgetsfilterform-activity">
                                         <input  id="gadgetsfilterform-activity-text" value="<?= $ListActive [$sliderFilters['activity']] ?>" style="display:none">
                                      
                                  </div>
                                        
                                    <div id="slider-range-max4"></div>
                                </div>
                            </div>
                        </div>
                        <?//= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        <input type="hidden" name="slug" value="products">
                        <?php

                        $label='';
                        AjaxSubmitButton::begin([
                            'label' => $label,
                            'id'=>'GoSumbmitProducts',
                            'ajaxOptions' => [
                                'type'=>'POST',
                                'url'=>'/products/index',
                                /*'cache' => false,*/
                                'success' => new \yii\web\JsExpression('function(html){
                                   $("#resultData").html(html);

                                        }'),
                            ],
                            'options' => [ 'type' => 'submit','style'=>'display:none'],
                        ]);
                        AjaxSubmitButton::end();
                        ?>




                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" >
                <ul class="products-filter">
                    <li role="presentation" data-toggle="portfilter" data-target="all" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('0',this)" class="<?php if($this->params['sliderFilters']['product_cat']==0)echo 'current'; ?>" ><?= Yii::t('easyii', 'All Products');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="postpartum" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('1',this)"  class="<?php if($this->params['sliderFilters']['product_cat']==1)echo 'current'; ?>" ><?= Yii::t('easyii', 'Postpartum');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="period" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('2',this)" class="<?php if($this->params['sliderFilters']['product_cat']==2)echo 'current'; ?>" ><?= Yii::t('easyii', 'Period Pads');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="pantilinears" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('3',this)" class="<?php if($this->params['sliderFilters']['product_cat']==3)echo 'current'; ?>" ><?= Yii::t('easyii', 'Daily Pantiliners');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="generation" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('4',this)" class="<?php if($this->params['sliderFilters']['product_cat']==4)echo 'current'; ?>" ><?= Yii::t('easyii', 'New Generation');?> </a></li>
                </ul>
                <!-- Single button -->
<!--                <div class="row">-->
<!--                    <div class="col-sm-4 col-sm-offset-5 col-xs-offset-2">-->
<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn filter-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">chose your country </button>-->
<!--                            <ul class="dropdown-menu filter-dropdown">-->
<!--                                <li><a href="#">Egypt</a></li>-->
<!--                                <li><a href="#">KSA</a></li>-->
<!--                                <li><a href="#">UAE</a></li>-->
<!--                                <li role="separator" class="divider"></li>-->
<!--                                <li><a href="#">Other</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <span id="resultData">
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

               </span>

            </div>
        </div>
 


<script>
    function SubmitCat(val,node){
        $('#gadgetsfilterform-product_cat').val(val);
        //$('#FilterForm').submit();
        $('.products-filter a').removeClass('current');
        $( node ).addClass('current');
        $('#GoSumbmitProducts').click();
    }

 </script>