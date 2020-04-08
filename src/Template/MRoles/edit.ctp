<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MRole $mRole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mRole->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mRole->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Roles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mRoles form large-9 medium-8 columns content">
    <?= $this->Form->create($mRole) ?>
    <fieldset>
        <legend><?= __('Edit M Role') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
