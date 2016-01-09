<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "govenment".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $government_code
 * @property string $title
 * @property string $title_ar
 */
class Govenment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'govenment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'title', 'title_ar'], 'string', 'max' => 255],
            [['government_code'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'government_code' => 'Government Code',
            'title' => 'Title',
            'title_ar' => 'Title Ar',
        ];
    }
}
