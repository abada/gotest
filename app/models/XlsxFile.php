<?php


namespace app\models;

use Yii;
use yii\base\Model;

class XlsxFile extends Model{
public $file;

public function rules(){
return [
[['file'],'required'],
[['file'],'file','extensions'=>'xlsx','maxSize'=>1024 * 1024 * 5],
];
}

public function attributeLabels(){
return [
'file'=>'Select File',
];
}
}