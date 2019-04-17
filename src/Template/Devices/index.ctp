<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device[]|\Cake\Collection\CollectionInterface $devices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices index large-9 medium-8 columns content">
    <h3><?= __('端末情報一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" style="width:20%;"><?= $this->Paginator->sort('center_id', '拠点') ?></th>
                <th scope="col" style="width:8%;"><?= $this->Paginator->sort('m_device_type_id', '端末種別') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name', '端末名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_higher', '上位IP') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_lower', '下位IP') ?></th>
                <th scope="col" style="width:5%;"><?= $this->Paginator->sort('reserve_flag', '予備') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('security_flag', 'セキュリティ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('support_end_date', '保守終了日') ?></th>
                -->
                <th scope="col" style="width:10%;"><?= $this->Paginator->sort('setup_date', '設置日') ?></th>
                <!--
                <th scope="col"><?= $this->Paginator->sort('m_version_id', 'バージョン') ?></th>
                <th scope="col"><?= $this->Paginator->sort('connect', '接続先') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remote', 'リモート') ?></th>
                <th scope="col" style="width:5%;"><?= $this->Paginator->sort('running_flag', '稼働') ?></th>
                -->
                <th scope="col" style="width:5%;"><?= $this->Paginator->sort('delete_flag', '削除') ?></th>
                <th scope="col" style="width:13%;" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device): ?>
            <tr>
                <td><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
                <td><?= $device->has('m_device_type') ? $this->Html->link($device->m_device_type->name, ['controller' => 'MDeviceTypes', 'action' => 'view', $device->m_device_type->id]) : '' ?></td>
                <td><?= h($device->name) ?></td>
                <td><?= h($device->ip_higher) ?></td>
                <td><?= h($device->ip_lower) ?></td>
                <td><?= h($device->reserve_flag) ?></td>
                <!--
                <td><?= h($device->security_flag) ?></td>
                <td><?= h($device->support_end_date) ?></td>
                -->
                <td><?= h($device->setup_date) ?></td>
                <!--
                <td><?= $device->has('m_version') ? $this->Html->link($device->m_version->name, ['controller' => 'MVersions', 'action' => 'view', $device->m_version->id]) : '' ?></td>
                <td><?= h($device->connect) ?></td>
                <td><?= h($device->remote) ?></td>
                <td><?= h($device->running_flag) ?></td>
                -->
                <td><?= h($device->delete_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['action' => 'view', $device->id]) ?>
                    /
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?>
                    /
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $device->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]) ?>
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
