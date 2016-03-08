<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\modules\page\api\Page;
use demogorgorn\ajax\AjaxSubmitButton;
?>
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