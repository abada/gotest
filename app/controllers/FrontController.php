<?php
namespace app\controllers;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use yii\base\Controller;

class FrontController extends Controller
{

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