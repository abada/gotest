<?php
namespace app\modules\awarness\api;

use Yii;
use app\modules\awarness\models\Feedback as FeedbackModel;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\ReCaptcha;


/**
 * Feedback module API
 * @package app\modules\awarness\api
 *
 * @method static string form(array $options = []) Returns fully worked standalone html form.
 * @method static array save(array $attributes) If you using your own form, this function will be useful for manual saving feedback's.
 */

class Feedback extends \yii\easyii\components\API
{
    const SENT_VAR = 'feedback_sent';

    private $_defaultFormOptions = [
        'errorUrl' => '',
        'successUrl' => ''
    ];

    public function api_form($options = [])
    {
        $model = new FeedbackModel;
        $settings = Yii::$app->getModule('admin')->activeModules['awarness']->settings;
        $options = array_merge($this->_defaultFormOptions, $options);

        ob_start();
        $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'action' => Url::to(['/admin/awarness/send']),
            'options'=>['class'=>'col-md-offset-4']

        ]);

        echo Html::hiddenInput('errorUrl', $options['errorUrl'] ? $options['errorUrl'] : Url::current([self::SENT_VAR => 0]));
        echo Html::hiddenInput('successUrl', $options['successUrl'] ? $options['successUrl'] : Url::current([self::SENT_VAR => 1]));


      echo '
      <div class="form-group center-block col-md-6">';

              '  <input class="form-control" placeholder="Name" name="Feedback[name]">
                <input  class="form-control" placeholder="Subject" name="Feedback[title]">
                <input  class="form-control" placeholder="Your Mail" name="Feedback[email]" >
                <textarea class="form-control" rows="3" placeholder="Your Message" name="Feedback[text]"  id="feedback-text"></textarea>
                <button type="submit" class="btn dry-btn-3 center-block">Send Request</button>
                </div>
                ';


//        echo $form->field($model, 'name');
//        echo $form->field($model, 'email')->input('email');
//
//        if($settings['enablePhone']) echo $form->field($model, 'phone');
//        if($settings['enableTitle']) echo $form->field($model, 'title');
//
//        echo $form->field($model, 'text')->textarea();
//
//        if($settings['enableCaptcha']) echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className());
//
//        echo Html::submitButton(Yii::t('easyii', 'Send'), ['class' => 'btn btn-primary']);
      ActiveForm::end();

        return ob_get_clean();
    }

    public function api_save($data)
    {
        $model = new FeedbackModel($data);
        if($model->save()){
            return ['result' => 'success'];
        } else {
            return ['result' => 'error', 'error' => $model->getErrors()];
        }
    }
}