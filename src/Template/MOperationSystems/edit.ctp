<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MOperationSystem $mOperationSystem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mOperationSystem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mOperationSystem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Operation Systems'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devices'), ['controller' => 'Devices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Device'), ['controller' => 'Devices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mOperationSystems form large-9 medium-8 columns content">
    <?= $this->Form->create($mOperationSystem) ?>
    <fieldset>
        <legend><?= __('Edit M Operation System') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('server_flag');
            echo $this->Form->control('background_color');
            echo $this->Form->control('sort');
            echo $this->Form->control('delete_flag');
            echo $this->Form->hidden('m_user_id', ['value' => $this->request->session()->read('Auth.User.id')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
