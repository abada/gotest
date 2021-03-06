<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;
use demogorgorn\ajax\AjaxSubmitButton;


$this->title= yii::t('easyii','Find a store');

     $this->params['meta_keyword'] = yii::t('easyii','Better sanitary napkin after birth, sanitary napkin for married , the best types of sanitary pads, better health towel menstrual cycle');
  $this->params['meta_description'] = yii::t('easyii','Places to buy towels Dry Post, the best types of sanitary pads for married and after the birth and places of distribution in the governorates');
?>
<div class="content gray-color">
<div class="find-bg">
    <div class="container">
        <div class="row">
        
            <div class="col-md-12" style="">
                
                    <h1><?= Yii::t('easyii', 'Find Nearest Shop');?>  </h1>

          
    
        <?php
            $allProducts=\app\models\Products::FetchProducts();
            $form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/stores/index', 'slug' => $cat->slug])]);
           if(isset($_REQUEST['productCode'])){
               $filterForm->product_id=$_REQUEST['productCode'];


           }
        ?>


                    <div class="col-md-4 col-md-offset-4">
                       
                           <?= $form->field($filterForm, 'product_id')->dropDownList($allProducts,['prompt'=>Yii::t('easyii', 'Product'),'class'=>'btn btn-findUs  dropdown-toggle'] )->label('');?>
                     
                    </div>
					<div class="clearfix"></div>
                    <div class="col-md-4">

                        <?= $form->field($filterForm, 'country')->dropDownList(\app\models\Stores::FetchCountries(),
                            ['prompt'=>Yii::t('easyii', 'Country') ,'class'=>'btn btn-findUs dropdown-toggle' , 'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('stores/government?code=').'"+$(this).val(), function( data ) {
                  $( "select#gadgetsstoresfilterform-government" ).html( data );
                })'] )->label('');?>





                    </div>
                    <div class="col-md-4">
                        <?php

                         if(isset($filterForm->country) and  $filterForm->country != '' ){
                            $government = \app\models\Govenment::find()->where('country_code="'.$filterForm->country.'"')->all();
                            $listData=\yii\helpers\ArrayHelper::map($government,'government_code','title');
                        }else{
                             $listData =[];
                         }
                        ?>

                            <?= $form->field($filterForm, 'government')->dropDownList($listData,
                                ['prompt'=>Yii::t('easyii', 'Governorate') ,'class'=>'btn btn-findUs dropdown-toggle' , 'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('stores/cities?code=').'"+$(this).val(), function( data ) {
                  $( "select#gadgetsstoresfilterform-district" ).html( data );
                })'] )->label('');?>




                    </div>
                    <div class="col-md-4">
                        <?php
                        if(isset($filterForm->government) and  $filterForm->government != '' ) {

                            $cities= \app\models\Cities::find()
                                ->where('government_code="'. $filterForm->government.'"')
                                ->all();

                           $listData=\yii\helpers\ArrayHelper::map($cities,'id','title');

                        }else{
                            $listData=[];
                        }

                        ?>


                           <?= $form->field($filterForm, 'district')->dropDownList($listData ,['prompt'=>Yii::t('easyii', 'District'),'class'=>'btn btn-findUs dropdown-toggle'])->label('');?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
<!--                                <img src="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/images/search-icon.png" onclick="$('#GoSumbmit').click()" class="center-block margin-top20" >-->
                                <input type="image" name="submit" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/search-icon.png"
                                       border="0" class="center-block margin-top20" />
                            <?php

                            $label='';
                            AjaxSubmitButton::begin([
                                'label' => $label,
                                'id'=>'GoSumbmit',
                                'ajaxOptions' => [
                                    'type'=>'POST',
                                    'url'=>'/stores/index',
                                    /*'cache' => false,*/
                                    'success' => new \yii\web\JsExpression('function(html){
                                   $("#resultData").html(html);

                                        }'),
                                ],
                                'options' => [ 'type' => 'submit','style'=>'display:none'],
                            ]);
                            AjaxSubmitButton::end();
                            ?>


                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
	</div>
    
    <div class="closebg">
    <div class="container">
    <div class="row">
        <div class="title"> <?= Yii::t('easyii', 'closest to you');?>  </div>

         <span id="resultData">

        <div class="col-md-12 margin-top20">
        <div class="row">
            <?php
if(\Yii::$app->language =='en'){$dir= 'ltr';}else{$dir='rtl';}
           // echo "<div class='col-md-12'  dir='".$dir."'><div class='alert alert-warning'>". Yii::t('easyii','Please Use the filter to find the nearest store')."</div></div><br/>";

            if($filters['product_id']== ''){
                echo  "<div class='col-md-12' dir='".$dir."' ><div class='alert alert-danger'>".Yii::t('easyii','Please choose the product first')."</div></div><br/>";
            }else if($filters['country']== ''){
                echo   "<div class='col-md-12' dir='".$dir."' ><div class='alert alert-danger'>".Yii::t('easyii','Please Enter the country')."</div></div><br/>";
            }else if($filters['government']== ''){
                echo "<div class='col-md-12' dir='".$dir."' ><div class='alert alert-danger'>".Yii::t('easyii','Please Enter the government')."</div></div><br/>";

            }else if($filters['district']== ''){
                echo "<div class='col-md-12' dir='".$dir."' ><div class='alert alert-danger'>".Yii::t('easyii','Please Enter the District')."</div></div><br/>";

            }

            echo "<div class='clear'></div>";

              ?>

           <?

            if(count($items)) :

                if($filters['product_id'] != "" && $filters['country'] != "" &&$filters['government'] != "" ){
                    foreach($items as $item) :
                        echo $this->render('_item', ['item' => $item]);
                    endforeach ;

                   echo "<div class='clearfix'></div>";
                    echo $cat->pages() ;
                }else{
                    foreach($items as $item) :
                        if($item->data->featured){
                            echo $this->render('_item', ['item' => $item]);
                        }
                    endforeach ;
                }
          endif
            ?>

		</div>
        </div>

   </span>


        <div class="clearfix"></div>


		<div class="col-md-12">
        
            <div class="online-method">
            	<div class="left">
					<?php  $page = Page::get('find-store'); ?>
                    <?php echo $page->text?>
                    <a href="/products-online" class="btn dry-btn"><?= Yii::t('easyii', 'Online Method');?></a>
                </div>
            </div>
        </div>
        </div>
    
    </div>
    </div>
</div>
