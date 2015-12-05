<?php

namespace app\controllers;
use app\modules\customers\api\Catalog;
use app\modules\newtestmonials\models\Page as PageModel;


use app\models\CsvForm;
use Yii;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\page\models\Page;
use yii\easyii\modules\text\models\Text;
use yii\web\Controller;
use app\modules\awarness\models\Feedback as FeedbackModel;


class SiteController extends FrontController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $items = Carousel::itemlist(1306,460);
        $testmonials= PageModel::find()
                       ->where("homepage=1")
                        ->desc()
                        ->all();
        return $this->render('index',array('items'=>$items,'testmonials'=>$testmonials));
    }


    public function actionTest()
    {

        return $this->render('test',array('items'=>$items));
    }



    public function actionAboutDry(){

        return $this->render("about");

    }

    public function actionAwarness(){

        $model = new FeedbackModel;

        $request = Yii::$app->request;
        $Saved=0;
        if ($model->load($request->post())) {
            if( $model->save()){
                //var_dump($model->getErrors());
                $Saved=1;
            }
        }

      return $this->render('awarness',array('model'=>$model,'Saved'=>$Saved));


    }


    public function actionSiteMap(){

        return $this->render("sitemap");

    }


    public  function actionSearch(){


        $text = filter_var($_REQUEST['text'], FILTER_SANITIZE_STRING);
        return $this->render('search', [
            'text' => $text,
            'items' => Catalog::items([
                'where' => ['or', ['like', 'title', $text], ['like', 'description', $text]],
            ])
        ]);

    }

}