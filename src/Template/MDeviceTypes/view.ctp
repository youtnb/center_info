<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MDeviceType $mDeviceType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Device Type'), ['action' => 'edit', $mDeviceType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Device Type'), ['action' => 'delete', $mDeviceType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mDeviceType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Device Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Device Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mDeviceTypes view large-9 medium-8 columns content">
    <h3><?= h($mDeviceType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mDeviceType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Background Color') ?></th>
            <td><?= h($mDeviceType->background_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M User') ?></th>
            <td><?= $mDeviceType->has('m_user') ? $this->Html->link($mDeviceType->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $mDeviceType->m_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mDeviceType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort') ?></th>
            <td><?= $this->Number->format($mDeviceType->sort) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mDeviceType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mDeviceType->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $mDeviceType->delete_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Devices') ?></h4>
        <?php if (!empty($mDeviceType->devices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Center Id') ?></th>
                <th scope="col"><?= __('M Device Type Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Ip Higher') ?></th>
                <th scope="col"><?= __('Ip Lower') ?></th>
                <th scope="col"><?= __('Reserve Flag') ?></th>
                <th scope="col"><?= __('Security Flag') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Serial No') ?></th>
                <th scope="col"><?= __('Support End Date') ?></th>
                <th scope="col"><?= __('Setup Date') ?></th>
                <th scope="col"><?= __('M Operation System Id') ?></th>
                <th scope="col"><?= __('M Sqlserver Id') ?></th>
                <th scope="col"><?= __('Admin Pass') ?></th>
                <th scope="col"><?= __('M Product Id') ?></th>
                <th scope="col"><?= __('M Version Id') ?></th>
                <th scope="col"><?= __('Custom') ?></th>
                <th scope="col"><?= __('Connect') ?></th>
                <th scope="col"><?= __('Remote') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Running Flag') ?></th>
                <th scope="col"><?= __('Delete Flag') ?></th>
                <th scope="col"><?= __('M User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mDeviceType->devices as $devices): ?>
            <tr>
                <td><?= h($devices->id) ?></td>
                <td><?= h($devices->center_id) ?></td>
                <td><?= h($devices->m_device_type_id) ?></td>
                <td><?= h($devices->name) ?></td>
                <td><?= h($devices->ip_higher) ?></td>
                <td><?= h($devices->ip_lower) ?></td>
                <td><?= h($devices->reserve_flag) ?></td>
                <td><?= h($devices->security_flag) ?></td>
                <td><?= h($devices->model) ?></td>
                <td><?= h($devices->serial_no) ?></td>
                <td><?= h($devices->support_end_date) ?></td>
                <td><?= h($devices->setup_date) ?></td>
                <td><?= h($devices->m_operation_system_id) ?></td>
                <td><?= h($devices->m_sqlserver_id) ?></td>
                <td><?= h($devices->admin_pass) ?></td>
                <td><?= h($devices->m_product_id) ?></td>
                <td><?= h($devices->m_version_id) ?></td>
                <td><?= h($devices->custom) ?></td>
                <td><?= h($devices->connect) ?></td>
                <td><?= h($devices->remote) ?></td>
                <td><?= h($devices->remarks) ?></td>
                <td><?= h($devices->running_flag) ?></td>
                <td><?= h($devices->delete_flag) ?></td>
                <td><?= h($devices->m_user_id) ?></td>
                <td><?= h($devices->created) ?></td>
                <td><?= h($devices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devices', 'action' => 'view', $devices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devices', 'action' => 'edit', $devices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devices', 'action' => 'delete', $devices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
