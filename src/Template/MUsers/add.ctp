<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Customers'), ['controller' => 'MCustomers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Customer'), ['controller' => 'MCustomers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Device Types'), ['controller' => 'MDeviceTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Device Type'), ['controller' => 'MDeviceTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Operation Systems'), ['controller' => 'MOperationSystems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Operation System'), ['controller' => 'MOperationSystems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Products'), ['controller' => 'MProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Product'), ['controller' => 'MProducts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Sqlservers'), ['controller' => 'MSqlservers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Sqlserver'), ['controller' => 'MSqlservers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Versions'), ['controller' => 'MVersions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Version'), ['controller' => 'MVersions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($mUser) ?>
    <fieldset>
        <legend><?= __('Add M User') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('login');
            echo $this->Form->control('password');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
