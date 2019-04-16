<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Device $device
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $device->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $device->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['action' => 'index']) ?></li>
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
<div class="devices form large-9 medium-8 columns content">
    <?= $this->Form->create($device) ?>
    <fieldset>
        <legend><?= __('Edit Device') ?></legend>
        <?php
            echo $this->Form->control('center_id', ['options' => $centers]);
            echo $this->Form->control('m_device_type_id', ['options' => $mDeviceTypes]);
            echo $this->Form->control('name');
            echo $this->Form->control('ip_higher');
            echo $this->Form->control('ip_lower');
            echo $this->Form->control('reserve_flag');
            echo $this->Form->control('security_flag');
            echo $this->Form->control('model');
            echo $this->Form->control('serial_no');
            echo $this->Form->control('support_end_date', ['empty' => true]);
            echo $this->Form->control('setup_date', ['empty' => true]);
            echo $this->Form->control('m_operation_system_id', ['options' => $mOperationSystems, 'empty' => true]);
            echo $this->Form->control('m_sqlserver_id', ['options' => $mSqlservers, 'empty' => true]);
            echo $this->Form->control('admin_pass');
            echo $this->Form->control('m_product_id', ['options' => $mProducts, 'empty' => true]);
            echo $this->Form->control('m_version_id', ['options' => $mVersions, 'empty' => true]);
            echo $this->Form->control('custom');
            echo $this->Form->control('connect');
            echo $this->Form->control('remote');
            echo $this->Form->control('remarks');
            echo $this->Form->control('running_flag');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id', ['options' => $mUsers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
