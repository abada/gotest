<?php
if($index % 2) {
    echo ' <div class="about-review container">';
} else {
    echo '<div class="gray-review about-review ">
                                        <div class="container">';
}
?>




<div class="testim">
    <h4><?= $model->owner?> </h4>
    <h3><?= $model->title ?></h3>
    <p><?= $model->text ?></p>
</div>


<?php
if($index % 2) {
        echo ' </div>';
} else {
    echo ' </div> </div>';

}

?>