<?php
namespace app\modules\newtestmonials\models;

use Yii;
use yii\easyii\behaviors\SeoBehavior;

class Page extends \yii\easyii\components\ActiveRecord
{
    public static function tableName()
    {
        return 'app_newtestmonialss';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['owner', 'required'],
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
            'title' => Yii::t('easyii', 'title'),
            'owner' => Yii::t('easyii', 'By'),
            'text' => Yii::t('easyii', 'Text'),
            'slug' => Yii::t('easyii', 'Slug'),
        ];
    }

    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'seoBehavior' => SeoBehavior::className(),
        ]);
    }
}