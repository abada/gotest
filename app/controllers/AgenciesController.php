<?php

namespace app\controllers;
use Yii;
use app\modules\agencies\models\Feedback as FeedbackModel;


class AgenciesController extends FrontController
{
    public function beforeAction($event)
    {
        if( \Yii::$app->session->has('_language')){
        }else{
            \Yii::$app->language='ar';
        }
        return parent::beforeAction($event);
    }
    public function actionIndex()
    {


        $model = new FeedbackModel;

        $request = Yii::$app->request;
        $Saved=0;
        if ($model->load($request->post())) {
            if( $model->save()){
                $Saved=1;
            }else{

                //var_dump($model->getErrors());die;
            }
        }

        return $this->render('index',array('model'=>$model,'Saved'=>$Saved));
    }

}
