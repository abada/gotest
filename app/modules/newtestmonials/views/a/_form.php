<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
    use webvimark\behaviors\multilanguage\input_widget;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>

<?//= $form->field($model, 'homepage')->checkBox()?>
<?php echo $form->field($model, 'homepage')->dropDownList(
    ['1'=>'homepage',
    '0'=>'who\'s Dry',
    '2'=>'All'

], [ 'prompt' => 'Select Location']);?>

<?= $form->field($model, 'owner')->widget(input_widget\MultiLanguageActiveField::className()) ?>
<?= $form->field($model, 'title')->widget(input_widget\MultiLanguageActiveField::className()) ?>




<?= $form->field($model, 'text')->widget(Redactor::className(),[
    'options' => [
        'minHeight' => 400,
        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
        'plugins' => ['fullscreen']
    ]
])->widget(input_widget\MultiLanguageActiveField::className(),['inputType'=>'textArea', 'inputOptions'=>[
    'rows'=>3,
    'class'=>'redactor',
]]);
?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

<script>
    $(function()
    {
        $('.redactor').redactor();
    });

</script>