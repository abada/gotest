<?php

namespace app\models;
use app\models\GadgetsFilterForm;
use Yii;
use app\modules\customers\models\Item;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class Stores extends \yii\easyii\components\ActiveRecord
{


     public  static  function FetchCountriesold(){
         $sql = 'SELECT  DISTINCT country FROM app_customers_items  ';
         $countries = Item::findBySql($sql)->all();
         $listData=ArrayHelper::map($countries,'country','country');
         return $listData;
     }

    public  static  function FetchCountries(){

        if(\Yii::$app->language == "en"){
            $field= 'title';
        }else{
            $field='title_ar';
        }
        $countries = ProductCountry::find()->all();
        $listData=ArrayHelper::map($countries,'code',$field);
        return $listData;
    }


    public  static  function FetchGovernment($code){
        if(\Yii::$app->language == "en"){
            $field= 'title';
        }else{
            $field='title_ar';
        }

        $government = Govenment::find()->where('country_code='.$code)->all();
        $listData=ArrayHelper::map($government,'government_code',$field);
        return $listData;
    }

    public  static  function FetchCity($code){
        if(\Yii::$app->language == "en"){
            $field= 'title';
        }else{
            $field='title_ar';
        }
        $cities = Cities::find()->where('government_code='.$code)->all();
        $listData=ArrayHelper::map($cities,'id',$field);
        return $listData;
    }



    public  static  function FetchDistrict($code){
        if(\Yii::$app->language == "en"){
            $field= 'title';
        }else{
            $field='title_ar';
        }
        $cities = Govenment::find()->where('government_code='.$code)->all();
        $listData=ArrayHelper::map($cities,'district','district');
        return $listData;
    }


}

?>