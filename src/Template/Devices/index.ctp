<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device[]|\Cake\Collection\CollectionInterface $devices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Device'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Device Types'), ['controller' => 'MDeviceTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Device Type'), ['controller' => 'MDeviceTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Operation Systems'), ['controller' => 'MOperationSystems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Operation System'), ['controller' => 'MOperationSystems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Sqlservers'), ['controller' => 'MSqlservers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Sqlserver'), ['controller' => 'MSqlservers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Products'), ['controller' => 'MProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Product'), ['controller' => 'MProducts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Versions'), ['controller' => 'MVersions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Version'), ['controller' => 'MVersions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="devices index large-9 medium-8 columns content">
    <h3><?= __('Devices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('center_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_device_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_higher') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_lower') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reserve_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('security_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model') ?></th>
                <th scope="col"><?= $this->Paginator->sort('serial_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('support_end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('setup_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_operation_system_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_sqlserver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('admin_pass') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_version_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('connect') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remote') ?></th>
                <th scope="col"><?= $this->Paginator->sort('running_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device): ?>
            <tr>
                <td><?= $this->Number->format($device->id) ?></td>
                <td><?= $device->has('center') ? $this->Html->link($device->center->name, ['controller' => 'Centers', 'action' => 'view', $device->center->id]) : '' ?></td>
                <td><?= $device->has('m_device_type') ? $this->Html->link($device->m_device_type->name, ['controller' => 'MDeviceTypes', 'action' => 'view', $device->m_device_type->id]) : '' ?></td>
                <td><?= h($device->name) ?></td>
                <td><?= h($device->ip_higher) ?></td>
                <td><?= h($device->ip_lower) ?></td>
                <td><?= h($device->reserve_flag) ?></td>
                <td><?= h($device->security_flag) ?></td>
                <td><?= h($device->model) ?></td>
                <td><?= h($device->serial_no) ?></td>
                <td><?= h($device->support_end_date) ?></td>
                <td><?= h($device->setup_date) ?></td>
                <td><?= $device->has('m_operation_system') ? $this->Html->link($device->m_operation_system->name, ['controller' => 'MOperationSystems', 'action' => 'view', $device->m_operation_system->id]) : '' ?></td>
                <td><?= $device->has('m_sqlserver') ? $this->Html->link($device->m_sqlserver->name, ['controller' => 'MSqlservers', 'action' => 'view', $device->m_sqlserver->id]) : '' ?></td>
                <td><?= h($device->admin_pass) ?></td>
                <td><?= $device->has('m_product') ? $this->Html->link($device->m_product->name, ['controller' => 'MProducts', 'action' => 'view', $device->m_product->id]) : '' ?></td>
                <td><?= $device->has('m_version') ? $this->Html->link($device->m_version->name, ['controller' => 'MVersions', 'action' => 'view', $device->m_version->id]) : '' ?></td>
                <td><?= h($device->connect) ?></td>
                <td><?= h($device->remote) ?></td>
                <td><?= h($device->running_flag) ?></td>
                <td><?= h($device->delete_flag) ?></td>
                <td><?= $device->has('m_user') ? $this->Html->link($device->m_user->name, ['controller' => 'MUsers', 'action' => 'view', $device->m_user->id]) : '' ?></td>
                <td><?= h($device->created) ?></td>
                <td><?= h($device->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $device->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $device->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $device->id], ['confirm' => __('Are you sure you want to delete # {0}?', $device->id)]) ?>
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
