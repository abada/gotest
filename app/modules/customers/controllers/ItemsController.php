<?php
namespace app\modules\customers\controllers;

use app\models\CsvForm;
use app\models\CustomerItems;
use app\models\XlsxFile;
use Yii;
use yii\easyii\behaviors\StatusController;
use yii\web\UploadedFile;
use yii\helpers\Html;

use yii\easyii\components\Controller;
use app\modules\customers\models\Category;
use app\modules\customers\models\Item;
use yii\easyii\helpers\Image;
use yii\easyii\behaviors\SortableDateController;
use yii\widgets\ActiveForm;
require(__DIR__ . '/../../../../vendor/Excel/PHPExcel/IOFactory.php');



class ItemsController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => SortableDateController::className(),
                'model' => Item::className(),
            ],
            [
                'class' => StatusController::className(),
                'model' => Item::className()
            ]
        ];
    }

    public function actionIndex($id)
    {
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }


    public function actionCreate($id)
    {
        if(!($category = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        $model = new Item;

        if ($model->load(Yii::$app->request->post())) {

         $data= Yii::$app->request->post('Item');

            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else {
                $model->category_id = $category->primaryKey;
                $model->data = Yii::$app->request->post('Data');

                if (isset($_FILES) && $this->module->settings['itemThumb']) {
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, 'customers');
                    } else {
                        $model->image = '';
                    }
                }
                if ($model->save()) {
                    //save related items
                    foreach (Yii::$app->request->post('products') as $item){
                        $CustomerData= new CustomerItems();
                        $CustomerData->item_id= $item;
                        $CustomerData->customer_id=$model->item_id;
                        $CustomerData->save();

                    }
                    $this->flash('success', Yii::t('easyii/customers', 'Item created'));
                    return $this->redirect(['/admin/'.$this->module->id.'/items/edit/', 'id' => $model->primaryKey]);
                } else {
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            $selected='';
            return $this->render('create', [
                'model' => $model,
                'category' => $category,
                'selectedData' => $selected,
                'dataForm' => $this->generateForm($category->fields)
            ]);
        }
    }

    public function actionEdit($id)
    {
        if(!($model = Item::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else {
                $model->data = Yii::$app->request->post('Data');

                if (isset($_FILES) && $this->module->settings['itemThumb']) {
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, 'customers');
                    } else {
                        $model->image = $model->oldAttributes['image'];
                    }
                }

                if ($model->save()) {
                    //Delete old Data
                    $model->deleteSelectedServices();
                    $products=Yii::$app->request->post('products');
                    if($products){
                        foreach ($products as $item){
                            $CustomerData= new CustomerItems();
                            $CustomerData->item_id= $item;
                            $CustomerData->customer_id=$model->item_id;
                            $CustomerData->save();

                        }
                    }


                    $this->flash('success', Yii::t('easyii/customers', 'Item updated'));
                    return $this->redirect(['/admin/'.$this->module->id.'/items/edit', 'id' => $model->primaryKey]);
                } else {
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            //get selected values
            $selected= $model->getSelectedServices();
            return $this->render('edit', [
                'model' => $model,
                'selectedData' => $selected,
                'dataForm' => $this->generateForm($model->category->fields, $model->data)
            ]);
        }
    }

    public function actionPhotos($id)
    {
        if(!($model = Item::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model,
        ]);
    }

    public function actionClearImage($id)
    {
        $model = Item::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        elseif($model->image){
            $model->image = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->image);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionDelete($id)
    {
        if(($model = Item::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/customers', 'Item deleted'));
    }

    public function actionUp($id, $category_id)
    {
        return $this->move($id, 'up', ['category_id' => $category_id]);
    }

    public function actionDown($id, $category_id)
    {
        return $this->move($id, 'down', ['category_id' => $category_id]);
    }

    public function actionOn($id)
    {
        return $this->changeStatus($id, Item::STATUS_ON);
    }

    public function actionOff($id)
    {
        return $this->changeStatus($id, Item::STATUS_OFF);
    }

    private function generateForm($fields, $data = null)
    {
        $result = '';
        foreach($fields as $field)
        {
            $value = !empty($data->{$field->name}) ? $data->{$field->name} : null;
            if ($field->type === 'string') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::input('text', "Data[{$field->name}]", $value, ['class' => 'form-control']) .'</div>';
            }
            elseif ($field->type === 'text') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::textarea("Data[{$field->name}]", $value, ['class' => 'form-control']) .'</div>';
            }
            elseif ($field->type === 'boolean') {
                $result .= '<div class="checkbox"><label>'. Html::checkbox("Data[{$field->name}]", $value, ['uncheck' => 0]) .' '. $field->title .'</label></div>';
            }
            elseif ($field->type === 'select') {
                $options = ['' => Yii::t('easyii/customers', 'Select')];
                foreach($field->options as $option){
                    $options[$option] = $option;
                }
                $result .= '<div class="form-group"><label>'. $field->title .'</label><select name="Data['.$field->name.']" class="form-control">'. Html::renderSelectOptions($value, $options) .'</select></div>';
            }
            elseif ($field->type === 'checkbox') {
                $options = '';
                foreach($field->options as $option){
                    $checked = $value && in_array($option, $value);
                    $options .= '<br><label>'. Html::checkbox("Data[{$field->name}][]", $checked, ['value' => $option]) .' '. $option .'</label>';
                }
                $result .= '<div class="checkbox well well-sm"><b>'. $field->title .'</b>'. $options .'</div>';
            }
        }
        return $result;
    }


    public function actionUploadCsv(){
        $model = new XlsxFile();
        $filecsv='';
        if($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('uploads/csv/' . $filename);
            define('CSV_PATH', 'uploads/csv/');
            $inputFileName = CSV_PATH . $filename;
            try {
                $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }

        //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            //  Loop through each row of the worksheet in turn
            for ($row = 1; $row <= $highestRow; $row++) {
                //  Read a row of data into an array
                $fillData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL, TRUE, FALSE);

                // echo $fillData[0][0]."<br/>";
                //foreach($rowData[0] as $k=>$v)
                //echo "Row: ".$row."- Col: ".($k+1)." = ".$v."<br />";
                //echo  $v."<br/>";
                $oCustomer= new Item();
                $oCustomer->title=$fillData[0][1];
                $oCustomer->address=$fillData[0][2];
                $oCustomer->phone=$fillData[0][3];
                $oCustomer->country=$fillData[0][7];
                $oCustomer->government=$fillData[0][6];
                $oCustomer->city=$fillData[0][5];
                $oCustomer->district=$fillData[0][4];
                $oCustomer->category_id=1;
                $oCustomer->status=1;
                //$oCustomer->title=$data[0];
                $oCustomer->save();

                if (strpos($fillData[0][8],',') !== false) {
                    $products = explode(",", $fillData[0][8]);
                    if (!empty($products)) {
                        foreach ($products as $item) {
                            $oProduct = new CustomerItems();
                            $oProduct->customer_id = $oCustomer->item_id;
                            $oProduct->item_id = $item;
                            $oProduct->save();
                        }

                    }
                }else{
                    if(  $fillData[0][8] != ''){
                        $oProduct= new CustomerItems();
                        $oProduct->customer_id=$oCustomer->item_id;
                        $oProduct->item_id=$fillData[0][8];
                        $oProduct->save();
                    }
                }









            }

            unlink('uploads/csv/'.$filename);
            $this->flash('success', Yii::t('easyii/customers', 'Data Imported successfully'));
            return $this->redirect(['/admin/customers/items/1']);


        }else{
            return $this->render('uploadcsv',['model'=>$model ,'filecsv'=>$filecsv]);


        }

        die;

         $model = new CsvForm();
        $filecsv='';
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model,'file');
            $filename = 'Data.'.$file->extension;
            $upload = $file->saveAs('uploads/csv/'.$filename);
            if($upload){
                define('CSV_PATH','uploads/csv/');
                $csv_file = CSV_PATH . $filename;

                $filecsv = file($csv_file);
                if(! empty($filecsv)){
                    foreach($filecsv as $data){
                        $fillData = explode(",",$data);
                        if($data[0]!='c'){
                           $oCustomer= new Item();
                            $oCustomer->title=$fillData[1];
                            $oCustomer->address=$fillData[2];
                            $oCustomer->phone=$fillData[3];
                            $oCustomer->district=$fillData[4];
                            $oCustomer->country=$fillData[7];
                            $oCustomer->government=$fillData[6];
                            $oCustomer->city=$fillData[5];
                            $oCustomer->category_id=1;
                            $oCustomer->status=1;
                            //$oCustomer->title=$data[0];
                            $oCustomer->save();
                            if (strpos($fillData[8],',') !== false) {
                                $products=explode(",",$fillData[8]);
                                if(! empty($products)){
                                    foreach($products as $item){
                                        $oProduct= new CustomerItems();
                                        $oProduct->customer_id=$oCustomer->item_id;
                                        $oProduct->item_id=$item;
                                        $oProduct->save();
                                    }

                                }
                            }else{
                              if(  $fillData[8] != ''){
                                  $oProduct= new CustomerItems();
                                  $oProduct->customer_id=$oCustomer->item_id;
                                  $oProduct->item_id=$fillData[8];
                                  $oProduct->save();
                              }
                              }






                        }
                    }
                }

                unlink('uploads/csv/'.$filename);
                $this->flash('success', Yii::t('easyii/customers', 'Data Imported successfully'));
                return $this->redirect(['/admin/customers/items/1']);


            }
        }else{
            return $this->render('uploadcsv',['model'=>$model ,'filecsv'=>$filecsv]);
        }

    }
    
     public function actionDeleteData(){
     
             $data= CustomerItems::deleteAll();
             $data= Item::deleteAll("category_id=1");
     
               $this->flash('success', Yii::t('easyii/customers', 'Data hase been removed successfully'));
                return $this->redirect(['/admin/customers/items/1']);
     
     }
    

}