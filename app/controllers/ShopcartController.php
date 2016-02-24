<?php
namespace app\controllers;
use app\models\City;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;

use app\models\AddToCartForm;
use Yii;
use yii\easyii\models\Setting;
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
     //check country
     $city= City::find()->where('Name="'.$code.'"')->one();
     //var_dump($city);
     if($city->CountryCode == 'EGY'){
         //calculate weight
         $sum=0;
         foreach(Shopcart::goods() as $good) {
             $sum+= $good->item->product_weight ;

         }
         // return "the new cost--".$city->Name .$city->CountryCode;
         //$city->CountryCode;
        return  $this->GetCost($city->Name,$sum);

     }else{
         return Setting::get('deliver_cost');  //.'-99'. $city->CountryCode;
     }

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

    public function actionAdd($id=null)
    {
       $id=$_POST['AddToCartForm']['id'];

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


        return '<h4 class="text-success"><i class="glyphicon glyphicon-ok"></i>'.Yii::t('easyii','Added to cart').'</h4>';


//        $url = Yii::$app->request->referrer ;
//            if (strpos($url,'?') !== false) {
//             $url=$url.'&';
//            }else{
//                $url=$url.'?';
//            }
//            $fullurl=$url.AddToCartForm::SUCCESS_VAR.'='.$success .'&id='.$id;
          //  echo("<script>location.href = '".$fullurl."';</script>");
            
        // return $this->redirect($url.AddToCartForm::SUCCESS_VAR.'='.$success .'&id='.$id);
    }

    public function actionRemove($id)
    {
        Shopcart::remove($id);
        echo("<script>location.href = '".Yii::$app->request->referrer."';</script>");
        //return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate()
    {
        Shopcart::update(Yii::$app->request->post('Good'));

       // echo Yii::$app->request->referrer ;

        echo("<script>location.href = '".Yii::$app->request->referrer."';</script>");
        //return $this->redirect(Yii::$app->request->referrer);
        //die;

    }

    public function actionOrder($id, $token)
    {
        $order = Shopcart::order($id);
        if(!$order || $order->access_token != $token){
            throw new NotFoundHttpException('Order not found');
        }

        return $this->render('order', ['order' => $order]);
    }

    public function GetCost($city,$sum){

        $params = array(
            'ClientInfo'  			=> array(
                'AccountCountryCode'	=> 'EG',
                'AccountEntity'		 	=> 'CAI',
                'AccountNumber'		 	=> '239584',
                'AccountPin'		 	=> '216216',
                'UserName'			 	=> 'mohamed.amer2050@gmail.com',
                'Password'			 	=> 'asd654321',
                'Version'			 	=> 'v1.0'
            ),

            'Transaction' 			=> array(
                'Reference1'			=> '001'
            ),

            'OriginAddress' 	 	=> array(
                'City'					=> 'Nasr City',
                'State Or Province Code'                =>'egypt',
                'CountryCode'				=> 'EG'
            ),

            'DestinationAddress' 	=> array(
                'City'					=> $city,
                'State Or Province Code'                =>'egypt',
                'CountryCode'			=> 'EG'
            ),
            'ShipmentDetails'		=> array(
                'PaymentType'			 => 'P',
                //'ProductGroup'			 => 'EXP',
                //'ProductType'			 => 'PPX',
                'ProductGroup'             => 'DOM',
                'ProductType'             => 'OND',
                'ActualWeight' 			 => array('Value' => 7.250, 'Unit' => 'KG'),
                'ChargeableWeight' 	     => array('Value' => 7.250, 'Unit' => 'KG'),
                'NumberOfPieces'		 => 7
            )
        );

        $soapClient = new \SoapClient('http://ws.aramex.net/ShippingAPI/RateCalculator/Service_1_0.svc?wsdl', array('trace' => 1));

        //$soapClient = new SoapClient('http://ws.dev.aramex.net/shippingapi/shipping/service_1_0.svc?wsdl', array('trace' => 1));
        $results = $soapClient->CalculateRate($params);
        $array = json_decode(json_encode($results), True);


        return  $array['TotalAmount']['Value'];




    }


}