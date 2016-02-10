<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\behaviors\multilanguage\input_widget;
?>
<?php $form = ActiveForm::begin([
    'enableClientValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?php if($this->context->module->settings['enableTitle']) : ?>
    <?= $form->field($model, 'title')->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className()) ?>
<?php endif; ?>
<?php if($this->context->module->settings['enableText']) : ?>
    <?= $form->field($model, 'text')->widget(\webvimark\behaviors\multilanguage\input_widget\MultiLanguageActiveField::className()) ?>


<?php endif; ?>


<?php if($model->image) : ?>
    <img src="<?= $model->image ?>" style="width: 200px">
<?php endif; ?>
<?= $form->field($model, 'image')->fileInput() ?>

<?php if($model->image_ar) : ?>
    <img src="<?= $model->image_ar ?>" style="width: 200px">
<?php endif; ?>
<?= $form->field($model, 'image_ar')->fileInput() ?>
<?//= $form->field($model, 'link') ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>