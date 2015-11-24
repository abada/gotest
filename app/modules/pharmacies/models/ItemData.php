<?php
namespace app\modules\pharmacies\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\SeoBehavior;
use yii\easyii\behaviors\SortableModel;
use yii\easyii\models\Photo;

class ItemData extends \yii\easyii\components\ActiveRecord
{

    public static function tableName()
    {
        return 'app_pharmacies_item_data';
    }
}