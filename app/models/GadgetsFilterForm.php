<?php
namespace app\models;

use Yii;
use yii\base\Model;

class GadgetsFilterForm extends Model
{
    public $product_cat;
    public $absorptionrate;
    public $speed;
    public $clothes;
    public $activity;

    public function rules()
    {
        return [
            [['product_cat', 'absorptionrate', 'speed', 'clothes','activity'], 'number', 'min' => 0],

        ];
    }

    public function attributeLabels()
    {
        return [
            'speed' => 'speed',
        ];
    }

    public function parse()
    {
        $filters = [];

        if ($this->product_cat) {
            $filters['product_cat'] = $this->product_cat;
        }
        if ($this->absorptionrate) {
            $filters['absorptionrate'] = $this->absorptionrate;
                    }
        if ($this->speed) {
            $filters['speed'] = $this->speed;
        }
        if ($this->clothes) {
            $filters['clothes'] = $this->clothes;
        }
        if ($this->activity) {
            $filters['activity'] = $this->activity;
        }
        return $filters;
    }

    public function FilerByCat($value)
    {
        $filters['product_cat'] =$value;
        return $filters;
    }


}