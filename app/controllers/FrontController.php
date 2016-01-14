<?php
namespace app\controllers;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use yii\base\Controller;
use yii\helpers\Url;
use yii\web\Cookie;
class FrontController extends Controller
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

    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type=='error'?'danger':$type, $message);
    }


}