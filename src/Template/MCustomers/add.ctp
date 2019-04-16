<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MCustomer $mCustomer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List M Customers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mCustomers form large-9 medium-8 columns content">
    <?= $this->Form->create($mCustomer) ?>
    <fieldset>
        <legend><?= __('Add M Customer') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('full_name');
            echo $this->Form->control('remarks');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id', ['options' => $mUsers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
