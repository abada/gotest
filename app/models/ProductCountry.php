<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_country".
 *
 * @property integer $id
 * @property string $title
 * @property string $title_ar
 * @property string $code
 */
class ProductCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_ar', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'title_ar' => 'Title Ar',
            'code' => 'Code',
        ];
    }
}
