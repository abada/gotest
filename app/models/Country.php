<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Country".
 *
 * @property string $Code
 * @property string $Name
 * @property string $Continent
 * @property string $Region
 * @property double $SurfaceArea
 * @property integer $IndepYear
 * @property integer $Population
 * @property double $LifeExpectancy
 * @property double $GNP
 * @property double $GNPOld
 * @property string $LocalName
 * @property string $GovernmentForm
 * @property string $HeadOfState
 * @property integer $Capital
 * @property string $Code2
 *
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Code'], 'required'],
            [['Continent'], 'string'],
            [['SurfaceArea', 'LifeExpectancy', 'GNP', 'GNPOld'], 'number'],
            [['IndepYear', 'Population', 'Capital'], 'integer'],
            [['Code'], 'string', 'max' => 3],
            [['Name'], 'string', 'max' => 52],
            [['Region'], 'string', 'max' => 26],
            [['LocalName', 'GovernmentForm'], 'string', 'max' => 45],
            [['HeadOfState'], 'string', 'max' => 60],
            [['Code2'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Code' => 'Code',
            'Name' => 'Name',
            'Continent' => 'Continent',
            'Region' => 'Region',
            'SurfaceArea' => 'Surface Area',
            'IndepYear' => 'Indep Year',
            'Population' => 'Population',
            'LifeExpectancy' => 'Life Expectancy',
            'GNP' => 'Gnp',
            'GNPOld' => 'Gnpold',
            'LocalName' => 'Local Name',
            'GovernmentForm' => 'Government Form',
            'HeadOfState' => 'Head Of State',
            'Capital' => 'Capital',
            'Code2' => 'Code2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['CountryCode' => 'Code']);
    }
}
