<?php

namespace app\models;
use app\models\GadgetsFilterForm;
use Yii;
use app\modules\customers\models\Item;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class Stores extends \yii\easyii\components\ActiveRecord
{


     public  static  function FetchCountries(){
         $sql = 'SELECT  DISTINCT country FROM app_customers_items  ';
         $countries = Item::findBySql($sql)->all();
         $listData=ArrayHelper::map($countries,'country','country');
         return $listData;
     }

    public  static  function FetchGovernment(){
        $sql = 'SELECT  DISTINCT government FROM app_customers_items  ';
        $countries = Item::findBySql($sql)->all();
        $listData=ArrayHelper::map($countries,'government','government');
        return $listData;
    }

    public  static  function FetchCity(){
        $sql = 'SELECT  DISTINCT city FROM app_customers_items  ';
        $countries = Item::findBySql($sql)->all();
        $listData=ArrayHelper::map($countries,'city','city');
        return $listData;
    }

    public  static  function FetchDistrict(){
        $sql = 'SELECT  DISTINCT district FROM app_customers_items  ';
        $countries = Item::findBySql($sql)->all();
        $listData=ArrayHelper::map($countries,'district','district');
        return $listData;
    }


}

?>