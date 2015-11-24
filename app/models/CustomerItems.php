<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_items".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $item_id
 */
class CustomerItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'item_id'], 'required'],
            [['customer_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'item_id' => 'Item ID',
        ];
    }


}
