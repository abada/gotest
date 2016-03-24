<?php
namespace app\modules\agencies\api;

use Yii;
use app\modules\agencies\models\Feedback as FeedbackModel;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\ReCaptcha;


/**
 * Feedback module API
 * @package app\modules\agencies\api
 *
 * @method static string form(array $options = []) Returns fully worked standalone html form.
 * @method static array save(array $attributes) If you using your own form, this function will be useful for manual saving feedback's.
 */

class Feedback extends \yii\easyii\components\API
{
    const SENT_VAR = 'feedback_sent';

    private $_defaultFormOptions = [
        'errorUrl' => '/contact/index?error',
        'successUrl' => ''
    ];

    public function api_form($options = [])
    {
        $model = new FeedbackModel;
        $settings = Yii::$app->getModule('admin')->activeModules['agencies']->settings;
        $options = array_merge($this->_defaultFormOptions, $options);

        ob_start();
        $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'action' => Url::to(['/admin/feedback/send'])
        ]);

        echo Html::hiddenInput('errorUrl', $options['errorUrl'] ? $options['errorUrl'] : Url::current([self::SENT_VAR => 0]));
        echo Html::hiddenInput('successUrl', $options['successUrl'] ? $options['successUrl'] : Url::current([self::SENT_VAR => 1]));
var_dump($model->getErrors());

      echo '   <input type="text" placeholder="Title" class="form-control" name="Feedback[title]" >
                    <input type="text" placeholder="Company Name" class="form-control" name="Feedback[name]" id="feedback-name">
                    <div class="help-block"></div>
                    <input type="text" placeholder="Phone" class="form-control" name="Feedback[phone]" >
                    <input type="text" placeholder="Email" class="form-control" name="Feedback[email]" >
                    <textarea  name="Feedback[text]"  id="feedback-text" class="form-control msg" rows="5" placeholder="your message"></textarea>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn dry-btn center-block" type="submit">Send Request</button>
                        </div>
                    </div>';

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