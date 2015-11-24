<?php
namespace app\models;

use Yii;
use yii\base\Model;

class GadgetsStoresFilterForm extends Model
{
    public $country;
    public $government;
    public $city;
    public $district;
    public $product_id;

    public function rules()
    {
        return [
            [['country', 'government', 'city', 'district'], 'string'],
            ['product_id','integer']

        ];
    }

    public function attributeLabels()
    {
        return [
            //'speed' => 'speed',
        ];
    }

    public function parse()
    {
        $filters = [];

        if ($this->country) {
            $filters['country'] = $this->country;
        }

        if ($this->product_id) {
            $filters['product_id'] = $this->product_id;
        }

        if ($this->government) {
            $filters['government'] = $this->government;
                    }
        if ($this->city) {
            $filters['city'] = $this->city;
        }
        if ($this->district) {
            $filters['district'] = $this->district;
        }

        return $filters;
    }
}