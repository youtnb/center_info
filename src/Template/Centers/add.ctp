<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Center $center
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Customers'), ['controller' => 'MCustomers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Customer'), ['controller' => 'MCustomers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Prefectures'), ['controller' => 'MPrefectures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M Prefecture'), ['controller' => 'MPrefectures', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="centers form large-9 medium-8 columns content">
    <?= $this->Form->create($center) ?>
    <fieldset>
        <legend><?= __('Add Center') ?></legend>
        <?php
            echo $this->Form->control('m_customer_id', ['options' => $mCustomers]);
            echo $this->Form->control('name');
            echo $this->Form->control('postcode');
            echo $this->Form->control('m_prefecture_id', ['options' => $mPrefectures, 'empty' => true]);
            echo $this->Form->control('address');
            echo $this->Form->control('tel');
            echo $this->Form->control('officer');
            echo $this->Form->control('staff');
            echo $this->Form->control('access');
            echo $this->Form->control('job');
            echo $this->Form->control('remarks');
            echo $this->Form->control('shoes_flag');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id', ['options' => $mUsers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
