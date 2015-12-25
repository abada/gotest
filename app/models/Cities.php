<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $government_code
 * @property string $title
 * @property string $title_ar
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['government_code', 'title', 'title_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'government_code' => 'Government Code',
            'title' => 'Title',
            'title_ar' => 'Title Ar',
        ];
    }
}
