<?php
use yii\helpers\Html;
use yii\easyii\helpers\Image;

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
    use webvimark\behaviors\multilanguage\input_widget;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data','class' => 'model-form']
]); ?>

<?= $form->field($model, 'title')->widget(input_widget\MultiLanguageActiveField::className()) ?>
<?= $form->field($model, 'text')->widget(input_widget\MultiLanguageActiveField::className()) ?>
<?= $form->field($model, 'url')->widget(input_widget\MultiLanguageActiveField::className()) ?>
<?//= $form->field($model, 'catpage');?>



<?php if($model->image) : ?>
    <img src="<?= Image::thumb($model->image, 240) ?>">
<!--    <a href="--><?//= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?><!--" class="text-danger confirm-delete" title="--><?//= Yii::t('easyii', 'Clear image')?><!--">--><?//= Yii::t('easyii', 'Clear image')?><!--</a>-->
<?php endif; ?>
<?= $form->field($model, 'image')->fileInput() ?>


<?php if($model->image_ar) : ?>
    <img src="<?= Image::thumb($model->image_ar, 240) ?>">
<!--    <a href="--><?//= Url::to(['/admin/'.$module.'/items/clear-image-ar', 'id' => $model->primaryKey]) ?><!--" class="text-danger confirm-delete" title="--><?//= Yii::t('easyii', 'Clear image')?><!--">--><?//= Yii::t('easyii', 'Clear image')?><!--</a>-->
<?php endif; ?>
<?= $form->field($model, 'image_ar')->fileInput() ?>



<?//= $form->field($model, 'text')->widget(Redactor::className(),[
//    'options' => [
//        'minHeight' => 400,
//        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
//        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
//        'plugins' => ['fullscreen']
//    ]
//])->widget(input_widget\MultiLanguageActiveField::className(),['inputType'=>'textArea', 'inputOptions'=>[
//    'rows'=>3,
//    'class'=>'form-control',
//]])
?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>