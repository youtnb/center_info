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
        <li><?= $this->Html->link(__('一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('登録'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('閲覧'), ['action' => 'view', $device->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $device->id],
                ['confirm' => __(DELETE_CONFIRM.' # {0}?', $device->id)]
            )
        ?></li>
    </ul>
    <?php echo $this->element('navi_master'); ?>
</nav>
<div class="devices form large-9 medium-8 columns content">
    <?= $this->Form->create($device) ?>
    <fieldset>
        <legend><?= __('Edit Device') ?></legend>
        <?php
            echo $this->Form->control('center_id', ['options' => $centers]);
            echo $this->Form->control('m_device_type_id', ['options' => $mDeviceTypes]);
            echo $this->Form->control('accepted_no');
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
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('更新')) ?>
    <?= $this->Form->end() ?>
</div>
