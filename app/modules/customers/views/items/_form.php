<?php
use yii\easyii\helpers\Image;
use yii\easyii\widgets\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;


use kartik\select2\Select2;

$settings = $this->context->module->settings;
$module = $this->context->module->id;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'title'); // ->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className()) ?>

<?= $form->field($model, 'address') ?>
<?= $form->field($model, 'phone') ?>
<?= $form->field($model, 'country') ?>
<?= $form->field($model, 'government') ?>
<?= $form->field($model, 'city') ?>
<?= $form->field($model, 'district') ?>
<?= $form->field($model, 'website') ?>
<?= $form->field($model, 'email') ?>

<?php

//echo $form->field($model, 'products[]')->dropDownList($model->getServices(),
//
//    ['class' => 'form-control', 'multiple' => true]);


// Multiple select without model
echo "Products";
echo Select2::widget([
    'name' => 'products',
    'value' => $selectedData,
    'data' => $model->getServices(),
    'options' => ['multiple' => true, 'placeholder' => 'Select Products ...']
]);


?>


<?php if($settings['itemThumb']) : ?>
    <?php if($model->image) : ?>
        <img src="<?= Image::thumb($model->image, 240) ?>">
        <a href="<?= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
    <?php endif; ?>
    <?//= $form->field($model, 'image')->fileInput() ?>
<?php endif; ?>

<?= $dataForm ?>
<?php if($settings['itemDescription']) : ?>
    <?= $form->field($model, 'description')->widget(Redactor::className(),[
        'options' => [
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'customers'], true),
            'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'customers'], true),
            'plugins' => ['fullscreen']
        ]
    ])->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className()) ?>
<?php endif; ?>

<?//= $form->field($model, 'available') ?>
<?//= $form->field($model, 'price') ?>




<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>