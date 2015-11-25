<?php
namespace app\modules\advertise\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

use yii\easyii\components\Controller;
use app\modules\advertise\models\Page;
use yii\easyii\helpers\Image;
use yii\web\UploadedFile;

class AController extends Controller
{
    public $rootActions = ['create', 'delete'];

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Page::find()->pagedesc()
        ]);
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate($slug = null)
    {
        $model = new Page;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if (isset($_FILES) ) {
                    $model->image = UploadedFile::getInstance($model, 'image');
                    $model->image_ar = UploadedFile::getInstance($model, 'image_ar');

                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, 'catalog');
                    } else {
                        $model->image = '';
                    }
                    if ($model->image_ar && $model->validate(['image_ar'])) {
                        $model->image_ar = Image::upload($model->image_ar, 'catalog');
                    } else {
                        $model->image_ar = '';
                    }
                }




                if($model->save()){
                    $this->flash('success', Yii::t('easyii/advertise', 'Page created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            if($slug) $model->slug = $slug;

            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = Page::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{


                if (isset($_FILES) ) {
                    $model->image = UploadedFile::getInstance($model, 'image');
                    $model->image_ar = UploadedFile::getInstance($model, 'image_ar');

                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, 'catalog');
                    } else {
                        $model->image =  $model->oldAttributes['image'];
                    }
                    if ($model->image_ar && $model->validate(['image_ar'])) {
                        $model->image_ar = Image::upload($model->image_ar, 'catalog');
                    } else {
                        $model->image_ar =  $model->oldAttributes['image_ar'];
                    }
                }



                if($model->save()){
                    $this->flash('success', Yii::t('easyii/advertise', 'Page updated'));
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($id)
    {
        if(($model = Page::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/advertise', 'Page deleted'));
    }



    public function actionClearImage($id)
    {
        $model = Page::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        elseif($model->image){
            $model->image = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->image);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionClearImageAr($id)
    {
        $model = Page::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        elseif($model->image_ar){
            $model->image_ar = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->image_ar);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

}