<?php
use yii\helpers\Url;

$this->title = Yii::t('easyii/newtestmonials', 'Pages');

$module = $this->context->module->id;
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <th width="50">#</th>
                <?php endif; ?>
                <th><?= Yii::t('easyii', 'Title')?></th>
                <th><?= Yii::t('easyii', 'owner')?></th>
                <th><?= Yii::t('easyii', 'Appears in home page')?></th>
                <?php if(IS_ROOT) : ?>
                    <th><?= Yii::t('easyii', 'Slug')?></th>
                    <th width="30"></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data->models as $item) : ?>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <td><?= $item->primaryKey ?></td>
                <?php endif; ?>

                <td><a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->primaryKey]) ?>"><?= $item->title ?></a></td>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->primaryKey]) ?>"><?= $item->owner ?></a></td>
                <td><?= ($item->homepage)? 'yes':'No' ?></td>

                <?php if(IS_ROOT) : ?>
                    <td><?= $item->slug ?></td>
                                    <?php endif; ?>

                <td><a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easyii', 'Delete item')?>"></a></td>

            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<?php endif; ?>