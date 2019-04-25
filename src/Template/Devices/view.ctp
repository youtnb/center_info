<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= TITLE_CENTER ?></li>
        <li><?= $this->Html->link(__('一覧'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= TITLE_DEVICE ?></li>
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('編集'), ['action' => 'edit', $device->id]) ?> </li>
        <li><?= $this->Form->postLink(__('削除'), ['action' => 'delete', $device->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]) ?> </li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices view large-9 medium-8 columns content">
    <h3><?= h($device->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Center') ?></th>
            <td><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Device Type') ?></th>
            <td><?= $device->has('m_device_type') ? $this->Html->link($device->m_device_type->name, ['controller' => 'MDeviceTypes', 'action' => 'view', $device->m_device_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accepted No') ?></th>
            <td><?= h($device->accepted_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($device->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip Higher') ?></th>
            <td><?= h($device->ip_higher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip Lower') ?></th>
            <td><?= h($device->ip_lower) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= h($device->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serial No') ?></th>
            <td><?= h($device->serial_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Operation System') ?></th>
            <td><?= $device->has('m_operation_system') ? $this->Html->link($device->m_operation_system->name, ['controller' => 'MOperationSystems', 'action' => 'view', $device->m_operation_system->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Sqlserver') ?></th>
            <td><?= $device->has('m_sqlserver') ? $this->Html->link($device->m_sqlserver->name, ['controller' => 'MSqlservers', 'action' => 'view', $device->m_sqlserver->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Pass') ?></th>
            <td><?= h($device->admin_pass) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Product') ?></th>
            <td><?= $device->has('m_product') ? $this->Html->link($device->m_product->name, ['controller' => 'MProducts', 'action' => 'view', $device->m_product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Version') ?></th>
            <td><?= $device->has('m_version') ? $this->Html->link($device->m_version->name, ['controller' => 'MVersions', 'action' => 'view', $device->m_version->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Connect') ?></th>
            <td><?= h($device->connect) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remote') ?></th>
            <td><?= h($device->remote) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $device->has('m_user') ? $this->Html->link($device->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $device->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($device->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Support End Date') ?></th>
            <td><?= h($device->support_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Setup Date') ?></th>
            <td><?= h($device->setup_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($device->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($device->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reserve Flag') ?></th>
            <td><?= $device->reserve_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Security Flag') ?></th>
            <td><?= $device->security_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Running Flag') ?></th>
            <td><?= $device->running_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $device->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Custom') ?></h4>
        <?= $this->Text->autoParagraph(h($device->custom)); ?>
    </div>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($device->remarks)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($device->comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('コメント') ?></th>
                <th scope="col"><?= __('削除') ?></th>
                <th scope="col"><?= __('ユーザー') ?></th>
                <th scope="col"><?= __('作成日時') ?></th>
                <th scope="col"><?= __('更新日時') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($device->comments as $comments): ?>
            <tr>
                <td><?= h($comments->content) ?></td>
                <td><?= h($comments->delete_flag) ?></td>
                <td><?= h($comments->m_user_id) ?></td>
                <td><?= h($comments->created) ?></td>
                <td><?= h($comments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('閲覧'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                    <?= $this->Html->link(__('編集'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __(DELETE_CONFIRM.' # {0}?', $comments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
