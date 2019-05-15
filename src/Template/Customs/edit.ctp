<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Custom $custom
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $custom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $custom->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customs form large-9 medium-8 columns content">
    <?= $this->Form->create($custom) ?>
    <fieldset>
        <legend><?= __('Edit Custom') ?></legend>
        <?php
            echo $this->Form->control('device_id', ['options' => $devices]);
            echo $this->Form->control('accepted_no');
            echo $this->Form->control('content');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id', ['options' => $mUsers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
