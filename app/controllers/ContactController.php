<?php

namespace app\controllers;
use Yii;
use yii\easyii\modules\feedback\models\Feedback as FeedbackModel;


class ContactController extends FrontController
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
                //var_dump($model->getErrors());
                $Saved=1;
            }
        }


        return $this->render('index',array('model'=>$model,'Saved'=>$Saved));
    }

}
