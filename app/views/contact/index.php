<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;
use yii\widgets\ActiveForm;


$page = Page::get('page-contact');

$this->title = yii::t('easyii','contact us');//$page->seo('title',yii::t('easyii','contact us'));
$this->params['breadcrumbs'][] = $page->model->title;
?>

<div class="content">

    <div class="container">
        <div class="row">
        
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><?= $page->title ;?></h2>
                
            </div>
            <div class="sub-title">
                <p style="text-align: center;"><?= $page->text ?></p>                </div>
        </div>
            
            
        </div>
    </div>
    <div class="container-fluid bg margin-top50">
        <div class="container">
            <div class="row contact-us">
                <div class="col-sm-5 col-sm-offset-1">

           
                
        
                    <?php
                    $page= Page::get("contact-address");
                    echo $page->text;
                    ?>
                    
                </div>
                <div class="col-sm-4 col-sm-offset-1 order-online">

                    <?php if($Saved) : ?>
                    <div class="well"><h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> <?= Yii::t('easyii', 'Message successfully sent')?></h4></div>
                        
                    <?php else :

                        $form = ActiveForm::begin([
                        'enableClientValidation' => true,
                       // 'action' => Url::to(['/admin/feedback/send'])
                        ]);

                  ?>
                        <?php echo $form->field($model, 'title')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Title') ])->label(false);  ?>
                         <?php echo $form->field($model, 'name')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Company Name') ])->label(false);  ?>
                         <?php echo $form->field($model, 'phone')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Phone') ])->label(false);  ?>
                         <?php echo $form->field($model, 'email')->textInput(['class' => 'form-control',' placeholder'=>Yii::t('easyii', 'Email') ])->label(false);  ?>

                         <?php echo $form->field($model, 'text')->textarea(['class' => 'form-control msg','rows' => '5',' placeholder'=>Yii::t('easyii', 'your message') ])->label(false);  ?>

                        <div class="row">
                            <div class="col-md-12 margin-top30">
                                <button class="btn dry-btn center-block" type="submit">Send Request</button>
                            </div>
                        </div>

                        <?php
                        ActiveForm::end();

                   endif; ?>

                    </div>
            </div>
        </div>
    </div>
</div>
