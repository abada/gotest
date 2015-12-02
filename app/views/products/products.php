<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $cat->seo('title', $cat->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $cat->model->title;

//var_dump($this->params['sliderFilters']);
//echo $sliderFilters['absorptionrate'].'dd';die;
?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="product-filter">
                    <div class="title"><?= Yii::t('easyii', 'products filter');?> </div>
                    <div class="container">
                        <?php $form = ActiveForm::begin(['method' => 'get','id'=>'FilterForm', 'action' => Url::to(['/products/index', 'slug' => 'products'])]); ?>
                        <input type="hidden"   value="<?= $this->params['sliderFilters']['product_cat']?>"  name="GadgetsFilterForm[product_cat]" id="gadgetsfilterform-product_cat" >


                        <div class="row">
                            <div class="col-md-3">
                                <div class="absorpation center-block">
                                    <h4><?= Yii::t('easyii', 'Absorption Rate');?>  </h4>
                                    <p>
                                        <input type="text"   readonly name="GadgetsFilterForm[absorptionrate]" id="gadgetsfilterform-absorptionrate" >
                                    </p>
                                    <div id="slider-range-max"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="speed center-block">
                                    <h4><?= Yii::t('easyii', 'Speed');?>  </h4>
                                    <ul class="absorpation-filter">
                                    	<li><a href="#">1</a></li>
                                    	<li><a href="#">2</a></li>
                                    	<li><a href="#" class="active">3</a></li>
                                    	<li><a href="#">4</a></li>
                                    	<li><a href="#">5</a></li>
                                    </ul>
                                    <!--
                                    <p>
                                        <input type="text" readonly  name="GadgetsFilterForm[speed]" id="gadgetsfilterform-speed" value="5" >
                                    </p>
                                    <div id="slider-range-max2"></div>
-->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="clothes center-block">
                                    <h4><?= Yii::t('easyii', 'Clothes');?>  </h4>
                                    <ul class="absorpation-filter">
                                    	<li><a href="#">filter</a></li>
                                    	<li><a href="#" class="active">clothes</a></li>
                                    </ul>
                                    <!--
                                    <p>
                                        <input type="text"  readonly  name="GadgetsFilterForm[clothes]" id="gadgetsfilterform-clothes" >
                                    </p>
                                    <div id="slider-range-max3"></div>
-->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="activity center-block">
                                    <h4><?= Yii::t('easyii', 'Activity');?>  </h4>
                                    <ul class="absorpation-filter">
                                    	<li><a href="#" class="active">Activity</a></li>
                                    	<li><a href="#">center</a></li>
                                    	<li><a href="#">filter</a></li>
                                    </ul>
                                    <!--
                                    <p>
                                        <input type="text"  readonly  name="GadgetsFilterForm[activity]" id="gadgetsfilterform-activity">
                                    </p>
                                    <div id="slider-range-max4"></div>
-->
                                </div>
                            </div>
                        </div>
                        <?//= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <ul class="products-filter">
                    <li role="presentation" data-toggle="portfilter" data-target="all" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('0')" class="<?php if($this->params['sliderFilters']['product_cat']==0)echo 'current'; ?>" ><?= Yii::t('easyii', 'All Products');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="postpartum" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('1')"  class="<?php if($this->params['sliderFilters']['product_cat']==1)echo 'current'; ?>" ><?= Yii::t('easyii', 'Postpartum');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="period" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('2')" class="<?php if($this->params['sliderFilters']['product_cat']==2)echo 'current'; ?>" ><?= Yii::t('easyii', 'Period Pads');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="pantilinears" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('3')" class="<?php if($this->params['sliderFilters']['product_cat']==3)echo 'current'; ?>" ><?= Yii::t('easyii', 'Daily Pantilinears');?> </a></li>
                    <li role="presentation" data-toggle="portfilter" data-target="generation" class="hvr-bounce-to-right">
                        <a href="javascript:void(0)"  onclick="SubmitCat('4')" class="<?php if($this->params['sliderFilters']['product_cat']==4)echo 'current'; ?>" ><?= Yii::t('easyii', 'New Generation');?> </a></li>
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


                <ul class="col-md-12 col-centered products-page">

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
            </div>
        </div>
    </div>


<script>
    function SubmitCat(val){
        $('#gadgetsfilterform-product_cat').val(val);
        $('#FilterForm').submit();
    }

 </script>