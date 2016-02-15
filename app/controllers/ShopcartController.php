<?php

namespace app\controllers;
use app\models\City;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;

use app\models\AddToCartForm;
use Yii;
use yii\easyii\modules\catalog\api\Catalog;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\web\NotFoundHttpException;
use yii\easyii\modules\shopcart\models\Order;

class ShopcartController extends \yii\web\Controller
{

    public function beforeAction($event)
    {
        if( \Yii::$app->session->has('_language')){
        }else{
            \Yii::$app->language='ar';
        }
        return parent::beforeAction($event);
    }

    public function init()
    {
        MultiLanguageHelper::catchLanguage();
        parent::init();
    }



    public function actionCities($code){
        $cities= City::find()
                      ->where('CountryCode="'.$code.'" ')
                      ->all();



        if(count($cities)>0){
            foreach($cities as $city){
                echo "<option value='".$city->Name."'>".$city->Name."</option>";
            }
        }
        else{
            echo "<option>--</option>";
        }

    }

 public function actionDeliveryCost($code){
     //check the api for the returned data

        return "the new cost--".$code;

    }


    public function actionIndex($error=null)
    {

        return $this->render('index', [
            'goods' => Shopcart::goods(),
            'error'=>$error
        ]);
    }

    public function actionSuccess()
    {
        $cat = Catalog::cat('products');
        return $this->render('success',array( 'products'=>$cat->items() ));
    }

    public function actionAdd($id)
    {
    @ob_start();
        $item = Catalog::get($id);

        if(!$item){
            throw new NotFoundHttpException('Item not found');
        }

        $form = new AddToCartForm();
        $success = 0;
        if($form->load(Yii::$app->request->post()) && $form->validate()){
            $response = Shopcart::add($item->id, $form->count, $form->color);
            $success = $response['result'] == 'success' ? 1 : 0;
        }

        $url = Yii::$app->request->referrer ;
            if (strpos($url,'?') !== false) {
             $url=$url.'&';
            }else{

                $url=$url.'?';
            }
            $fullurl=$url.AddToCartForm::SUCCESS_VAR.'='.$success .'&id='.$id;
            echo("<script>location.href = '".$fullurl."';</script>");
            
        // return $this->redirect($url.AddToCartForm::SUCCESS_VAR.'='.$success .'&id='.$id);
    }

    public function actionRemove($id)
    {
        Shopcart::remove($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate()
    {
        Shopcart::update(Yii::$app->request->post('Good'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionOrder($id, $token)
    {
        $order = Shopcart::order($id);
        if(!$order || $order->access_token != $token){
            throw new NotFoundHttpException('Order not found');
        }

        return $this->render('order', ['order' => $order]);
    }

}
