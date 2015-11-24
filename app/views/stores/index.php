<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;

?>
<div class="content gray-color">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="padding-left:0">
                <div class="find-bg">
                    <h1><?= Yii::t('easyii', 'Find Nearest Shop');?>  </h1>
        <?php
            $allProducts=\app\models\Products::FetchProducts();
            $form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/stores/index', 'slug' => $cat->slug])]);
        ?>


                    <div class="col-md-4 col-centered ">
                        <div class="dropdown" style="margin-right:5px">
                           <?= $form->field($filterForm, 'product_id')->dropDownList($allProducts,['prompt'=>Yii::t('easyii', 'Product'),'class'=>'btn btn-findUs  dropdown-toggle'] )->label('');?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dropdown">
                          <?= $form->field($filterForm, 'country')->dropDownList(\app\models\Stores::FetchCountries(),['prompt'=>Yii::t('easyii', 'Country') ,'class'=>'btn btn-findUs dropdown-toggle'] )->label('');?>
                        </div></div>
                    <div class="col-md-4"><div class="dropdown">
                            <?= $form->field($filterForm, 'government')->dropDownList(\app\models\Stores::FetchGovernment(),['prompt'=>Yii::t('easyii', 'Government'),'class'=>'btn btn-findUs dropdown-toggle'] )->label('');?>
                        </div></div>
                    <div class="col-md-4"><div class="dropdown">
                           <?= $form->field($filterForm, 'district')->dropDownList(\app\models\Stores::FetchDistrict() ,['prompt'=>Yii::t('easyii', 'District'),'class'=>'btn btn-findUs dropdown-toggle'])->label('');?>
                        </div></div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="#">
                                <input type="image" name="submit" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/search-icon.png" border="0" class="center-block margin-top20" />
                            </a>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>

        <div class="title"> <?= Yii::t('easyii', 'closest to you');?>  </div>


        <div class="row margin-top20">
            <?php if(count($items)) : ?>
                <?php foreach($items as $item) : ?>

                    <?= $this->render('_item', ['item' => $item]) ?>

                <?php endforeach ;?>
            <?php endif ; ?>

        </div>


         <?= $cat->pages() ?>


        <div class="row">
            <div class="online-method">
                <?php  $page = Page::get('find-store'); ?>
                    <?php echo $page->text?>
                <a href="/products/online" class="btn dry-btn">Online Method</a>
            </div>
        </div>
    </div>
</div>
