<?php
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>
<ul class="nav nav-pills">
    <?php if($action === 'index') : ?>
        <li><a href="<?= Url::to(['/admin/'.$module]) ?>"><i class="glyphicon glyphicon-chevron-left font-12"></i> <?= Yii::t('easyii', 'Categories') ?></a></li>
    <?php endif; ?>
    <li <?= ($action === 'index') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/items', 'id' => $category->primaryKey]) ?>"><?php if($action !== 'index') echo '<i class="glyphicon glyphicon-chevron-left font-12"></i> ' ?><?= $category->title ?></a></li>
    <li <?= ($action === 'create') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/items/create', 'id' => $category->primaryKey]) ?>"><?= Yii::t('easyii', 'Add') ?></a>
    </li>
    <li <?= ($action === 'upload-csv') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/items/upload-csv']) ?>"><?= Yii::t('easyii', 'Import Data') ?></a>
    </li>


    <li <?= ($action === 'upload-governrate') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/items/upload-governrate']) ?>"><?= Yii::t('easyii', 'Import Governrates') ?></a>
    </li>

    <li <?= ($action === 'upload-cities') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/items/upload-cities']) ?>"><?= Yii::t('easyii', 'Import Cities') ?></a>
    </li>

      <li <?= ($action === 'delete-data') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/items/delete-data']) ?>"><?= Yii::t('easyii', 'Delete Old Data') ?></a>
    </li>


</ul>
<br/>