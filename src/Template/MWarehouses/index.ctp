<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MWarehouse[]|\Cake\Collection\CollectionInterface $mWarehouses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= __('建屋マスタ') ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master', ['own' => 'MWarehouses']); ?>
</nav>
<div class="mWarehouses index large-9 medium-8 columns content">
    <h3><?= __('M Warehouses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('icon') ?>
                <th scope="col"><?= __('登録拠点') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mWarehouses as $mWarehouse): ?>
            <tr>
                <!--<td><?= $this->Number->format($mWarehouse->id) ?></td>-->
                <td><?= h($mWarehouse->name) ?></td>
                <td><?= h($mWarehouse->icon) ?></td>
                <td><?php
                    if ($mWarehouse->center_id_1){echo $centers[$mWarehouse->center_id_1]. '<br />';}
                    if ($mWarehouse->center_id_2){echo $centers[$mWarehouse->center_id_2]. '<br />';}
                    if ($mWarehouse->center_id_3){echo $centers[$mWarehouse->center_id_3]. '<br />';}
                    if ($mWarehouse->center_id_4){echo $centers[$mWarehouse->center_id_4]. '<br />';}
                    if ($mWarehouse->center_id_5){echo $centers[$mWarehouse->center_id_5]. '<br />';}
                    if ($mWarehouse->center_id_6){echo $centers[$mWarehouse->center_id_6]. '<br />';}
                    if ($mWarehouse->center_id_7){echo $centers[$mWarehouse->center_id_7]. '<br />';}
                ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mWarehouse->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mWarehouse->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mWarehouse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mWarehouse->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
