<?php
namespace app\modules\agencies\models;

use Yii;
use yii\easyii\behaviors\CalculateNotice;
use yii\easyii\helpers\Mail;
use yii\easyii\models\Setting;
use yii\easyii\validators\ReCaptchaValidator;
use yii\easyii\validators\EscapeValidator;
use yii\helpers\Url;

class Feedback extends \yii\easyii\components\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_VIEW = 1;
    const STATUS_ANSWERED = 2;

    const FLASH_KEY = 'eaysiicms_feedback_send_result';

    public $reCaptcha;

    public static function tableName()
    {
        return 'app_agencies';
    }

    public function rules()
    {
        return [
            [['title'], 'required', 'message'=>Yii::t('easyii', 'Enter Title') ], //'email',
            [['name'], 'required', 'message'=>Yii::t('easyii', 'Enter Company name') ], //'email',
            [[ 'text'], 'required', 'message'=>Yii::t('easyii', 'Enter your message ') ], //'email',
            [[ 'email'], 'required', 'message'=>Yii::t('easyii', 'Enter your Email') ], //'email',
            [[ 'phone'], 'required', 'message'=>Yii::t('easyii', 'Enter your Phone') ], //'email',
            [['name', 'email', 'phone', 'title', 'text'], 'trim'],
            [['name','title', 'text'], EscapeValidator::className()],
            ['title', 'string', 'max' => 128],
            ['email', 'email' , 'message'=>Yii::t('easyii', 'Enter Avalid Email') ],
             ['phone', 'match', 'pattern' => '/^[\d\s-\+\(\)]+$/','message'=>Yii::t('easyii', 'Enter Avalid phone number') ],
            ['reCaptcha', ReCaptchaValidator::className(), 'when' => function($model){
                return $model->isNewRecord && Yii::$app->getModule('admin')->activeModules['agencies']->settings['enableCaptcha'];
            }],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert){
                $this->ip = Yii::$app->request->userIP;
                $this->time = time();
                $this->status = self::STATUS_NEW;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $this->mailAdmin();
        }
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'name' => Yii::t('easyii', 'Name'),
            'title' => Yii::t('easyii', 'Title'),
            'text' => Yii::t('easyii', 'Text'),
            //'answer_subject' => Yii::t('easyii/agencies', 'Subject'),
            'answer_text' => Yii::t('easyii', 'Text'),
            'phone' => Yii::t('easyii', 'Phone'),
            'reCaptcha' => Yii::t('easyii', 'Anti-spam check')
        ];
    }

    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'cn' => [
                'class' => CalculateNotice::className(),
                'callback' => function(){
                    return self::find()->status(self::STATUS_NEW)->count();
                }
            ]
        ]);
    }

    public function mailAdmin()
    {
        $settings = Yii::$app->getModule('admin')->activeModules['agencies']->settings;

        if(!$settings['mailAdminOnNewFeedback']){
            return false;
        }
        return Mail::send(
            Setting::get('admin_email'),
            $settings['subjectOnNewFeedback'],
            $settings['templateOnNewFeedback'],
            ['agencies' => $this, 'link' => Url::to(['/admin/feedback/a/view', 'id' => $this->primaryKey], true)]
        );
    }

    public function sendAnswer()
    {
        $settings = Yii::$app->getModule('admin')->activeModules['agencies']->settings;

        return Mail::send(
            $this->email,
            $this->answer_subject,
            $settings['answerTemplate'],
            ['agencies' => $this],
            ['replyTo' => Setting::get('admin_email')]
        );
    }
}