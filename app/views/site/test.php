<?php
use yii\easyii\modules\page\api\Page;
use \webvimark\behaviors\multilanguage\language_selector_widget\LanguageSelector;
use \yii\easyii\modules\gallery\api\Gallery;


?>
    <br/><br/><br/><br/><br/>


<?php

foreach(Gallery::last(6,['item_id'=>Gallery::cat('gallery7')->model->category_id]) as $photo) : ?>
    <?php  // = $photo->box(180, 135)

    echo "<pre>";
    print_r($photo);
    echo "</pre>";

    ?>
<?php endforeach;?>


<?





echo \Yii::$app->language;
//\Yii::$app->language = 'en';
$page = Page::get('know-more-about-us');

echo Yii::t('easyii', 'Control Panel');
echo  $page->text;


?><br/><br/><br/><br/><br/><br/>