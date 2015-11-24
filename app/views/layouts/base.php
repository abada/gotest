<?php
use yii\helpers\Html;
//$asset = \app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>


        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/font-awesome.min.css" />
        <link type="text/css" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/ihover.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/jquery.circliful.css">
        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/ui.totop.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/style.css" />
        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/slider.css" rel="stylesheet">
        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/owl.theme.css" rel="stylesheet">
        <link href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/css/owl.carousel.css" rel="stylesheet">



        <!---->
<!---->
<!--        <link href="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/css/owl.carousel.css" rel="stylesheet">-->
<!--        <link href="--><?php //echo Yii::$app->getUrlManager()->getBaseUrl()?><!--/theme/css/owl.theme.css" rel="stylesheet">-->



        <link rel="shortcut icon" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/images/favicon.ico" type="image/x-icon">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <?php $this->head() ?>
    </head>





    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>

    <script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/jquery.bxslider.min.js"></script>


    <script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/easing.js"></script>
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/jquery.ui.totop.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/jquery.circliful.min.js"></script>
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/jquery-ui.js"></script>
    <script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl()?>/theme/js/owl.carousel.js"></script>


    <?php
    //var_dump( $data['sliderFilters'] );
    if(isset ( $this->params['sliderFilters'])){
        $sliderFilters=$this->params['sliderFilters'];
    }else{
        unset($sliderFilters);
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $().UItoTop({ easingType: 'easeOutQuart' });
  $('.circlestat').circliful();

            $("#owl-example").owlCarousel();

            function myFunction() {
                document.getElementById("left").style.textAlign = "left";
            }

            $('.bxslider').bxSlider({
                pagerCustom: '#bx-pager'
            });

            $(function() {
                $( "#slider-range-max" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: <?php echo  (isset($sliderFilters)) ? $sliderFilters['absorptionrate'] : 1 ;?>,
                    slide: function( event, ui ) {
                        $( "#gadgetsfilterform-absorptionrate" ).val( ui.value );
                        $('#FilterForm').submit();
                    }
                });
                $( "#gadgetsfilterform-absorptionrate" ).val( $( "#slider-range-max" ).slider( "value" ) );
                $( "#slider-range-max2" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: <?php echo (isset($sliderFilters)) ? $sliderFilters['speed']:1 ;?>,
                    slide: function( event, ui ) {
                        $( "#gadgetsfilterform-speed" ).val( ui.value );
                        $('#FilterForm').submit();
                    }
                });
                $( "#gadgetsfilterform-speed" ).val( $( "#slider-range-max2" ).slider( "value" ) );
                $( "#slider-range-max3" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: <?php  echo (isset($sliderFilters)) ? $sliderFilters['clothes'] :1 ;?>,
                    slide: function( event, ui ) {
                        $( "#gadgetsfilterform-clothes" ).val( ui.value );
                        $('#FilterForm').submit();
                    }
                });
                $( "#gadgetsfilterform-clothes" ).val( $( "#slider-range-max3" ).slider( "value" ) );
                $( "#slider-range-max4" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                   value: <?php echo (isset($sliderFilters)) ? $sliderFilters['activity'] : 1;?>,
                    slide: function( event, ui ) {
                        $( "#gadgetsfilterform-activity" ).val( ui.value );
                        $('#FilterForm').submit();
                    }
                });
                $( "#gadgetsfilterform-activity" ).val( $( "#slider-range-max4" ).slider( "value" ) );

            });
            function myFunction() {
                document.getElementById("left").style.textAlign = "left";
            }
        });
    </script>



</html>
<?php $this->endPage() ?>