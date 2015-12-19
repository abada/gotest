<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;

$page = Page::get('page-shopcart-success');
$successCode=Page::get('successcode');
echo $successCode->text;


$pay=Page::get('paydetails');


$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

    <div class="content">
    <div class="container">
    <h2 class="title"><?= Yii::t('easyii','order online');?></h2>
    <div class="row">
        <br/><br/><br/><br/><br/>

         <?= $page->text ?>
        <br/><br/>
        <h1><?= $pay->title?></h1>
        <p><?= $pay->text ?></p>


    </div>
    </div>
    </div>
