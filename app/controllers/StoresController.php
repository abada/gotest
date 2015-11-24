<?php

namespace app\controllers;
use app\models\Products;
use app\modules\customers\models\Category;
use app\modules\customers\api\Catalog;

use app\modules\customers\models\Item;
use app\models\GadgetsStoresFilterForm;
use Yii;
use yii\web\NotFoundHttpException;

class StoresController extends FrontController
{

    public function actionIndex()
    {
        //prepar products
        $slug='pharmacies';
        $filterForm = new GadgetsStoresFilterForm();
        $cat = Catalog::cat($slug);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
      if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {

            $filters = $filterForm->parse();
        }
       // var_dump($filters);
        return $this->render('index', [
            //'sliderFilters'=>$sliderFilters,
            'cat' => $cat,
            'items' => $cat->items([
                'pagination' => ['pageSize' => 6],
                'filters' => $filters
            ]),
            'filterForm' => $filterForm,
        ]);
    }




    public function actionIndexOLD()
    {
        $slug='products';
        $filterForm = new GadgetsStoresFilterForm();
        $cat = Category::findOne(1);

        if(!$cat){
            throw new NotFoundHttpException('Shop category not found.');
        }
        $filters = null;
        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {

            $filters = $filterForm->parse();
          }
         //$sliderFilters= $filters ;
         //$this->view->params['sliderFilters'] = $filters;
         //  var_dump($filters['speed']);//die;

        return $this->render('index', [
            //'sliderFilters'=>$sliderFilters,
            'cat' => $cat,

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

    public function actionView($slug)
    {
        $item = Catalog::get($slug);
        if(!$item){
            throw new NotFoundHttpException('Item not found.');
        }

        return $this->render('view', [
            'item' => $item,
            'addToCartForm' => new \app\models\AddToCartForm()
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


}
