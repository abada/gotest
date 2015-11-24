<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$category = \app\modules\customers\models\Category::findOne(1);
echo $this->render('_menu', ['category' => $category]) ?>

<?php
$form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
<?= $form->field($model,'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save',['class'=>'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>