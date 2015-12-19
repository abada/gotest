<?php

namespace app\models;
use app\models\GadgetsFilterForm;
use app\modules\reviews\api\News;
use Yii;
use yii\easyii\modules\catalog\models\Item;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class Products extends \yii\easyii\components\ActiveRecord
{

    public static function FetchProducts()
    {
        $sql = 'SELECT * FROM easyii_catalog_items where category_id=2';
        $allProducts = Item::findBySql($sql)->all();
        $listData=ArrayHelper::map($allProducts,'item_code','title');
        return $listData;
    }



    public static  function reviews($id ,$flag=""){

      $reviews= \app\modules\reviews\models\News::find('product_id='.$id)->all();

        //return count($reviews);

        $count=0;
        foreach($reviews as $review){
            $count +=$review->no_of_review;
        }
        if($count >0){
            $avg_rate = round($count/ count($reviews) );
        }else{

            $avg_rate=0;
        }

        if($flag==1){
            return $avg_rate  ;
        }

        if($flag==2){
            return count($reviews)  ;
        }

        return   $avg_rate."/5 | ".count($reviews)." ". Yii::t('easyii','reviews');

    }



}


?>