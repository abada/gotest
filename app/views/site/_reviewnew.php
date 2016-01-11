<?php
if($index % 2) {
    echo '<div class="gray-review  ">
                                        <div class="about-review container">';
} else {

    echo ' <div class="about-review container">';
}
?>




<div class="testim">
    <h4><?= $model->owner?> </h4>
    <h3><?= $model->title ?></h3>
    <p><?= $model->text ?></p>
</div>


<?php
if($index % 2) {
    echo ' </div> </div>';
} else {
    echo ' </div>';


}

?>