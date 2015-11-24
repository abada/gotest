<?php
namespace app\modules\sections\controllers;

use yii\easyii\components\CategoryController;

class AController extends CategoryController
{
    /** @var string  */
    public $categoryClass = 'app\modules\sections\models\Category';

    /** @var string  */
    public $moduleName = 'sections';
}