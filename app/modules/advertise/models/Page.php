<?php
namespace app\modules\advertise\models;

use Yii;
use yii\easyii\behaviors\SeoBehavior;

class Page extends \yii\easyii\components\ActiveRecord
{
    public static function tableName()
    {
        return 'app_advertises';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['image', 'image'],
            ['image_ar', 'image'],

            [['title', 'text'], 'trim'],
            ['title', 'string', 'max' => 400],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['slug', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('easyii', 'Title'),
            'text' => Yii::t('easyii', 'Text'),
            'url' => Yii::t('easyii', 'Link to'),
            'catpage' => Yii::t('easyii', 'Location Page'),
            'slug' => Yii::t('easyii', 'Slug'),
            'image' => Yii::t('easyii', 'Image For English'),
            'image_ar' => Yii::t('easyii', 'Image For Arabic'),
        ];
    }

    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'seoBehavior' => SeoBehavior::className(),
        ]);
    }
}