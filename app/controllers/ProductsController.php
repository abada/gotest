<?php

namespace app\controllers;

use app\models\GadgetsFilterForm;
use  app\modules\reviews\api\News;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use Yii;
use yii\easyii\modules\catalog\api\Catalog;
use yii\web\NotFoundHttpException;

class ProductsController extends \yii\web\Controller
{

    public $metaTags=array();



    public function init()
    {
        MultiLanguageHelper::catchLanguage();
        parent::init();
    }

    public function actionIndex()
    {
        $slug='products';
        $filterForm = new GadgetsFilterForm();
        $cat = Catalog::cat($slug);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {

            $filters = $filterForm->parse();
          }
        //$sliderFilters= $filters ;
        $this->view->params['sliderFilters'] = $filters;

        //  var_dump($filters['speed']);//die;

        return $this->render('products', [
            //'sliderFilters'=>$sliderFilters,
            'cat' => $cat,
            'items' => $cat->items([
                'pagination' => ['pageSize' => 20],
                'filters' => $filters
            ]),
            'filterForm' => $filterForm
        ]);
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

    public function actionView($slug=null)
    {
        $oReview = new \app\modules\reviews\models\News();
        $oReview->time = time();

        $item = Catalog::get($slug);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

            $this->view->params['metatitle'] = $item->title;
            $this->view->params['metaimage'] = "http://".$_SERVER['SERVER_NAME'].'/'.$item->image;
            $this->view->params['metadesc'] = $item->description;


        if ($oReview->load(Yii::$app->request->post())) {
            $oReview->product_id=$item->id;

            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($oReview);
            }
            else{
                if($oReview->save()){
                   // $this->flash('success', Yii::t('easyii', 'Your Review has been created'));
                   
                }
                else{
                    var_dump($oReview->formatErrors());
                    return $this->refresh();
                }
            }


        }



//        $reviews= News::find()
//            ->where("product_id = ".$item->id." and status=1")
//            ->all();
           $reviews= News::items(['tags' => '','pagination' => ['pageSize' => 5]],"product_id = ".$item->id);
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

        $Creview=\app\modules\reviews\models\News::find('slug='.$review)->one();
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


        $avg_rate = count($reviews) / $count;
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
