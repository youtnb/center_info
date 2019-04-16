<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MSqlserver $mSqlserver
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mSqlserver->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mSqlserver->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Sqlservers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mSqlservers form large-9 medium-8 columns content">
    <?= $this->Form->create($mSqlserver) ?>
    <fieldset>
        <legend><?= __('Edit M Sqlserver') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('background_color');
            echo $this->Form->control('sort');
            echo $this->Form->control('delete_flag');
            echo $this->Form->control('m_user_id', ['options' => $mUsers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
