<?php

namespace app\controllers;

use app\models\GadgetsFilterForm;
use  app\modules\reviews\api\News;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use Yii;
use yii\easyii\modules\catalog\api\Catalog;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;


class ProductsController extends \yii\web\Controller
{
    public function beforeAction($event)
    {
        if( \Yii::$app->session->has('_language')){
        }else{
            \Yii::$app->language='ar';
        }
        return parent::beforeAction($event);
    }

    public $metaTags=array();



    public function init()
    {
        MultiLanguageHelper::catchLanguage();
        parent::init();
    }

    public function actionIndex()
    {
        $slug = 'products';
        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);

        if (!$cat) {
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;

        if($filterForm->load(Yii::$app->request->post()) && $filterForm->validate()) {
            $filters = $filterForm->parse();

            return $this->renderPartial('products_search', [
                'cat' => $cat,
                'items' => $cat->items([
                    'pagination' => ['pageSize' => 20],
                    'filters' => $filters
                ]),
                'filterForm' => $filterForm
            ]);
        }else{

            if ($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {

                $filters = $filterForm->parse();
            }
            //$sliderFilters= $filters ;
            $this->view->params['sliderFilters'] = $filters;

            return $this->render('products', [
                'cat' => $cat,
                'items' => $cat->items([
                    'pagination' => ['pageSize' => 20],
                    'filters' => $filters
                ]),
                'filterForm' => $filterForm
            ]);

          }

    }


    public function actionSearch($text)
    {
        $text = filter_var($text, FILTER_SANITIZE_STRING);

        return $this->render('search', [
            'text' => $text,
            'items' => Catalog::items([
                'where' => ['or', ['like', 'title', $text], ['like', 'description', $text]],
            ])
        ]);
    }

    public function actionView($slug=null,$drygo=null,$review=null,$lang=null)
    {
        $oReview = new \app\modules\reviews\models\News();
        $oReview->time = time();

        $item = Catalog::get($slug);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        if( \Yii::$app->language == 'en'){
            $product_image=$item->image;
        }else{
            $product_image=$item->image_ar;

        }
            //og tags
            $this->view->params['metatitle'] = $item->og_title;
            $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].$product_image;
            $this->view->params['metadesc'] =strip_tags($item->og_desc);

            //meta tags
            $this->view->params['meta_title']=$item->meta_title;
            $this->view->params['meta_keyword']=strip_tags($item->meta_keyword);
            $this->view->params['meta_description']=strip_tags($item->meta_desc);
            
            
            
        //if for drygo item share
        if($drygo != ''){
             $dryGoData=\app\modules\drygomoduleupdated\models\Carousel::find()->where('carousel_id='.$drygo)->one();
            if($lang!= 'en'){
                \Yii::$app->language="ar";
                $image= $dryGoData->image_ar;
            }else{
                \Yii::$app->language="en";
                $image= $dryGoData->image;
            }

            if($dryGoData){
                $this->view->params['metatitle'] = $dryGoData->title;
                $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].$image;
                $this->view->params['metadesc'] = $dryGoData->text;
            }
        }
        if($review != null){
            if($lang!= 'en'){
                \Yii::$app->language="ar";
                $image= $item->image_ar;
            }else{
                \Yii::$app->language="en";
                $image= $item->image;
            }
            $Creview=\app\modules\reviews\models\News::find()->where('news_id='.$review)->one();
            if($Creview){
                $this->view->params['metatitle'] = $Creview->title;
                $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].$image;
                $this->view->params['metadesc'] = $Creview->short;
            }
        }




        if ($oReview->load(Yii::$app->request->post())) {
            $oReview->product_id=$item->id;
            $oReview->status=0;
            if(Yii::$app->language =='en'){$oReview->flag_en=1;}else{$oReview->flag_en=0;}


            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($oReview);
            }
            else{
                if($oReview->save()){
                        \Yii::$app->getSession()->setFlash('success', Yii::t('easyii', 'Your Review has been added successfully'));


                }
                else{
                   // var_dump($oReview->formatErrors());
                    return $this->refresh();
                }
            }


        }



//        $reviews= News::find()
//            ->where("product_id = ".$item->id." and status=1")
//            ->all();
           $reviews= News::items(['tags' => '','pagination' => ['pageSize' => 5]],$item->id);
           $count=0;
           foreach($reviews as $review){
               $count +=$review->no_of_review;
           }
        if($count >0){$avg_rate = count($reviews) / $count;}else{$avg_rate =0;}

        $avg_rate = round($avg_rate);

        //var_dump($reviews);die;
        return $this->render('view', [
            'item' => $item,
            'addToCartForm' => new \app\models\AddToCartForm(),
            'reviews'=>$reviews,
            'oReview'=>$oReview,
        ]);
    }




    public function actionReview($slug=null,$review)
    {
         $item = Catalog::get($slug);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        $Creview=\app\modules\reviews\models\News::find()->where('news_id='.$review)->one();
        if($Creview){
            $this->view->params['metatitle'] = $Creview->title;
            $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].'/'.$item->image;
            $this->view->params['metadesc'] = $Creview->short;
        }


        $reviews= News::items(['tags' => '','pagination' => ['pageSize' => 5]],"product_id = ".$item->id);
        $count=0;
        foreach($reviews as $review){
            $count +=$review->no_of_review;
        }


       if($count >0 ){
           $avg_rate = count($reviews) / $count;
       }else{
           $avg_rate =0;
       }
        $avg_rate = round($avg_rate);
        //var_dump($reviews);die;
        return $this->render('view', [
            'item' => $item,
            'addToCartForm' => new \app\models\AddToCartForm(),
            'reviews'=>$reviews,
            'Creviews'=>$Creview
        ]);
    }





    public function actionProducts($slug='products')
    {
        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {
            $filters = $filterForm->parse();
        }

        return $this->render('cat', [
            'cat' => $cat,
            'items' => $cat->items([
                'pagination' => ['pageSize' => 2],
                'filters' => $filters
            ]),
            'filterForm' => $filterForm
        ]);
    }



    public function actionOffers(){
        $slug='offers';
        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {

            $filters = $filterForm->parse();
        }


        return $this->render('offers', [
            //'sliderFilters'=>$sliderFilters,
            'cat' => $cat,
            'addToCartForm' => new \app\models\AddToCartForm(),
            'items' => $cat->items([
                'pagination' => ['pageSize' => 20],
                'filters' => $filters
            ]),
        ]);



    }




    public function actionOnline($slug='products'){

        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {
            $filters = $filterForm->parse();
        }

        return $this->render('online', [
            'cat' => $cat,
            'Postpartum' => $cat->itemsGo([
                'pagination' => ['pageSize' => 1000],
                'filters' => $filterForm->FilerByCat(1)
            ]),

            'PeriodPads' => $cat->itemsGo([
                'pagination' => ['pageSize' => 1000],
                'filters' => $filterForm->FilerByCat(2)
            ]),


            'DailyPantilinears' => $cat->itemsGo([
                'pagination' => ['pageSize' => 1000],
                'filters' => $filterForm->FilerByCat(3)
            ]),

            'NewGeneration' => $cat->itemsGo([
                'pagination' => ['pageSize' => 1000],
                'filters' => $filterForm->FilerByCat(4)
            ]),



        ]);


    }

    public function actionViewOnline($slug=null)
    {

        $item = Catalog::get($slug);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        if( \Yii::$app->language == 'en'){
            $product_image=$item->image;
        }else{
            $product_image=$item->image_ar;

        }
        //og tags
        $this->view->params['metatitle'] = $item->og_title;
        $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].$product_image;
        $this->view->params['metadesc'] =strip_tags($item->og_desc);

        //meta tags
        $this->view->params['meta_title']=$item->meta_title;
        $this->view->params['meta_keyword']=strip_tags($item->meta_keyword);
        $this->view->params['meta_description']=strip_tags($item->meta_desc);





        $cat= Catalog::cat('products');

        return $this->render('viewonline', [
            'item' => $item,
            'addToCartForm' => new \app\models\AddToCartForm(),
            'products'=>$cat->items(),
        ]);
    }



    public function actionCheckout(){

        return $this->render('checkout',array(

            'addToCartForm' => new \app\models\AddToCartForm()
        ));


    }


}
