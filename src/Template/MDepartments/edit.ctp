<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MDepartment $mDepartment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mDepartment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mDepartment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List M Departments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List M Users'), ['controller' => 'MUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mDepartments form large-9 medium-8 columns content">
    <?= $this->Form->create($mDepartment) ?>
    <fieldset>
        <legend><?= __('Edit M Department') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sort');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
